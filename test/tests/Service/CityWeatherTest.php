<?php

namespace App\Tests\Service;

use App\Service\CityWeatherService;
use App\Utils\MusementUtils;
use App\Utils\WeatherapiUtils;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CityWeatherTest extends KernelTestCase
{

    public function testGetCitiesWeathers(): void
    {
        $kernel = self::bootKernel();

        // check env
        $this->assertSame('test', $kernel->getEnvironment());

        // check if Musement service exist
        $this->assertTrue(self::$container->has(MusementUtils::class));

        // check if Weatherapi service exist
        $this->assertTrue(self::$container->has(WeatherapiUtils::class));

        // check if CityWeather service exist
        $this->assertTrue(self::$container->has(CityWeatherService::class));

        /** @var CityWeatherService $cityweather_service */
        $cityweather_service = self::$container->get(CityWeatherService::class);

        $result = $cityweather_service->getCitiesWeathers(2,0,"weight",2);

        $this->assertTrue(is_array($result));
        $this->assertTrue(count($result)==2);
        $this->assertTrue(count($result[0])==3); // cityname + 2 forecast days
        // $this->assertSame("Amsterdam",$result[0]["city"]);
        $this->assertSame("Amsterdam",$result[0][0]);

        $result_2 = $cityweather_service->getCitiesWeathers(3,2,"weight",3);

        $this->assertTrue(is_array($result_2));
        $this->assertTrue(count($result_2)==3);
        $this->assertTrue(count($result_2[0])==4); // cityname + 3 forecast days
        // $this->assertSame("Rome",$result_2[0]["city"]);
        $this->assertSame("Rome",$result_2[0][0]);


    }
}
