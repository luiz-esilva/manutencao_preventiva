FROM php:8.2-apache
WORKDIR /var/www/html
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN apt-get update && \
apt-get install -y git libcurl4-openssl-dev pkg-config libssl-dev && \
docker-php-ext-install curl
EXPOSE 80
RUN composer require phpmailer/phpmailer
CMD ["apache2-foreground"]