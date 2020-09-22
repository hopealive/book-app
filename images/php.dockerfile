FROM php:7.4-fpm-alpine

RUN mkdir -p /var/www/html

RUN chown www-data:www-data /var/www/html

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql