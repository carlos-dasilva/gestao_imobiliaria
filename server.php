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
    if ($target && str_starts_with($target, $storageBase) && is_file($target)) {
        $ext = strtolower(pathinfo($target, PATHINFO_EXTENSION));
        $types = [
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg'=> 'image/jpeg',
            'webp'=> 'image/webp',
            'svg' => 'image/svg+xml',
            'gif' => 'image/gif',
            'ico' => 'image/x-icon',
        ];
        header('Content-Type: '.($types[$ext] ?? 'application/octet-stream'));
        header('Content-Length: '.filesize($target));
        readfile($target);
        return true;
    }
}

// 3) Caso contrário, delega para o Laravel
require_once $publicPath.'/index.php';
