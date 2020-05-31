## Car Park Test Task

Summary:

Используется laravel, laravel-permission package(для ролей), MySQL, Vue.js(для создания динамической формы создания/редактирования/удаления машин на странице создания и редактирования автопарк, всего два Vue компонента), сбора Homestead

## Installation

git clone https://github.com/larko300/CarPark.git

composer install

npm install

cp .env.example .env

php artisan key:generate

add database information to allow Laravel to connect to the database

php artisan migrate

create a roles:
php artisan permission:create-role manager
php artisan permission:create-role driver
