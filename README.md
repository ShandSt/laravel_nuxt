# Project Setup Instructions

Follow these commands to set up and run the project locally.

## Use Commands

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan serve


## You're ready to go! Visit the url in your browser, and login with:
Username: admin@filamentphp.com
Password: Test7894*
