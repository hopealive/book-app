FROM nginx:stable-alpine

RUN set -x ; \
  addgroup -g 82 -S www-data ; \
  adduser -u 82 -D -S -G www-data www-data && exit 0 ; exit 1

ADD ./images/nginx/nginx.conf /etc/nginx/nginx.conf
ADD ./images/nginx/default.conf /etc/nginx/conf.d/default.conf

RUN mkdir -p /var/www/html

RUN chown www-data:www-data /var/www/html

RUN apk update && apk add bash