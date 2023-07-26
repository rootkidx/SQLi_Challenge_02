FROM php:8-apache

WORKDIR /var/www/html

COPY index.php /var/www/html/

RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli


CMD ["apache2-foreground"]
