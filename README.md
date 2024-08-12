#
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan serve

Change password in the db on $2y$10$4PHCQ7UvyUE/1zVblSmJg.BKCKel.bmUY0QTvXJu3OEez5r6.6oDG

Password: Test7894*
