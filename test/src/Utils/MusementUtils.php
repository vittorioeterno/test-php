<?php

namespace App\Utils;

use App\Interfaces\CityInterface;

class MusementUtils implements CityInterface
{

    private string $base_url;

    public function __construct(string $base_url)
    {
        $this->base_url = $base_url;
    }

    public function getBaseUrl () : string
    {
        return $this->base_url;
    }

    /**
     * @return array<mixed> $items
     */
    public function getCities (int $offset=0, int $limit=10, string $sort_by='weigth') : ?array
    {
        $cities = [];
        
        try {

            $url = $this->base_url."/cities?offset={$offset}&limit={$limit}&sort_by={$sort_by}&without_events=no";

            $response_cities = CurlUtils::doCurl($url);

            if (isset($response_cities["result"])) {
                $cities = json_decode($response_cities["result"], true);
                if (is_null($cities)) {
                    throw new \Exception("Invalid API get cities");
                }
            }

        } catch (\Exception $e) {
            throw $e;
        }


        return $cities;
    }

}