FROM php:7.4-fpm

RUN cd /usr/bin && curl -s http://getcomposer.org/installer | php && ln -s /usr/bin/composer.phar /usr/bin/composer
RUN apt-get update && apt-get install -y git zip unzip vim libonig-dev libsodium-dev libjpeg-dev libfreetype6-dev libzip-dev

RUN docker-php-ext-install pdo_mysql mbstring sodium zip bcmath
RUN docker-php-ext-enable pdo_mysql mbstring sodium zip bcmath
RUN docker-php-ext-install -j$(nproc) gd

RUN pecl install xdebug \
   && docker-php-ext-enable xdebug

RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs
RUN npm install npm@latest -g
RUN npm install webpack

WORKDIR /var/www
