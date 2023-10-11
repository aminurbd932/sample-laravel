FROM php:8.1.0-fpm

# Copy php.ini
COPY /apache/php.ini /usr/local/etc/php/php.ini

# Copy composer.lock and composer.json
COPY /bs23-app/composer.json /var/www/html

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt update && apt install -y && apt-get install tcpdump -y && apt-get install net-tools -y && apt-get install nano -y \
        nodejs \
        npm \
        libpng-dev \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libonig-dev \
        zip \
        curl \
        unzip 

# Install extensions
RUN docker-php-ext-configure gd 
RUN docker-php-ext-install -j$(nproc) gd 
RUN docker-php-ext-install pdo_mysql 
RUN docker-php-ext-install mysqli 
RUN docker-php-ext-install zip 
RUN docker-php-source delete   

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Add user for laravel application
#RUN groupadd -g 1000 www
#RUN useradd -u 1000 -ms /bin/bash -g www www

# Copy existing application directory contents
COPY ./bs23-app .

# Copy existing application directory permissions
#COPY --chown=www:www . /var/www

# Change current user to www
#USER www

RUN composer install

#RUN php artisan key:generate --force;

RUN composer require predis/predis

# Expose port 9500 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]


