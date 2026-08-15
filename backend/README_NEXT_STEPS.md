## Next steps to fully enable auth, PDF and frontend

I pushed backend code, models, migrations, controllers and frontend pages, but to finish the system you need to run a few commands locally (in `backend`):

1. Install composer packages (Laravel & dependencies):

   composer install

2. Install Laravel Breeze with Inertia + Vue (recommended for full auth UI):

   composer require laravel/breeze --dev
   php artisan breeze:install inertia
   npm install
   npm run dev

3. Install PDF generator (DomPDF):

   composer require barryvdh/laravel-dompdf

4. Run docker-compose up -d (from repo root) to start mysql/nginx/php-fpm

5. Generate key, migrate and seed:

   php artisan key:generate
   php artisan migrate --seed

6. If you want to protect routes with role middleware, register middleware in `app/Http/Kernel.php`:

   protected $routeMiddleware = [
       // ...
       'role' => \App\Http\Middleware\RoleMiddleware::class,
   ];

   (RoleMiddleware was added earlier; ensure it's registered so you can use `->middleware('role:admin')` on routes.)

7. Access app: open http://localhost:8080 and login with seeded admin: admin@example.com / password


If you want, म यी बाँकी कदमहरू पनि मर्पत प्रत्यक्ष commit गर्न सक्छु (उदाहरण: Breeze install artifacts, middleware registration modified automatically). तर ती कमाण्डहरू तपाईँको सिस्टममा चलाउनुपर्छ (composer/npm)।
