FROM php:8.1-apache

# Copy new.php file into the container
COPY new.php /var/www/html/

# Expose port 80 to the outside world
#EXPOSE 80