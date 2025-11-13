<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RelaxCspForStaticPages
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Header específico para páginas estáticas geradas (Vite), evitando quebrar bundles que usam eval/new Function.
        // Escopo: apenas rotas que aplicarem este middleware.
        $csp = implode('; ', [
            "default-src 'self'",
            // Permite evaluation em bundles de build; escopo só nessas rotas
            "script-src 'self' 'unsafe-eval'",
            // Estilos inline e Google Fonts
            "style-src 'self' 'unsafe-inline' https:",
            // Imagens locais, data/blob e CDNs HTTPS (ex.: i.ytimg.com, animaapp)
            "img-src 'self' https: http: data: blob:",
            // Fontes locais e do Google Fonts
            "font-src 'self' https: data:",
            // API local + HTTPS (para eventuais assets externos)
            "connect-src 'self' https:",
            // Permitir embeds de vídeo (YouTube/Vimeo etc.) e players HTML5
            "frame-src 'self' https:",
            "media-src 'self' https: data: blob:",
            // Endurece o restante
            "object-src 'none'",
            "base-uri 'self'",
            "frame-ancestors 'self'",
        ]);

        $response->headers->set('Content-Security-Policy', $csp);
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade');

        // Log de diagnóstico focado nessas rotas estáticas
        Log::channel('system')->info('csp.applied', [
            'path' => $request->path(),
            'host' => $request->getHost(),
            'snippet' => substr($csp, 0, 160) . (strlen($csp) > 160 ? '...' : ''),
        ]);

        return $response;
    }
}
