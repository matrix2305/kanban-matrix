FROM php:8.2-apache-buster

USER root

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \
        sqlite3 \
        libsqlite3-dev \
        libpng-dev \
        libjpeg-dev \
        libmagick++-dev \
        libmagickwand-dev \
        zlib1g-dev \
        apt-utils \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        zip \
        curl \
        unzip \
        librabbitmq-dev \
        libssh-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg=/usr/include/ --enable-gd \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install zip \
    && pecl bundle -d /usr/src/php/ext redis \
    && rm /usr/src/php/ext/redis-*.tgz \
    && docker-php-ext-install redis \
    && docker-php-ext-install soap \
    && docker-php-ext-configure opcache --enable-opcache \
    && docker-php-ext-install opcache \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install exif \
    && docker-php-source delete \
    && docker-php-ext-install sockets

#RUN pecl install xdebug-3.1.1 \
#    && docker-php-ext-enable xdebug

RUN cd /usr/local/etc/php/conf.d/ && \
  echo 'memory_limit = -1' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini

COPY /dockerfiles/apache/vhost.conf /etc/apache2/sites-available/000-default.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN chown -R www-data:www-data /var/www/ && \
    a2enmod rewrite

WORKDIR /var/www/html
EXPOSE 80
EXPOSE 443
