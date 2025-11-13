<?php

// Router para o PHP Built-in Server que preserva arquivos estáticos
// Caso o arquivo exista em public/, deixa o servidor servir direto.

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$publicPath = __DIR__ . '/public';

// 1) Se for um arquivo existente dentro de public/, deixa o servidor estático servir
$file = realpath($publicPath.$uri);
if ($uri !== '/' && $file && str_starts_with($file, realpath($publicPath)) && is_file($file)) {
    return false; // servidor embutido atende
}

// 2) Suporte explícito a /storage/* (symlink aponta fora do docroot e o servidor embutido bloqueia)
if (preg_match('#^/storage/(.+)$#', $uri, $m)) {
    $storageBase = realpath(__DIR__.'/storage/app/public');
    $target = realpath($storageBase.'/'.$m[1]);
    // Log helper
    $logf = __DIR__.'/storage/logs/system.log';
    $log = function(string $event, array $ctx = []) use ($logf) {
        $ts = date('c');
        $line = sprintf('[%s] storage.%s %s%s', $ts, $event, json_encode($ctx, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE), PHP_EOL);
        @file_put_contents($logf, $line, FILE_APPEND);
    };

    if ($target && str_starts_with($target, $storageBase) && is_file($target)) {
        $ext = strtolower(pathinfo($target, PATHINFO_EXTENSION));
        $types = [
            // images
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg'=> 'image/jpeg',
            'webp'=> 'image/webp',
            'svg' => 'image/svg+xml',
            'gif' => 'image/gif',
            'ico' => 'image/x-icon',
            // video/audio basics
            'mp4' => 'video/mp4',
            'webm'=> 'video/webm',
            'ogg' => 'video/ogg',
            'mov' => 'video/quicktime',
            'mp3' => 'audio/mpeg',
            'wav' => 'audio/wav',
        ];
        $mime = $types[$ext] ?? 'application/octet-stream';
        $size = filesize($target);

        // Suporte a Range para streaming
        $range = isset($_SERVER['HTTP_RANGE']) ? $_SERVER['HTTP_RANGE'] : null;
        header('Accept-Ranges: bytes');
        if ($range && preg_match('/bytes=(\d*)-(\d*)/i', $range, $m)) {
            $start = ($m[1] !== '') ? (int)$m[1] : 0;
            $end   = ($m[2] !== '') ? (int)$m[2] : ($size - 1);
            if ($start > $end || $end >= $size) { $start = 0; $end = $size - 1; }
            $length = $end - $start + 1;
            header('HTTP/1.1 206 Partial Content');
            header("Content-Range: bytes $start-$end/$size");
            header('Content-Type: '.$mime);
            header('Content-Length: '.$length);
            header('Cache-Control: public, max-age=86400');
            $log('serve-range', ['uri' => $uri, 'target' => $target, 'mime' => $mime, 'start' => $start, 'end' => $end]);

            $fp = fopen($target, 'rb');
            if ($fp !== false) {
                fseek($fp, $start);
                $chunk = 8192;
                while (!feof($fp) && $length > 0) {
                    $read = ($length > $chunk) ? $chunk : $length;
                    echo fread($fp, $read);
                    $length -= $read;
                    if (ob_get_level()) { @ob_flush(); }
                    flush();
                }
                fclose($fp);
            }
            return true;
        }

        header('Content-Type: '.$mime);
        header('Cache-Control: public, max-age=86400, immutable');
        header('Content-Length: '.$size);
        $log('serve', ['uri' => $uri, 'target' => $target, 'mime' => $mime]);
        readfile($target);
        return true;
    }
    $log('miss', ['uri' => $uri, 'resolved' => $target ?: null]);
    // Fallback amigável para placeholder quando imagem não existe
    $ph = realpath(__DIR__.'/public/img/sem-foto.svg');
    if ($ph && is_file($ph)) {
        header('Content-Type: image/svg+xml');
        header('Cache-Control: public, max-age=86400, immutable');
        header('Content-Length: '.filesize($ph));
        $log('fallback', ['uri' => $uri, 'placeholder' => $ph]);
        readfile($ph);
        return true;
    }
}

// 3) Caso contrário, delega para o Laravel
// Força variáveis do servidor para o front controller correto,
// evitando que o PHP Built-in Server trate um segmento como base script
// (ex.: interpretando '/new-imovel' como base e removendo do path info).
$_SERVER['SCRIPT_FILENAME'] = $publicPath.'/index.php';
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['PHP_SELF'] = '/index.php';
require_once $publicPath.'/index.php';
