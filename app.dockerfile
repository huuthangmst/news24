FROM php:8.1.6-fpm

WORKDIR /var/www

RUN apt-get update && apt-get install -y  \
    libmagickwand-dev \
    --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && docker-php-ext-install pdo_mysql

RUN apt-get install -y nodejs npm

# ENTRYPOINT npm run watch
