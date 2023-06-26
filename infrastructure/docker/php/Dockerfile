# syntax=docker/dockerfile:1.5
FROM php:8.2.6-fpm-alpine3.17 AS php-base

ARG UID="1000"
ARG GID="1000"

RUN addgroup --gid "${GID}" "app" && \
    adduser \
    --disabled-password \
    --gecos "" \
    --home "/app-home" \
    --ingroup "app" \
    --uid "${UID}" \
    -s "/bin/sh" \
    "app"

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN apk add --no-cache git bash openssh \
    && IPE_ICU_EN_ONLY=0 install-php-extensions intl pcntl opcache

COPY --from=composer/composer:2.5.4-bin /composer /usr/bin/composer

WORKDIR /service/app

FROM php-base as dev

RUN install-php-extensions xdebug pcov

COPY infrastructure/docker/php/php_conf.dev.ini /usr/local/etc/php/conf.d/999-custom.ini
COPY infrastructure/docker/php/php_fpm.dev.ini /usr/local/etc/php-fpm.conf

USER app
RUN mkdir -p -m 0700 ~/.ssh && ssh-keyscan github.com >> ~/.ssh/known_hosts

FROM php-base as prod

ARG DD_TRACE_HASH="53db57c6e93aaf16c0c2ec80eb237626b29bdf0e807cde83a21277ef9850c325"
ARG DD_TRACE_VERSION="0.86.3"
RUN wget "https://github.com/DataDog/dd-trace-php/releases/download/${DD_TRACE_VERSION}/datadog-setup.php" -O datadog-setup.php \
    && echo "${DD_TRACE_HASH}  datadog-setup.php" | sha256sum -c - \
    && sha256sum datadog-setup.php \
    && php datadog-setup.php --php-bin=all \
    && rm -f datadog-setup.php

COPY --chown=app:app ./app /service/app

RUN mkdir -p /service/app/vendor && chown -R app:app /service/app/vendor \
    && mkdir -p /service/app/var && chown -R app:app /service/app/var

COPY infrastructure/docker/php/php_conf.prod.ini /usr/local/etc/php/conf.d/999-custom.ini
COPY infrastructure/docker/php/php_fpm.prod.ini /usr/local/etc/php-fpm.conf

USER app
RUN mkdir -p -m 0700 ~/.ssh && ssh-keyscan github.com >> ~/.ssh/known_hosts

ENV APP_ENV=prod
ENV APP_DEBUG=0

RUN --mount=type=ssh,uid=$UID composer install --no-dev
