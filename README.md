# Test Jagaad

Vittorio Eterno, from Jagaad.

# GOALS:

Creation of an application that allows you to call 2 external APIs, the first must return a list of cities (https://api-docs.musement.com/reference#getcities), while the second, specifying the city, must return the current and next day's weather (https://www.weatherapi.com/).

# Technologies used:

Symfony 4.4 LTS, PHP 8.0, Docker.

As add-ons, I have installed PHPStan by composer, which is a PHP Static Analysis Tool

To run PHPStan, move in root of the project:
    
    vendor/bin/phpstan analyse -l 8 src


# Setup Docker suite

    sudo docker-compose build

    sudo docker-compose up

In a new terminal, in /jagaad_test, run:

    sudo docker-compose exec php /bin/bash

Now you are in the project

    composer install

Setup the test env

    composer dump-env test

Run the symfony command to test External APIs
    
    php bin/console app:city-weather

Run PHPUnit Tests 

    php ./vendor/bin/phpunit

