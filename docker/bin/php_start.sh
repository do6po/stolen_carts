#!/usr/bin/env bash

chmod +x artisan

composer install --no-progress --prefer-dist --working-dir=/app

php artisan key:generate
php artisan migrate --no-interaction
php artisan db:seed --no-interaction
php artisan cache:clear

php artisan key:generate --env=testing
php artisan migrate --env=testing --no-interaction
php artisan db:seed --env=testing
php artisan cache:clear --env=testing

exec php-fpm --nodaemonize
