#!/bin/sh
set -e

echo "=== Starting Laravel on Koyeb ==="

# Cache config
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Migrate (optional)
php artisan migrate --force || true

echo "=== Starting services ==="
exec supervisord -c /etc/supervisord.conf