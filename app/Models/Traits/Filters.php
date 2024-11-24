<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait Filters
{
    /**
     * Summary of filters
     *
     * @param  mixed  $data
     */
    public static function filters($data): Builder
    {

        $query = self::query();
        $filters = self::getFiltersArray();
        foreach ($data as $key => $value) {
            if (method_exists(static::class, 'scope' . ucfirst($key))) {
                $query->$key($value);
            } elseif (array_key_exists($key, $filters)) {
                self::{$filters[$key]}($query, $key, $value);
            }
        }

        return $query;
    }

    /**
     * retrieve the filtersArray
     * in case the array wasn't found an empty array will be retrieved
     */
    private static function getFiltersArray(): array
    {
        if (property_exists(self::class, 'filtersArray')) {
            return self::$filtersArray;
        }

        return [];
    }

    // Static filters

    /**
     * Equal Filter
     *
     * @param  mixed  $query
     * @param  mixed  $key
     * @param  mixed  $value
     * @return void
     */
    private static function equal(Builder $query, $key, $value): Builder
    {
        return $query->where($key, $value);
    }

    /**
     * Like Filter
     *
     * @param  mixed  $key
     * @param  mixed  $value
     * @return \Illuminate\Contracts\Database\Eloquent\Builder
     */
    private static function like(Builder $query, $key, $value): Builder
    {
        return $query->where($key, 'like', '%' . $value . '%');
    }


    private static function startWith(Builder $query, $key, $value): Builder
    {
        return $query->where($key, 'like',  $value . '%');
    }

    private static function endWith(Builder $query, $key, $value): Builder
    {
        return $query->where($key, 'like',   '%' . $value);
    }
}
