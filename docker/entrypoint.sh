#!/bin/sh
set -e

cd /var/www/html

# Ensure runtime dirs are owned by the php-fpm user and writable
chown -R www-data:www-data storage bootstrap/cache database
chmod -R 775 storage bootstrap/cache

# Ensure the SQLite database file exists
[ -f database/database.sqlite ] || touch database/database.sqlite

# Apply pending migrations (graceful: no-op if already migrated)
php artisan migrate --force --graceful || true

# Re-own anything migrations may have created (e.g. SQLite -wal/-shm)
chown -R www-data:www-data database

# Clear stale caches so runtime env (APP_KEY, APP_URL, …) is picked up
php artisan optimize:clear || true

exec /usr/bin/supervisord -c /etc/supervisor/conf.d/supervisord.conf
