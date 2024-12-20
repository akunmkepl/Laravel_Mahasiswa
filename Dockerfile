# Gunakan image PHP resmi
FROM php:8.0-fpm

# Instal ekstensi dan dependensi yang diperlukan
RUN apt-get update && apt-get install -y \
    zip unzip libpng-dev libjpeg-dev libfreetype6-dev libonig-dev libxml2-dev git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Instal Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Atur direktori kerja
WORKDIR /var/www

# Salin file proyek ke dalam container
COPY . .

# Atur izin untuk storage dan cache
RUN chmod -R 775 storage bootstrap/cache

# Instal dependencies Laravel
RUN composer install --no-dev --optimize-autoloader

# Expose port untuk PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]
