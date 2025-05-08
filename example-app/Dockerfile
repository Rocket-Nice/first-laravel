# Базовый образ (PHP 8.2 + FPM)
FROM php:8.2-fpm  

# Установка зависимостей (git, curl, библиотеки для PHP)
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Установка Composer (менеджер пакетов для PHP)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Рабочая папка (здесь будет лежать Laravel)
WORKDIR /var/www/html