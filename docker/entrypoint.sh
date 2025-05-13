#!/bin/bash
set -e

# Wait for MySQL to be ready
until mysql -h "$DB_HOST" -u "$DB_USERNAME" -p"$DB_PASSWORD" -e "SELECT 1;"; do
  >&2 echo "Waiting for MySQL to be available..."
  sleep 2
done

# Install composer dependencies if vendor/ is missing
if [ ! -d "vendor" ]; then
  composer install
fi

# Ensure storage and cache are writable
chown -R www-data:www-data storage bootstrap/cache
chmod -R 775 storage bootstrap/cache

# Run artisan key:generate if APP_KEY is missing
if ! grep -q "^APP_KEY=" .env || [ -z "$(grep '^APP_KEY=' .env | cut -d '=' -f2)" ]; then
  php artisan key:generate
fi

# Run migrations
php artisan migrate --force

# Start Apache (in foreground)
docker-php-entrypoint apache2-foreground
