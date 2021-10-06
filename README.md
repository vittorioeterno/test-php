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

In a new terminal, in /test_php, run:

    sudo docker-compose exec php /bin/bash

Now you are in the project

    composer install

Setup the test env

    composer dump-env test

Run the symfony command to test External APIs
    
    php bin/console app:city-weather

Run PHPUnit Tests 

    php ./vendor/bin/phpunit

# Step 2 

Swagger UI:

    http://localhost:85/

## API Descriptions

***POST: /cities/{id}/forecast***

The first check will be to verify the existence and correctness of the "id" parameter, possibly returning 404 or 400.

The "days" parameter in the body of the call must be a positive integer, therefore greater than 0 and less than 10.

From a hypothetical DB I check that the days for which the forecast is requested are not already entered. If all the calculated days are already entered in the db, then I return an exception 400.

We then take the data, if there are some from the db, combining them with those of the external api call, formatting the json result to be returned.


***GET: /cities/{id}/forecast/{day}***

The first check will be to verify the existence and correctness of the "id" parameter, possibly returning 404 or 400.

Then check that the parameter in uri "day" corresponds to the strings: "today", "tomorrow", or that it is a date in the "Y-m-d" format and that it is greater than or equal to today, but also less than the current day + 10 days , otherwise I return a 400.

Then, eventually, the string "today" or "tomorrow" is transformed into the relative date expressed in the format "Y-m-d".

In the hypothetical DB the data is searched by filtering by city_ID and the requested day. If no results are found, a 404 is returned, otherwise a json format response with the values formatted as in the doc.