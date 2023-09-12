#!/bin/sh

if [ ! -f ".env" ]; then
    echo "copy env file"
    cp .env.example .env
fi

if [ ! -f "vendor/autoload.php" ]; then
    echo "composer install"
    composer install --no-interaction
fi

php artisan key:gen
php artisan migrate

php artisan config:clear
php artisan event:clear
php artisan route:clear
php artisan route:clear

php artisan serve --host=0.0.0.0 --port=${PORT}

exec "$@"