FROM php:8.2-apache

# Copy toàn bộ mã nguồn vào thư mục gốc của Apache
COPY . /var/www/html/

# Cấp quyền truy cập cho Apache
RUN chown -R www-data:www-data /var/www/html

# Bật các module cần thiết nếu dùng
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Mặc định Apache sẽ chạy trên port 80
EXPOSE 80
