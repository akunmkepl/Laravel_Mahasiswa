FROM php:8.0-fpm

# Set Working Directory
WORKDIR /var/www/laraveldocker

# Copy Composer Files
COPY composer.json composer.lock /var/www/laraveldocker/

# Install Required Packages
RUN apt-get update && apt-get install -y --no-install-recommends \
    build-essential \
    mariadb-client \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    jpegoptim \
    optipng \
    pngquant \
    gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev \
    zip && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP Extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install pdo pdo_mysql gd zip

# Install Composer
RUN mkdir -p /usr/local/bin && chmod -R 777 /usr/local/bin && \
    curl -sS https://getcomposer.org/installer -o composer-setup.php && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    rm composer-setup.php

# Add User
RUN groupadd -g 1000 www && \
    useradd -u 1000 -ms /bin/bash -g www www

# Copy Project Files
COPY . /var/www/laraveldocker
RUN composer install --no-dev --optimize-autoloader
RUN chmod -R 775 /var/www/laraveldocker/storage /var/www/laraveldocker/bootstrap/cache
RUN cp .env.example .env && php artisan key:generate
RUN php artisan config:clear && php artisan cache:clear && php artisan view:clear
RUN chown -R www:www /var/www/laraveldocker

# Switch to Non-root User
USER www

# Expose Port and Start PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]
