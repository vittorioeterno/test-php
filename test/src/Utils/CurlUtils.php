<?php

namespace App\Utils;

use CurlHandle;

class CurlUtils
{

    /**
     * @return array<string, mixed> $items
     */
    public static function doCurl (string $url) : array
    {
        $header = [
            'Accept: application/json',
            'Accept-Language: en-US'
        ];

        $defaults = array(
            CURLOPT_SSL_VERIFYPEER => 0,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_HTTPHEADER => $header,
            CURLOPT_URL => $url,
        );

        try {
            /** @var CurlHandle $ch */
            $ch = curl_init($url);
            curl_setopt_array($ch, $defaults);
            $result = curl_exec($ch);
            $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
        } catch (\Exception $e) {
            throw $e;
        }

        if(!$result) {
            throw new \Exception("cURL failed: ".curl_error($ch), 500);
        }

        return [
            "result" => $result,
            "http_code" => $httpcode
        ];
    }

}