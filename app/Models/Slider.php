<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'sliderable_id',
        'sliderable_type',
        'image',
    ];

    protected static function boot()
    {
        parent::boot();
        static::updating(function ($item) {
            $image = $item->getOriginal('image');
            if ($item->isDirty('image') && $image) {
                Storage::delete($image);
            }
        });
        static::deleted(function ($item) {
            if ($item->image) {
                Storage::delete($item->image);
            }
        });
    }

    public function sliderable()
    {
        return $this->morphTo(); // Market Offer
    }
}
