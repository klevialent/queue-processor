FROM php:7.0-zts-alpine3.4
MAINTAINER Klevialent <klevialent@gmail.com>

RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install pthreads \
    && apk del $PHPIZE_DEPS

WORKDIR "/app/examples/app"

CMD ["php", "-a"]
