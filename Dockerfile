FROM php:8.4-apache

# Install dependencies for PDO and MySQL extension
RUN apt-get update && apt-get install -y \
    libmariadb-dev-compat libmariadb-dev \
    && apt-get clean

# Install PDO and MySQL extensions for PHP
RUN docker-php-ext-install pdo pdo_mysql

# Ensure the pdo_mysql extension is enabled (added explicitly to the conf.d directory)
RUN echo "extension=pdo_mysql.so" > /usr/local/etc/php/conf.d/20-pdo_mysql.ini

# Enable Apache mod_rewrite (optional)
RUN a2enmod rewrite

# Restart Apache to apply changes
RUN service apache2 restart