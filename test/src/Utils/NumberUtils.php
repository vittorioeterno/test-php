<?php

namespace App\Utils;

class NumberUtils
{

    public static function isPositiveNumber (string $inp) : bool
    {
        if (!is_numeric($inp)) {
            return false;
        }

        if ($inp < 0) {
            return false;
        }

        return true;
    }

}