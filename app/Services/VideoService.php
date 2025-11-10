<?php

namespace App\Services;

class VideoService
{
    public static function extractYouTubeId(string $url): ?string
    {
        $url = trim($url);
        if ($url === '') return null;

        $host = parse_url($url, PHP_URL_HOST) ?? '';
        $path = parse_url($url, PHP_URL_PATH) ?? '';
        $query = parse_url($url, PHP_URL_QUERY) ?? '';

        // youtube.com/watch?v=ID
        if (str_contains($host, 'youtube.com')) {
            parse_str((string) $query, $q);
            if (!empty($q['v']) && preg_match('/^[a-zA-Z0-9_-]{6,}$/', (string) $q['v'])) {
                return (string) $q['v'];
            }
            // youtube.com/shorts/ID
            if (preg_match('#^/shorts/([a-zA-Z0-9_-]{6,})#', $path, $m)) {
                return $m[1];
            }
        }

        // youtu.be/ID
        if (str_contains($host, 'youtu.be')) {
            if (preg_match('#^/([a-zA-Z0-9_-]{6,})#', $path, $m)) {
                return $m[1];
            }
        }

        return null;
    }
}

