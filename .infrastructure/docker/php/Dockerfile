FROM php:8.2.4-fpm-alpine3.17 as base

RUN apk --update --no-cache add \
  bzip2 \
  bzip2-dev \
  curl-dev \
  libxml2-dev \
  libxslt-dev \
  postgresql-dev \
  libzip-dev \
  vim \
  make \
  fcgi \
  # bugfix
  && sed -i 's/$this-_/$this->_/g' /usr/local/lib/php/OS/Guess.php \
  && docker-php-ext-enable opcache \
  && docker-php-ext-install -j "$(nproc)" bcmath bz2 pdo_pgsql pgsql zip \
  && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY .infrastructure/docker/php/php.ini /usr/local/etc/php/conf.d/custom_php.ini

WORKDIR /var/www/html
COPY . .
USER root
RUN chown -R www-data:www-data .
USER www-data
USER root
# install xdebug
RUN apk --update --no-cache add pcre-dev linux-headers ${PHPIZE_DEPS}
RUN pecl install xdebug \
  && docker-php-ext-enable xdebug

USER www-data

RUN composer install
