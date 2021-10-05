<?php

namespace App\Tests\Utils;

use App\Utils\MusementUtils;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MusementTest extends KernelTestCase
{

    public function testGetCities(): void
    {
        $kernel = self::bootKernel();

        // check env
        $this->assertSame('test', $kernel->getEnvironment());

        // check if service exist
        $this->assertTrue(self::$container->has(MusementUtils::class));

        /** @var MusementUtils $musement_utils */
        $musement_utils = self::$container->get(MusementUtils::class);
        $cities = $musement_utils->getCities();

        // checks of cities
        $this->assertTrue(is_array($cities));
        $this->assertTrue(count($cities)>0);
        $this->assertTrue(isset($cities[0]["latitude"]));
        $this->assertTrue(isset($cities[0]["longitude"]));

        // default limit = 10
        $this->assertCount(10, $cities);


        $cities = $musement_utils->getCities(10,10);
        $this->assertTrue(is_array($cities));
        $this->assertTrue(count($cities)>0);
        $this->assertTrue(isset($cities[0]["latitude"]));
        $this->assertTrue(isset($cities[0]["longitude"]));

        $this->assertCount(10, $cities);


        $cities = $musement_utils->getCities(20,5);
        $this->assertTrue(is_array($cities));
        $this->assertTrue(count($cities)>0);
        $this->assertTrue(isset($cities[0]["latitude"]));
        $this->assertTrue(isset($cities[0]["longitude"]));

        $this->assertCount(5, $cities);
    }
}
