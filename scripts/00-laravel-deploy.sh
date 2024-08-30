#!/usr/bin/env bash
echo "Removing Composer 1 (if exists)..."
sudo rm /usr/local/bin/composer || true

echo "Installing Composer 2..."
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '48e5c1f486a157c8301f524ddbaeac9f847b5a29e0b0c9719b1cf2c4fb14129d6a1d503e1a191dcf5072268b4c7bb8d6') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php --install-dir=/usr/local/bin --filename=composer
php -r "unlink('composer-setup.php');"

echo "Running composer with Composer 2..."
composer install --no-dev --prefer-dist --optimize-autoloader

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Running migrations..."
php artisan migrate --force

echo "Running seeders..."
php artisan db:seed
