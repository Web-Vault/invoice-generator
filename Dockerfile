# Use official PHP + Apache image
FROM php:8.2-apache

# Enable mysqli if using MySQL
RUN docker-php-ext-install mysqli

# Copy your files to Apache root
COPY . /var/www/html/

# Fix permissions (optional)
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
