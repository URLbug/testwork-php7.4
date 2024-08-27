FROM php:7.4-fpm

WORKDIR /var/www/

RUN docker-php-ext-install pdo pdo_mysql && apt-get update && apt-get install -y git && apt-get install -y zip && apt-get install -y unzip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer