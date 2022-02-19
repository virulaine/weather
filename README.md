# Weather service

Simple API to get historical weather data
- List cities
- Get last 14 days weather data for each city (daily average temperature, humidity, pressure)
- Update or create weather data for city by it's ID

## Technologies used
* PHP 7.4.3
* Laravel 7.30.6
* Laravel Sanctum
* MySQL 8.0.28
* RESTful API
* Postman
* Composer

## Instructions
1. 		composer install
2. Set up .env file
3. 		php artisan migrate
4. 		php artisan parse daily_14.json
5. Run GET/POST requests from Postman collection located in "postman" directory

    * Register (returns token)
    * Login (returns token)
    * GET /cities (requires Bearer token)
    * GET /city/{ID} (requires Bearer token)
    * POST /city/{ID} (requires Bearer token)
