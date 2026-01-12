# Usar imagen base PHP con extensiones y configuraciones preinstaladas
FROM imagen-base-php:latest

# Copiar archivos de Composer para instalar dependencias
COPY composer.json composer.lock ./

# Instalar dependencias de Composer
RUN composer install --no-dev --prefer-dist --no-scripts --no-progress --no-interaction

# Copiar el resto del código
COPY . .

# Optimizar autoload
RUN composer dump-autoload --optimize

# Asegurar permisos
RUN chown -R www-data:www-data /var/www/html \
 && find /var/www/html -type f -exec chmod 644 {} \; \
 && find /var/www/html -type d -exec chmod 755 {} \;

# Ejecutar como usuario no root
USER www-data

CMD ["php-fpm"]

