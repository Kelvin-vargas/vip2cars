# Imagen oficial de PHP con extensiones necesarias
FROM php:8.3-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    && docker-php-ext-install pdo_mysql pdo_pgsql mbstring exif pcntl bcmath gd

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Establecer directorio de trabajo
WORKDIR /var/www

# Copiar archivos
COPY . .

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Dar permisos de escritura a storage y bootstrap
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Puerto que expondrá
EXPOSE 8000

# Comando para arrancar Laravel con su servidor embebido
CMD php artisan serve --host=0.0.0.0 --port=8000
