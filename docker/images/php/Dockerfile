# Для начала указываем исходный образ, он будет использован как основа
FROM php:7.4-fpm

ENV DEBIAN_FRONTEND noninteractive

#COPY bin/* /usr/local/bin/
#RUN chmod -R 700 /usr/local/bin/

USER root

# Locales
RUN apt-get update \
    && apt-get install -y locales

RUN dpkg-reconfigure locales \
    && locale-gen C.UTF-8 \
    && /usr/sbin/update-locale LANG=C.UTF-8

RUN echo 'en_US.UTF-8 UTF-8' >> /etc/locale.gen \
    && locale-gen

ENV LC_ALL C.UTF-8
ENV LANG en_US.UTF-8
ENV LANGUAGE en_US.UTF-8

# Common
RUN apt-get update \
    && apt-get install -y \
        openssl \
        git \
        gnupg2


# PHP
# intl
RUN apt-get update \
    && apt-get install -y libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) intl

# xml
RUN apt-get update \
    && apt-get install -y \
    libxml2-dev \
    libxslt-dev \
    && docker-php-ext-install -j$(nproc) \
        dom \
        xmlrpc \
        xsl

# images
RUN apt-get update \
    && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libgd-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) \
        gd \
        exif

# database
RUN docker-php-ext-install -j$(nproc) \
    mysqli \
    pdo \
    pdo_mysql

# strings
RUN apt-get update \
    && apt-get install -y libonig-dev \
    && docker-php-ext-install -j$(nproc) \
       gettext \
       mbstring

# math
RUN apt-get update \
    && apt-get install -y libgmp-dev \
    && ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/include/gmp.h \
    && docker-php-ext-install -j$(nproc) \
        gmp \
        bcmath

# compression
RUN apt-get update \
    && apt-get install -y \
    libbz2-dev \
    zlib1g-dev \
    libzip-dev \
    && docker-php-ext-install -j$(nproc) \
        zip \
        bz2

# Install composer and put binary into $PATH
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/ \
    && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

# Install PHP Code sniffer
RUN curl -OL https://squizlabs.github.io/PHP_CodeSniffer/phpcs.phar \
    && chmod 755 phpcs.phar \
    && mv phpcs.phar /usr/local/bin/ \
    && ln -s /usr/local/bin/phpcs.phar /usr/local/bin/phpcs \
    && curl -OL https://squizlabs.github.io/PHP_CodeSniffer/phpcbf.phar \
    && chmod 755 phpcbf.phar \
    && mv phpcbf.phar /usr/local/bin/ \
    && ln -s /usr/local/bin/phpcbf.phar /usr/local/bin/phpcbf

# Install NodeJS, NPM
RUN curl -sL https://deb.nodesource.com/setup_12.x | bash - \
    && apt-get install -y nodejs

# Install Yarn
RUN curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - \
    && echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list \
    && apt-get update && apt-get install -y yarn

# Добавим свой php.ini, можем в нем определять свои значения конфига
ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini

RUN usermod -u 1000 www-data
USER www-data

# Указываем рабочую директорию для PHP
WORKDIR /var/www
#RUN chown -R www-data:www-data /var/www
#RUN chmod -R 755 ../storage
# Запускаем контейнер
# Из документации: The main purpose of a CMD is to provide defaults for an executing container. These defaults can include an executable,
# or they can omit the executable, in which case you must specify an ENTRYPOINT instruction as well.
CMD ["php-fpm"]

# Clean
#RUN apt-get clean
#RUN rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /var/cache/*
