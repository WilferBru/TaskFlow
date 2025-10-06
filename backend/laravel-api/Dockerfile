# Imagen base de php con FPM
FROM php:8.2-fpm

# Instalar herramientas necesarias y extensiones de PHP
RUN apt-get update && apt-get install -y \
    libpq-dev \
    git \
    unzip \
    curl \
    libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql zip

# Instalar composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Directorio de trabajo
WORKDIR /var/www/html

# Copiar todo el proyecto primero
COPY . .

# Instalar dependencias sin scripts para evitar errores con artisan
RUN composer install --no-scripts --no-interaction

# Comando por defecto al levantar el contenedor
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]