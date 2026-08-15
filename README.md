# Local setup notes

To finish the scaffold locally and run the application, follow these steps inside the `backend` folder:

1. Install PHP and Composer.
2. Run: composer install
3. Install Node and npm, then run: npm install && npm run dev (if using Vite or Mix configured)
4. Generate app key: php artisan key:generate
5. Copy example env: cp .env.example .env and adjust DB credentials if needed.
6. Run docker-compose up -d from repo root to start MySQL/nginx/php-fpm containers.
7. Run migrations and seeders: php artisan migrate --seed

Optional (recommended): Install Laravel Breeze with Inertia + Vue3 locally:

composer require laravel/breeze --dev
php artisan breeze:install inertia
npm install
npm run dev

This project scaffold includes placeholders for Breeze and Inertia. Install the dependencies locally to enable authentication and full frontend behavior.
