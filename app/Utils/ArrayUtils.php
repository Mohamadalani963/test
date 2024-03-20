<?php

namespace App\Utils;

class ArrayUtils
{
    public static function firstWhere(&$array, $callback)
    {
        foreach ($array as $e) {
            if ($callback($e)) {
                return $e;
            }
        }

        return null;
    }
}
