FROM php:8.0-fpm-alpine3.13

RUN apk upgrade --update \
    && apk --no-cache add icu-dev autoconf make g++ gcc curl libzip-dev

RUN docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install pdo_mysql zip opcache sockets

# composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# conf
COPY ./docker/php-fpm/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./docker/php-fpm/conf.d/customize.ini /usr/local/etc/php/conf.d/customize.ini

# Composer install
COPY composer.* /var/www/html/
RUN composer install --working-dir=/var/www/html --no-scripts --no-autoloader

# app
COPY . /var/www/html
WORKDIR /var/www/html

RUN composer dump-autoload --working-dir=/var/www/html --no-scripts

RUN set -eux \
    && chmod -R a=rwX storage/ bootstrap/cache \
    && cp .env.example .env \
    && php artisan config:clear \
    && php artisan route:cache \
    && php artisan view:cache
EXPOSE 9000
