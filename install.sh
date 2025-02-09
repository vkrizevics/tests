docker-php-ext-install pdo pdo_mysql
echo "extension=pdo_mysql.so" > /usr/local/etc/php/conf.d/20-pdo_mysql.ini
#service apache2 restart
