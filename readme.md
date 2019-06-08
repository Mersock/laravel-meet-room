## Laravel

This is simple project with laravel with Docker 

`Install`
1. https://github.com/Mersock/meet_room_laravel.git

2. Change file name .env.example to .env

3. Run  `docker-compose up -d`

4. Run  `docker exec meet-room-laravel_php_1 composer install` or `docker exec meet-room-laravel_php_1 composer update` 

5. Run  `docker exec meet-room-laravel_php_1 php artisan key:generate`

6. Run  `docker exec meet-room-laravel_php_1 php artisan migrate`

7. Run application http://localhost:8000/
