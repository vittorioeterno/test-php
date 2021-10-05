<?php

namespace App\Tests\Utils;

use App\Utils\NumberUtils;
use PHPUnit\Framework\TestCase;

class NumberTest extends TestCase
{
    public function testIsPositiveNumber(): void
    {

        $this->assertTrue(NumberUtils::isPositiveNumber(1));
        $this->assertTrue(NumberUtils::isPositiveNumber("1"));
        $this->assertTrue(NumberUtils::isPositiveNumber(0));
        $this->assertFalse(NumberUtils::isPositiveNumber(-1));
        $this->assertFalse(NumberUtils::isPositiveNumber("-1"));

    }
}
