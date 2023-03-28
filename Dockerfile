# Use the latest stable version of PHP as the base image
FROM php:8.1-apache

# Update the package list and install necessary packages
RUN apt-get update && \
    apt-get install -y \
        curl \
        git \
        unzip \
        libpq-dev \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        libzip-dev \
        npm \
    && docker-php-ext-install \
        pdo \
        pdo_mysql \
        pgsql \
        bcmath \
        gd \
        zip \
        opcache \
        exif \
    && a2enmod rewrite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory
WORKDIR /var/www/html

# Copy the Laravel application files to the container
COPY . .

# Install the application dependencies
RUN composer install --no-dev --prefer-dist --no-scripts -o

RUN composer require --dev nunomaduro/collision

# Install Node.js dependencies
RUN npm install

# Build front-end assets
RUN npm run dev

# Configure Apache to serve Laravel
COPY docker/apache2.conf /etc/apache2/sites-available/000-default.conf
RUN sed -i 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Set the ownership and permissions for the application files
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

# Expose port 80 (Apache's default port)
EXPOSE 80

# Start Apache in the foreground when the container starts
CMD ["apache2-foreground"]
