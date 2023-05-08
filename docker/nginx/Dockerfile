FROM nginx:1.19-alpine

RUN apk add openssl \
    && mkdir -p /etc/ssl/private \
    && openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
    -subj '/CN=localhost' \
    -keyout /etc/ssl/private/ssl-cert-snakeoil.key \
    -out /etc/ssl/certs/ssl-cert-snakeoil.pem

COPY ./docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY . /var/www/html

EXPOSE 80 443
