<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    //TODO Translation
    protected $fillable = [
        'name',
        'lat',
        'lng',
        'city',
        'status',
    ];
}
