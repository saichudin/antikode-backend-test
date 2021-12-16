## ANTIKODE Backend Test
#### Build with PHP 7.4, Laravel 8, and MySQL 8

How to run :
- pull this repo
- open in IDE
- copy .env.example to .env
- set Database connection in .env file
- change ``APP_URL`` variable in .env to ``APP_URL=http://localhost:8000``
- run ``composer install``
- run ``php artisan key:generate``
- run ``php artisan migrate``
- run ``php artisan db:seed``

use API client such as Postman to test the API

use this API documentation : https://documenter.getpostman.com/view/12200000/UVR8oSem#07e43f38-d296-48e1-933d-f17a88ba22ec
