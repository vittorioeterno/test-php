<?php

namespace App\Service;

use App\Interfaces\CityInterface;
use App\Interfaces\WeatherInterface;

class CityWeatherService
{

    private CityInterface $city_service;
    private WeatherInterface $weather_service;

    public function __construct(CityService $city_service, WeatherService $weather_service)
    {
        $this->city_service = $city_service->getCityService();
        $this->weather_service = $weather_service->getWeatherService();
    }


    /**
     * @return array<int, mixed> $items
     */
    public function getCitiesWeathers (int $limit, int $offset, string $sort_by, int $forecast_days) : ?array 
    {
        $result = [];

        try {

            $cities = $this->city_service->getCities($offset, $limit, $sort_by);
            if (!empty($cities) && count($cities)>0) {

                $i=0;
                foreach ($cities as $city) {

                    // $result[$i]["city"] = $city["name"];
                    $result[$i][0] = $city["name"];

                    $weathers = $this->weather_service->getWeathersByLatAndLong($city["latitude"], $city["longitude"], $forecast_days);
                    if (isset($weathers["forecast"]) && isset($weathers["forecast"]["forecastday"])) {

                        $j=1;
                        foreach ($weathers["forecast"]["forecastday"] as $days) {
                            // $result[$i][$days["date"]] = $days["day"]["condition"]["text"];
                            $result[$i][$j] = $days["day"]["condition"]["text"];
                            $j++;
                        }

                        $i++;
                    }
                }
            }

        } catch (\Exception $e) {
            throw $e;
        }

        return $result;
    }

}