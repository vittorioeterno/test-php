<?php

namespace App\Service;

use App\Interfaces\CityInterface;
use App\Utils\MusementUtils;
use App\Utils\WeatherapiUtils;

class CityService
{

    private MusementUtils $musement_utils;

    public function __construct(MusementUtils $musement_utils)
    {
        $this->musement_utils = $musement_utils;
    }

    public function getCityService () : object
    {
        return $this->musement_utils;
    }

}