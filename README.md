### Description

Homework for Multipass.<br>
All the related code is located in `packages/TemperatureSensor` directory.<br>
Examples for each API can be found in `packages/TemperatureSensor/src/Api/RequestExamples` directory.<br>

There is no web UI only API methods are created.

### Project Setup

1. copy `.env.example` to `.env`
2. run `./vendor/bin/sail up -d`
3. run `./vendor/bin/sail exec -it web /bin/bash` to access Docker web container
4. in web container run `php artisan migrate` to create database structure
   1. this will create ***temperature_sensors*** and ***temperature_sensor_readings*** tables
5. in web container run `php artisan db:seed` to get some dummy data in tables
   1. currently set to create 10 sensors with 50 readings for each sensor

### What else would I add
1. Unit tests - currently no tests are added
2. API documentation - currently requests and resources are not documented (could use Swagger for this)
3. add `composer.json` to TemperatureSensor package for easier integration with Laravel project
