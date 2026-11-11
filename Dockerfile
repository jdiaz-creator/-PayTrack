
FROM node:20-alpine AS frontend

WORKDIR /app

COPY . .

RUN npm install && npm run build


FROM php:8.2-apache

# Install PHP dependencies
RUN apt-get update && apt-get install -y \
    git unzip curl \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libicu-dev \
    libonig-dev \
    libssl-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip intl opcache \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Copy compiled frontend assets
COPY --from=frontend /app/public/build ./public/build

# Fix Apache MPM conflict
# Disable event and worker, and use prefork only
RUN set -eux; \
    a2dismod -f mpm_event mpm_worker; \
    a2enmod mpm_prefork rewrite headers; \
    apache2ctl configtest

# Configure Apache for Laravel
RUN set -eux; \
    sed -ri 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf; \
    printf '<Directory /var/www/html/public>\nAllowOverride All\nRequire all granted\n</Directory>\n' >> /etc/apache2/apache2.conf; \
    chown -R www-data:www-data storage bootstrap/cache; \
    chmod -R 775 storage bootstrap/cache; \
    apache2ctl configtest

# Railway port
ENV PORT=10000

EXPOSE 10000

# Start Apache
CMD ["sh", "-c", "sed -i \"s/Listen 80/Listen ${PORT}/\" /etc/apache2/ports.conf && sed -i \"s/:80>/:${PORT}>/\" /etc/apache2/sites-available/000-default.conf && apache2-foreground"]
