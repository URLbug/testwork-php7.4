FROM composer:2

WORKDIR /var/www/

ENTRYPOINT ["composer", "--ignore-platform-reqs"]