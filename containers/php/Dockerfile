FROM php:7-fpm

# Install opcache apcu
RUN docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install opcache \
    && pecl install apcu

RUN apt-get update && apt-get install -y \
        libzip-dev \
        zip \
  && docker-php-ext-configure zip --with-libzip \
  && docker-php-ext-install zip \
  && docker-php-ext-enable zip

# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

# Add custom ini configurations
COPY opcache.ini $PHP_INI_DIR/conf.d/
COPY apc.ini $PHP_INI_DIR/conf.d/

# mark volume/s as externally mounted
VOLUME ["/var/www"]

# starting point
WORKDIR /var/www

# make web server connect to this port
EXPOSE 9000

CMD ["php-fpm"]
