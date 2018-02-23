FROM php:7.0-zts-alpine3.4
MAINTAINER Klevialent <klevialent@gmail.com>

RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install pthreads \
    && apk del $PHPIZE_DEPS

RUN wget https://phar.phpunit.de/phpunit-6.5.phar \
    && chmod +x phpunit-6.5.phar \
    && mv phpunit-6.5.phar /usr/local/bin/phpunit

WORKDIR "/app/examples/app"

CMD ["php", "-a"]
