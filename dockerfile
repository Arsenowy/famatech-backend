FROM php:7.4.2-apache

# Install Xdebug
RUN apt-get update && \
  apt-get upgrade -y && \
  apt-get install -y git libxml2-dev libcurl4-openssl-dev zlib1g-dev libpng-dev libonig-dev libcurl4-openssl-dev zip unzip
RUN pecl install -f xdebug
RUN docker-php-ext-install pdo_mysql gd xml curl opcache mysqli
RUN docker-php-ext-enable xdebug
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN a2enmod rewrite
RUN service apache2 restart
WORKDIR /var/www/html

ADD php.ini /usr/local/etc/php