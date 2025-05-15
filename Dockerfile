FROM php:8.2-cli

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
    unzip zip sqlite3 libsqlite3-dev libzip-dev git curl \
    && docker-php-ext-install pdo pdo_sqlite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

CMD php artisan serve --host=0.0.0.0 --port=8000
