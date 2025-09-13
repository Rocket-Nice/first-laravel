<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development/)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).







# Laravel + Docker Starter

Проект для быстрого разворачивания Laravel-приложения в Docker-окружении.

## # Установка Docker (если ещё нет)

sudo apt update  
sudo apt install docker.io docker-compose-plugin  
sudo systemctl enable --now docker  
sudo usermod -aG docker $USER  
newgrp docker  # Применить изменения группы без перезагрузки

# Создание проекта Laravel
bash
composer create-project laravel/laravel example-app  
cd example-app

# Настройка Docker
Создайте файлы в корне проекта:

Dockerfile:
--- Базовый образ (PHP 8.2 + FPM)
FROM php:8.2-fpm  

--- Установка зависимостей (git, curl, библиотеки для PHP)
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

--- Установка Composer (менеджер пакетов для PHP)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

--- Рабочая папка (здесь будет лежать Laravel)
WORKDIR /var/www/html


# docker-compose.yml:
version: '3.8'

services:
  --- Контейнер с PHP (Laravel)
  app:
    build: .  # Собирает из Dockerfile
    volumes:
      - ./:/var/www/html  # Синхронизация кода Laravel
    ports:
      - "8000:8000"  # Проброс порта для artisan serve
    depends_on:
      - mysql  # Ждёт запуска MySQL
    environment:
      DB_HOST: mysql  # Переменные для Laravel (.env)
      DB_PORT: 3306
      DB_DATABASE: laravel
      DB_USERNAME: root
      DB_PASSWORD: secret

  --- Контейнер с MySQL
  mysql:
    image: mysql:8.0  # Готовый образ MySQL
    environment:
      MYSQL_ROOT_PASSWORD: secret  # Пароль root
      MYSQL_DATABASE: laravel  # Автоматическое создание БД
    volumes:
      - mysql_data:/var/lib/mysql  # Сохранение данных БД
    ports:
      - "3307:3306"  # Доступ к MySQL с хоста (через 3307)

  --- Контейнер с phpMyAdmin (веб-интерфейс для MySQL)
  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    ports:
      - "8080:80"  # Доступ через http://localhost:8080
    environment:
      PMA_HOST: mysql  # Подключение к MySQL-контейнеру

--- Настройки сети и томов
networks:
  laravel_network:  # Сеть для связи контейнеров
volumes:
  mysql_data:  # Постоянное хранилище для MySQL

# Настройка .env
Замените в файле .env следующие строки:

env
DB_CONNECTION=mysql  
DB_HOST=mysql  
DB_PORT=3306  
DB_DATABASE=laravel  
DB_USERNAME=root  
DB_PASSWORD=secret

# Запуск проекта
# Собрать и запустить контейнеры
docker-compose up -d --build

# Установить зависимости PHP
docker-compose exec app composer install

# Сгенерировать ключ приложения
docker-compose exec app php artisan key:generate

# Выполнить миграции
docker-compose exec app php artisan migrate

# Обновить существующую миграцию (удалит нынешние данные!)
docker-compose exec app php artisan migrate:fresh

# Запустить сервер разработки
docker-compose exec app php artisan serve --host=0.0.0.0 --port=8000

# Полезные команды
Команда	Описание
docker-compose ps	Статус контейнеров
docker-compose logs -f	Просмотр логов
docker-compose exec app bash	Войти в контейнер
docker-compose down	Остановить проект
docker-compose exec app php artisan tinker	Запустить Tinker

# Доступ к сервисам
Laravel: http://localhost:8000

phpMyAdmin: http://localhost:8080
Логин: root
Пароль: secret

# Дополнительные настройки (по желанию)
Для разработки с Hot-Reload добавьте в docker-compose.yml:

yaml
app:  
  environment:  
    - NODE_ENV=development
Установите Node.js зависимости:

bash
docker-compose exec app npm install  
docker-compose exec app npm run dev
Если нужно остановить проект:

bash
docker-compose down
# С данными БД:
docker-compose down --volumes


# sanctum
docker-compose exec app composer require laravel/sanctum
docker-compose exec app php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
docker-compose exec app php artisan migrate