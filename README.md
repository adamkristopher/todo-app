# Todo App

A simple Todo application built with Laravel and Vue.js.

## Prerequisites

PHP >= 8.1
Composer
Node.js & NPM
MariaDB
Laravel Valet (for Mac users)

# Installation Steps

## Clone the repository

```sh
clone https://github.com/adamkristopher/todo-app
cd todo-app
```

## Install PHP dependencies

```sh
composer install
```

## Set up environment file

```sh
.env.example .env
php artisan key:generate
```

# Set up MariaDB

## Start MariaDB service

```sh
brew services start mariadb
```

## Secure MariaDB installation

```sh
sudo mysql_secure_installation
```

# Follow the prompts:

## - Set root password

## - Remove anonymous users (Y)

## - Disallow root login remotely (Y)

## - Remove test database (Y)

## - Reload privilege tables (Y)

## Create the database

## Log into MariaDB

```sh
mysql -u root -p
```

## Enter your password when prompted

## Create database

```sh
CREATE DATABASE todo_app;
exit;
```

## Update .env file with database credentials

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todo_app
DB_USERNAME=root
DB_PASSWORD=your_password_here
```

## Create Migration Table

```sh
php artisan migrate:install
```

## Run migrations

```sh
pbp artisan migrate
```

## Install NPM dependencies

```sh
npm install
```

## Start the development server

## If using Valet

```sh
valet park #in directory where project is.
valet link
```

## Or use Laravel's built-in server

```sh
php artisan serve
```

## Your application should now be accessible at:

Valet: http://todo-app.test
Artisan serve: http://localhost:8000

## Development

To start the Vite development server:

```sh
npm run dev
```

## Features

Add tasks
Mark tasks as complete
Delete tasks
