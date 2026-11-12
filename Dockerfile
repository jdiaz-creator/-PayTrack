# ==========================================
# JOLERY PAYTRACK V2 - RENDER DEPLOYMENT
# ==========================================
FROM node:20-alpine AS frontend
WORKDIR /app
COPY . .
RUN npm install && npm run build

FROM php:8.2-apache
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libpng-dev libjpeg62-turbo-dev libfreetype6-dev libicu-dev libonig-dev libssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl opcache \
    && pecl install mongodb && docker-php-ext-enable mongodb \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY . .
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader
COPY --from=frontend /app/public/build ./public/build

RUN set -eux; \
    a2dismod -f mpm_event mpm_worker; \
    a2enmod mpm_prefork rewrite headers; \
    apache2ctl configtest

RUN set -eux; \
    sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf; \
    printf '<Directory /var/www/html/public>\nAllowOverride All\nRequire all granted\n</Directory>\n' >> /etc/apache2/apache2.conf; \
    apache2ctl configtest

# FIX 419: Tanggalin ang lumang cache na naka-commit
RUN rm -f bootstrap/cache/config.php bootstrap/cache/routes-*.php bootstrap/cache/services.php \
    && mkdir -p storage/framework/sessions storage/framework/views storage/framework/cache storage/framework/cache/data storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

ENV PORT=10000
EXPOSE 10000

# FIX 419: Clear cache BAWAT START, bago mag Apache
CMD ["sh", "-c", "sed -i \"s/Listen 80/Listen ${PORT:-10000}/\" /etc/apache2/ports.conf && sed -i \"s/:80>/:${PORT:-10000}>/\" /etc/apache2/sites-available/000-default.conf && rm -f bootstrap/cache/config.php && php artisan config:clear && php artisan cache:clear && php artisan view:clear && php artisan route:clear && exec apache2-foreground"]