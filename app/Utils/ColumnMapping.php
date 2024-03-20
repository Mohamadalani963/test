<?php

namespace App\Utils;

class ColumnMapping
{
    public static function map($data, $map)
    {
        $newData = [];
        foreach ($data as $key => $value) {

            if (array_key_exists($key, $map)) {
                $newData[$map[$key]] = $value;
            } else {
                $newData[$key] = $value;
            }
        }

        return $newData;
    }
}
