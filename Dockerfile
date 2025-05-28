FROM php:8.2-apache

# Cài thêm extension nếu cần
RUN docker-php-ext-install pdo pdo_mysql

# Copy toàn bộ source code vào thư mục mặc định của Apache
COPY . /var/www/html/

# Cấp quyền cho apache user
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Mở port 80
EXPOSE 80

# Khởi động Apache
CMD ["apache2-foreground"]
