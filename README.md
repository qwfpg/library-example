
Run following commands to setup project
```bash
cp .env.example .env
composer install
npm install
php artisan key:generate
php artisan storage:link
php artisan migrate --seed
php artisan serve
npm run dev
php artisan queue:work
```
