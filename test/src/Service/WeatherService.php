<?php

namespace App\Service;

use App\Utils\WeatherapiUtils;

class WeatherService
{

    private WeatherapiUtils $weatherapi_utils;

    public function __construct(WeatherapiUtils $weatherapi_utils)
    {
        $this->weatherapi_utils = $weatherapi_utils;
    }

    public function getWeatherService () : object
    {
        return $this->weatherapi_utils;
    }

}