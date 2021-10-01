<?php

namespace App\Tests\Utils;

use App\Utils\CurlUtils;
use PHPUnit\Framework\TestCase;

class CurlTest extends TestCase
{
    public function testDoCurl(): void
    {

        // Test a public open api 

        $this->assertTrue(isset($_ENV['URL_TEST_API']));

        $response = CurlUtils::doCurl($_ENV['URL_TEST_API']);

        $this->assertTrue(is_array($response));
        $this->assertTrue(isset($response["http_code"]));
        $this->assertSame(200, $response["http_code"]);
        $this->assertTrue(isset($response["result"]));
        
        $result = json_decode($response["result"], true);

        $this->assertTrue(!is_null($result));
        $this->assertTrue(is_array($result));
        $this->assertTrue(count($result)>0);

    }
}
