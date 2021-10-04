<?php

namespace App\Utils;

use App\Interfaces\WeatherInterface;

class WeatherapiUtils implements WeatherInterface
{

    private string $base_url;
    private string $key;

    public function __construct(string $base_url, string $key)
    {
        $this->base_url = $base_url;
        $this->key = $key;
    }

    public function getBaseUrl () : string
    {
        return $this->base_url;
    }

    /**
     * @return array<string, array> $items
     */
    public function getWeathersByLatAndLong (float $lat, float $long, int $days=2) : array
    {
        $weathers = [];

        try {

            $url = $this->base_url."/forecast.json?key={$this->key}&q={$lat},{$long}&days={$days}";

            $response_weathers = CurlUtils::doCurl($url);

            if (isset($response_weathers["result"])) {
                $weathers = json_decode($response_weathers["result"], true);
                if (is_null($weathers)) {
                    throw new \Exception("Invalid API weather");
                }
            }

        } catch (\Exception $e) {
            throw $e;
        }


        return $weathers;
    }


}