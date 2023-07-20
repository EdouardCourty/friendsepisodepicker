FROM php:8.2-fpm-bullseye

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/project

RUN apt update && apt install -y \
    vim \
    git \
    libzip-dev \
    libicu-dev \
    zip \
    libssh-dev \
    make \
    libcurl3-dev \
    libgmp-dev \
    libpq-dev

COPY docker/php-fpm/php-fpm.conf /usr/local/etc/php-fpm.conf
COPY docker/php/xdebug.ini /usr/local/etc/php/conf.d
COPY docker/php/php.ini /usr/local/etc/php/php.ini
COPY docker/php/opcache.ini /usr/local/etc/php/conf.d

RUN docker-php-ext-install \
    zip \
    bcmath \
    intl \
    curl \
    gmp \
    opcache

RUN useradd -ms /bin/bash friendspicker
RUN usermod -u 1000 friendspicker

RUN touch /var/log/php-fpm.error.log
RUN touch /var/log/php-fpm.access.log

RUN chown -R friendspicker:friendspicker /var/log/php-fpm.error.log /var/log/php-fpm.access.log

USER friendspicker

CMD ["php-fpm"]
