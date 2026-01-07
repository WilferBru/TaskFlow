# ===============================
# Stage 1: Build (Composer)
# ===============================
FROM composer:2 AS builder

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

COPY . .

RUN composer dump-autoload --optimize


# ===============================
# Stage 1: Build (Composer)
# ===============================
FROM php:8.3-fpm

# Dependencias del sistema
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    unzip \
    && docker-php-ext-install pdo pdo_pgsql zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*


WORKDIR /var/www/html

# Copiar app ya construida
COPY --from=builder /app /var/www/html

# Permisos Laravel
RUN chown -R www-data:www-data \
    storage bootstrap/cache

# PHP-FPM es el proceso principal
CMD ["php-fpm"]
