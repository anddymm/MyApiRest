FROM php:8.3-apache

RUN apt-get update && apt-get install -y unzip git \
    && docker-php-ext-install pdo pdo_mysql \
    && a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

RUN composer install --no-dev --optimize-autoloader

EXPOSE 80
CMD ["apache2-foreground"]
