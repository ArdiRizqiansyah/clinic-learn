<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Klinik Project

## Setup Project Backend

Run the following command to run setup project.

```bash
cp .env.example .env

composer install

npm install

php artisan key:generate

php artisan storage:link
```

## Run App

Run the following command to run the app.

```bash
php artisan serve

npm run dev
```

## Build Vite

```bash
npm run build
```

## Migrations

Run the following command to run startup migrations.

```bash
php artisan migrate
```

## Seeders

Run the following command to run startup seeders.

```bash
php artisan db:seed
```

## Setup Project Front End

Run the following command to run setup project.

```bash

npm install