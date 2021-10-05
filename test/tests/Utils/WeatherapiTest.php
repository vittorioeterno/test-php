<?php

namespace App\Tests\Utils;

use App\Utils\MusementUtils;
use App\Utils\WeatherapiUtils;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class WeatherapiTest extends KernelTestCase
{

    public function testGetWeathersByLatAndLong(): void
    {
        $kernel = self::bootKernel();

        // check env
        $this->assertSame('test', $kernel->getEnvironment());

        // check if service exist
        $this->assertTrue(self::$container->has(WeatherapiUtils::class));

        /** @var WeatherapiUtils $weatherapi_utils */
        $weatherapi_utils = self::$container->get(WeatherapiUtils::class);

        /** @var MusementUtils $musement_utils */
        $musement_utils = self::$container->get(MusementUtils::class);
        $cities = $musement_utils->getCities(1,2);


        foreach ($cities as $city) {

            $weathers = $weatherapi_utils->getWeathersByLatAndLong($city["latitude"], $city["longitude"]);

            $this->assertTrue(is_array($weathers));
            $this->assertTrue(count($weathers)>0);
            $this->assertTrue(isset($weathers["forecast"]));
            $this->assertTrue(isset($weathers["forecast"]["forecastday"]));

            foreach ($weathers["forecast"]["forecastday"] as $days) {
                $this->assertTrue(isset($days["day"]));
                $this->assertTrue(isset($days["day"]["condition"]));
            }

        }


    }
}
