<?php

namespace App\Interfaces;

interface WeatherInterface
{
    /**
     * @return array<string, array> $items
     */
    public function getWeathersByLatAndLong (float $lat, float $long, int $days) : ?array;
}