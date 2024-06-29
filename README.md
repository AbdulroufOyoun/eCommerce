## To run the project

1.Type in command: npm install
2. go to Vendor -> spatie -> laravel -> permissino ->src -> models ->permission  then change (use 'id') to (use 'uuid') and change (protected $primaryKey = 'id') to (protected $primaryKey = 'uuid') 
3. type in command:
composer require laravel/passport 
php artisan migrate
php artisan passport:install
php artisan db:seed
php artisan serve
