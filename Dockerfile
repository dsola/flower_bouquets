FROM phpunit/phpunit:latest
MAINTAINER David Sola <d.sola.03@gmail.com>

ARG resource_name

WORKDIR /app
COPY . /app
VOLUME ["/app"]

RUN composer install --no-dev --no-interaction -o