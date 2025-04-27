# Usar una imagen base de PHP 8.2 con FPM
FROM php:8.2-fpm

# Instalar dependencias del sistema y extensiones de PHP necesarias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libicu-dev \
    libzip-dev \
    && docker-php-ext-install pdo_mysql intl zip

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer el directorio de trabajo
WORKDIR /var/www

# Copiar el proyecto al contenedor
COPY . /var/www

# Instalar dependencias de Composer
RUN composer install --no-interaction --optimize-autoloader

# Dar permisos adecuados
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/var

# Exponer el puerto (si usas PHP-FPM, normalmente no necesitas esto)
EXPOSE 9000

# Comando por defecto
CMD ["php-fpm"]