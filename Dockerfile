FROM php:8-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite && service apache2 restart
