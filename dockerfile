# Imagen base oficial de PHP con Apache
FROM php:8.3-apache

# Instalar dependencias de sistema y extensiones de PHP
RUN apt-get update && apt-get install -y \
    git unzip libpq-dev libonig-dev libzip-dev zip \
    && docker-php-ext-install pdo pdo_pgsql mbstring zip exif pcntl bcmath

# Habilitar mod_rewrite de Apache (necesario para Laravel)
RUN a2enmod rewrite

# Copiar composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Crear directorio de la app
WORKDIR /var/www/html

# Copiar código
COPY . .

# Instalar dependencias
RUN composer install --no-dev --optimize-autoloader

# Generar cache de Laravel
RUN php artisan config:cache && php artisan route:cache && php artisan view:cache

# Exponer el puerto 80
EXPOSE 80

# Comando por defecto
CMD ["apache2-foreground"]
