# 1. Set the base image.
# FROM php:8.0-apache-bullseye
FROM php:8.1.1-apache

# 2. Install Xdebug.
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# 3. Change the Apache document root.
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

#4. Install packages, extensions and composer.
RUN apt-get update && apt-get upgrade -y && apt-get install -y \
    vim \
    git \
    zlib1g-dev \
    libzip-dev \
    zip \
    unzip \
    libonig-dev \
    && docker-php-ext-install \
    sockets \
    zip \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*
RUN curl -s http://getcomposer.org/installer | php && \
    echo "export PATH=${PATH}:/var/www/vendor/bin" >> ~/.bashrc && \
    mv composer.phar /usr/local/bin/composer

#5. Install the GD library.
RUN apt-get update && apt-get install -y \
    gcc \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libpng-dev \
    make \
    # && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

# 6. Make "npm install" executable on the container for using Vue.js.
# RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - \
# TODO: 要検証!! これでコンテナ内でもnpm runができるかも(現node v12, npm8)
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get update && apt-get install -y \
    nodejs

# 7. Enable mod_rewrite.
RUN a2enmod rewrite

#8. Make postgreSQL accessible from the container.
RUN set -ex apk --no-cache add postgresql-dev libpq-dev && \
    apt-get update && apt-get install -y \
    less \
    libpq-dev \
    postgresql \
    libonig-dev \
    && docker-php-ext-install \
    # mbstring \
    pdo \
    pdo_pgsql \
    pgsql