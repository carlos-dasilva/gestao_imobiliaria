<?php

namespace App\Http\Middleware;

use App\Models\SiteSetting;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SystemRequestLogger
{
    protected array $sensitive = [
        'password','password_confirmation','current_password','token','_token','access_token','authorization'
    ];

    public function handle(Request $request, Closure $next)
    {
        $start = microtime(true);
        $requestId = (string) Str::uuid();

        // Envia o X-Request-Id para o app e clientes
        $request->headers->set('X-Request-Id', $requestId);

        $settings = SiteSetting::first();
        $enabled = (bool) ($settings->system_log_enabled ?? false);

        // Siga o fluxo sem log se desativado
        if (!$enabled) {
            $response = $next($request);
            $response->headers->set('X-Request-Id', $requestId);
            return $response;
        }

        // Captura dados de entrada (com máscara)
        $input = $this->mask($request->all());
        $query = $this->mask($request->query());
        $route = $request->route();
        $routeName = null;
        $routeAction = null;
        if (is_object($route)) {
            try { $routeName = $route->getName(); } catch (\Throwable $e) { /* ignore */ }
            try { $routeAction = $route->getActionName(); } catch (\Throwable $e) { /* ignore */ }
        }

        $contextBase = [
            'request_id' => $requestId,
            'timestamp' => now()->toIso8601String(),
            'ip' => $request->ip(),
            'method' => $request->getMethod(),
            'path' => $request->path(),
            'full_url' => $request->fullUrl(),
            'route_name' => $routeName,
            'route_action' => $routeAction,
            'user_id' => optional($request->user())->id,
            'user_agent' => $request->userAgent(),
            'referer' => $request->headers->get('referer'),
            'headers' => [
                'accept' => $request->headers->get('accept'),
                'content_type' => $request->headers->get('content-type'),
                'x_requested_with' => $request->headers->get('x-requested-with'),
            ],
            'query' => $query,
            'input' => $input,
        ];

        Log::channel('system')->info('request.received', $contextBase);

        try {
            $response = $next($request);
        } catch (\Throwable $e) {
            $durationMs = (int) ((microtime(true) - $start) * 1000);
            $errorContext = $contextBase + [
                'duration_ms' => $durationMs,
                'exception' => [
                    'class' => get_class($e),
                    'message' => $e->getMessage(),
                    'code' => $e->getCode(),
                ],
            ];
            Log::channel('system')->error('request.exception', $errorContext);
            throw $e;
        }

        $durationMs = (int) ((microtime(true) - $start) * 1000);
        $contentType = $response->headers->get('content-type');
        $bodySnippet = null;
        $size = null;
        try {
            $content = method_exists($response, 'getContent') ? (string) $response->getContent() : '';
            $size = strlen($content);
            if ($contentType && str_contains($contentType, 'application/json')) {
                $bodySnippet = mb_substr($content, 0, 2000);
            }
        } catch (\Throwable $e) {
            // ignora erros ao ler o body
        }

        $respContext = $contextBase + [
            'duration_ms' => $durationMs,
            'response' => [
                'status' => $response->getStatusCode(),
                'content_type' => $contentType,
                'content_length' => $size,
                'body_snippet' => $bodySnippet,
            ],
        ];

        $response->headers->set('X-Request-Id', $requestId);
        Log::channel('system')->info('request.completed', $respContext);

        return $response;
    }

    protected function mask($data)
    {
        if (!is_array($data)) return $data;
        $masked = [];
        foreach ($data as $k => $v) {
            $key = is_string($k) ? strtolower($k) : $k;
            if (in_array($key, $this->sensitive, true)) {
                $masked[$k] = '***';
            } elseif (is_array($v)) {
                $masked[$k] = $this->mask($v);
            } else {
                $masked[$k] = $v;
            }
        }
        return $masked;
    }
}
