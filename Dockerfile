FROM php:7.4-apache

RUN docker-php-ext-install mysqli

RUN a2enmod rewrite

RUN mkdir -p /var/www/html/uploads \
    && chown -R www-data:www-data /var/www/html \
    && chmod -R 777 /var/www/html
