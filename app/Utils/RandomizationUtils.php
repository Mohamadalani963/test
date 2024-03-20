<?php

namespace App\Utils;

class RandomizationUtils
{
    public static function randomString($stringLength = 100)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789qwertyuiopaasdfghjklzxcvbnm!@#$%^&*()_+];', ceil(100 / strlen($x)))), 1, $stringLength);
    }

    public static function randomInt($intLength = 6)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789', ceil(6 / strlen($x)))), 1, $intLength);
    }

    public static function randomPassword($passwordLength = 8)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789qwertyuiopaasdfghjklzxcvbnm', ceil(100 / strlen($x)))), 1, $passwordLength);
    }
}
