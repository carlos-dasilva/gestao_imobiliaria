#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "$0")/.." && pwd)"
cd "$ROOT_DIR"

mkdir -p storage/app/tmp

PHP_BIN="${PHP_BIN:-php}"
HOST="${HOST:-0.0.0.0}"
PORT="${PORT:-8000}"

exec "$PHP_BIN" \
  -d file_uploads=On \
  -d upload_max_filesize=12M \
  -d post_max_size=48M \
  -d max_file_uploads=50 \
  -d memory_limit=256M \
  -d upload_tmp_dir="$ROOT_DIR/storage/app/tmp" \
  -S "$HOST:$PORT" -t public "$ROOT_DIR/server.php"
