# TODO APP SETUP INSTRUCTIONS

## Prerequisites:

-   PHP >= 8.1
-   Composer
-   Node.js >= 18.0.0
-   npm >= 9.0.0
-   MariaDB

1. Clone and Initial Setup

---

```sh
git clone https://github.com/adamkristopher/todo-app
cd todo-app
```

# Install dependencies

```sh
composer install
```

# Publish Sanctum configuration

```sh
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"
```

# Generate application key

```sh
php artisan key:generate

cp .env.example .env
php artisan key:generate
```

2. Database Setup

---

# Start MariaDB

```sh
brew services start mariadb
```

# Create Database

```sh
mysql -u root -p
CREATE DATABASE todo_app;
exit;
```

3. Environment Configuration

---

# Update .env file with these settings:

```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=todo_app
DB_USERNAME=root
DB_PASSWORD=root

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_DOMAIN=127.0.0.1
SESSION_SECURE_COOKIE=false
SESSION_SAME_SITE=lax
APP_URL=http://127.0.0.1:8000
SANCTUM_STATEFUL_DOMAINS=127.0.0.1:8000
```

4. Setup Application

---

# Install NPM dependencies

```sh
npm install
```

# Run database migrations

```sh
php artisan migrate
```

# Clear configuration cache

```sh
php artisan config:clear
php artisan route:clear
php artisan cache:clear
```

5. Start Development Servers

---

# Start Vite development server

```sh
npm run dev
```

# Serve the application:

```sh
php artisan serve
```

6. Access the Application

---

http://127.0.0.1:8000

7. Troubleshooting

---

If you encounter any issues:

1. Make sure all services are running:

    - MariaDB
    - PHP
    - Node/NPM

2. Verify permissions:

    - Storage directory is writable
    - Bootstrap/cache directory is writable

3. Clear all caches:

```sh
    php artisan config:clear
    php artisan route:clear
    php artisan cache:clear
```

4. Check logs:

```sh
    tail -f storage/logs/laravel.log
```

5. If authentication issues persist:
    - Clear browser cookies and cache
    - Ensure all Laravel Sanctum configurations are correct
    - Verify session and CSRF token handling

## Common Issues:

1. Database connection fails:

    - Verify MariaDB is running
    - Check database credentials in .env
    - Ensure database exists

2. 401 Unauthorized errors:

    - Clear browser cookies
    - Verify CSRF token is being sent
    - Check Sanctum configuration
    - Ensure session is being maintained

3. Asset compilation fails:
    - Delete node_modules and reinstall
    - Clear NPM cache
    - Check for Node.js version compatibility

## Required PHP Extensions:

-   PHP >= 8.1
-   BCMath PHP Extension
-   Ctype PHP Extension
-   JSON PHP Extension
-   Mbstring PHP Extension
-   OpenSSL PHP Extension
-   PDO PHP Extension
-   Tokenizer PHP Extension
-   XML PHP Extension

Note: After making any configuration changes, always clear config cache and restart the server.

```

```
