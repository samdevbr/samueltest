FROM php:7.3-fpm

USER root

RUN apt-get update && \
    apt-get install git -yqq && \
    apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev -yqq && \
    pecl install mongodb && \
    docker-php-ext-enable mongodb && \
    apt-get install -yqq libzip-dev zip unzip && \
    docker-php-ext-configure zip --with-libzip && \
    docker-php-ext-install zip && \
    php -m | grep -q 'zip' && \
    apt-get install curl && \
    curl -s https://getcomposer.org/installer | php && \
    mv composer.phar /usr/bin/composer

WORKDIR /var/www/html

RUN groupadd -g 1000 php-user && \
    useradd -u 1000 -g php-user -m php-user && \
    usermod -p "*" php-user -s /bin/bash && \
    chown -R php-user:php-user /var/www/html

EXPOSE 9000

CMD [ "docker-php-entrypoint", "php-fpm" ]
