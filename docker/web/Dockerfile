FROM php:8.1.2-apache

ENV COMPOSER_VERSION 2.0.8

RUN apt-get update -y -q && \
    apt-get install -y -q libicu-dev zip unzip ssh vim less git && \
    a2enmod rewrite && \
    docker-php-ext-install pdo_mysql mysqli intl && \
    curl -sS https://getcomposer.org/installer | php -- --version=$COMPOSER_VERSION && \
    mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/current/
