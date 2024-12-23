# Gunakan image PHP resmi
FROM php:8.0-fpm

# Instal ekstensi dan dependensi yang diperlukan
RUN RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Set working directory
WORKDIR /var/www

# Copy composer.lock and composer.json
COPY composer.json composer.lock ./

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

# Copy project files
COPY . .

# Tahap kedua: Nginx
FROM nginx:alpine

# Copy the Laravel public directory to Nginx's default directory
COPY --from=build /var/www/public /usr/share/nginx/html

# Copy custom Nginx configuration (optional)
COPY nginx/default.conf /etc/nginx/conf.d/default.conf

# Expose port 80
EXPOSE 80

# Start Nginx and PHP-FPM services
CMD ["nginx", "-g", "daemon off;"]
