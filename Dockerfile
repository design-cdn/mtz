# syntax=docker/dockerfile:1

# ─────────────────────────────────────────────────────────────
# Stage 1 — build front-end assets (Vite / Tailwind)
# ─────────────────────────────────────────────────────────────
FROM node:20-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY . .
RUN npm run build
# → produces /app/public/build (content-hashed CSS/JS + manifest.json)

# ─────────────────────────────────────────────────────────────
# Stage 2 — PHP 8.4 runtime (php-fpm + nginx via supervisor)
# ─────────────────────────────────────────────────────────────
FROM php:8.4-fpm-bookworm AS app

# System packages + PHP extensions Laravel needs
RUN apt-get update && apt-get install -y --no-install-recommends \
        nginx supervisor unzip git \
        libicu-dev libzip-dev libonig-dev \
        libpng-dev libjpeg62-turbo-dev libfreetype6-dev libsqlite3-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" \
        pdo_sqlite mbstring bcmath intl zip gd exif opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Install PHP deps first (download only) for better layer caching
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader \
        --prefer-dist --no-interaction

# Application source
COPY . .

# Built assets from stage 1 (public/build is gitignored, so inject it here)
COPY --from=assets /app/public/build ./public/build

# Generate optimized autoloader now that app/ is present
# (--no-scripts: package:discover runs lazily at runtime when env is present)
RUN composer dump-autoload --optimize --no-dev --no-interaction --no-scripts

# Guarantee the writable runtime dirs exist, then hand them to www-data
RUN mkdir -p storage/framework/cache storage/framework/sessions \
        storage/framework/views storage/logs bootstrap/cache \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

# Server config
COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Safe production defaults (Coolify env vars override these at runtime)
ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    SESSION_DRIVER=file \
    CACHE_STORE=file \
    QUEUE_CONNECTION=sync \
    DB_CONNECTION=sqlite \
    DB_DATABASE=/var/www/html/database/database.sqlite

EXPOSE 80

HEALTHCHECK --interval=30s --timeout=5s --start-period=20s --retries=3 \
    CMD php -r '$h=@get_headers("http://127.0.0.1/up"); exit($h && strpos($h[0],"200")!==false ? 0 : 1);'

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
