# syntax=docker/dockerfile:1.5
FROM nginx:1.24.0-alpine AS nginx

ENV NGINX_ENVSUBST_OUTPUT_DIR=/etc/nginx

RUN apk add --no-cache bash gettext curl

COPY infrastructure/docker/nginx/nginx.conf.template /etc/nginx/templates/nginx.conf.template

COPY app/public /service/app/public
