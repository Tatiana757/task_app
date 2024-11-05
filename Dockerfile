FROM php:8.2-fpm

RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    unzip \
    git \
    curl \
    supervisor \
    && docker-php-ext-install pdo_pgsql zip

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN pecl install redis && docker-php-ext-enable redis \
    && docker-php-ext-install pcntl

WORKDIR /var/www
COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage

EXPOSE 9000

CMD ["sh", "-c", "php-fpm && php artisan horizon "]