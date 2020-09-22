FROM php:7.4-fpm-alpine

RUN apk --update add wget \
		     curl \
		     git \
             bash

RUN docker-php-ext-install pdo pdo_mysql

RUN mkdir -p /var/www/html
RUN chown www-data:www-data /var/www/html


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

WORKDIR /var/www/html
