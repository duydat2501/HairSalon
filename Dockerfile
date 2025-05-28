FROM php:8.1-apache

# Copy code vào container
COPY . /var/www/html/

# Chuyển web root sang thư mục public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf \
    && sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Bật mod_rewrite (nếu bạn dùng .htaccess)
RUN a2enmod rewrite
