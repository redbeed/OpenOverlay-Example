FROM laradock/php-fpm:latest-7.4

WORKDIR /var/www

RUN apt-get update

RUN apt-get -y install libcurl4-openssl-dev \
    libzip-dev \
    libicu-dev

RUN docker-php-ext-install \
    curl \
    iconv \
    tokenizer \
    zip \
    intl

RUN pecl install mongodb
RUN docker-php-ext-enable mongodb

RUN pecl clear-cache

RUN curl -s https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin/ --filename=composer

RUN apt-get update
RUN apt-get install -y wget gnupg g++ locales unzip dialog apt-utils git

RUN curl -sL https://deb.nodesource.com/setup_12.x | bash
RUN apt-get update
RUN apt-get install -y nodejs

RUN apt-get clean

RUN echo "date.timezone=${PHP_TIMEZONE:-UTC}" > $PHP_INI_DIR/conf.d/date_timezone.ini
