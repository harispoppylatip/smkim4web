# syntax=docker/dockerfile:1

# ---------------------------------------------------------------------------
# SMK Muhammadiyah 4 Samarinda - Web Portal
# ---------------------------------------------------------------------------

# ---------------------------------------------------------------------------
# Tahap 1: Kompilasi Aset Frontend (Vite & Tailwind)
# ---------------------------------------------------------------------------
FROM node:22-alpine AS aset

WORKDIR /app

COPY package.json package-lock.json* ./

RUN npm install --no-audit --no-fund

COPY . .
RUN npm run build

# ---------------------------------------------------------------------------
# Tahap 2: Dependensi PHP (Composer)
# ---------------------------------------------------------------------------
FROM composer:2 AS composer

FROM php:8.5-cli-alpine AS vendor

COPY --from=composer /usr/bin/composer /usr/local/bin/composer

RUN apk add --no-cache unzip git

WORKDIR /app

COPY composer.json composer.lock ./

RUN composer install \
        --no-dev \
        --no-scripts \
        --no-autoloader \
        --prefer-dist \
        --no-interaction \
        --no-progress

# ---------------------------------------------------------------------------
# Tahap 3: Aplikasi Utama (PHP-FPM)
# ---------------------------------------------------------------------------
FROM php:8.5-fpm-alpine AS app

RUN apk add --no-cache su-exec tzdata libcurl oniguruma

RUN set -eux; \
    apk add --no-cache --virtual .bangun $PHPIZE_DEPS oniguruma-dev curl-dev; \
    if ! php -m | grep -qix mbstring; then docker-php-ext-install -j"$(nproc)" mbstring; fi; \
    if ! php -m | grep -qix curl; then docker-php-ext-install -j"$(nproc)" curl; fi; \
    docker-php-ext-install -j"$(nproc)" pdo_mysql pcntl; \
    apk del .bangun

COPY docker/php/php.ini /usr/local/etc/php/conf.d/zz-smkim4.ini
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

WORKDIR /var/www/html

COPY --from=vendor /app/vendor ./vendor
COPY --from=composer /usr/bin/composer /usr/local/bin/composer

COPY . .
COPY --from=aset /app/public/build ./public/build

RUN composer dump-autoload --no-dev --optimize --classmap-authoritative --no-interaction

RUN set -eux; \
    mkdir -p \
        storage/app/private \
        storage/app/public \
        storage/framework/cache/data \
        storage/framework/sessions \
        storage/framework/views \
        storage/logs \
        bootstrap/cache; \
    chown -R www-data:www-data storage bootstrap/cache

EXPOSE 9000

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["php-fpm"]

# ---------------------------------------------------------------------------
# Tahap 4: Web Server (Nginx)
# ---------------------------------------------------------------------------
FROM nginx:1.29-alpine AS web

COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY --from=aset /app/public /var/www/html/public

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
