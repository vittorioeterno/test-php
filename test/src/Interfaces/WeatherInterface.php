<?php

namespace App\Interfaces;

interface WeatherInterface
{
    public function getWeathersByLatAndLong (float $lat, float $long, int $days);
}