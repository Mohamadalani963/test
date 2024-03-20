<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['description', 'name', 'offer_price', 'original_price', 'due_to', 'category_id', 'market_id', 'main_image'];

    protected static function boot()
    {
        parent::boot();
        static::updating(function ($item) {
            $image = $item->getOriginal('main_image');
            if ($item->isDirty('main_image') && $image) {
                Storage::delete($image);
            }
        });
        static::deleted(function ($item) {
            if ($item->main_image) {
                Storage::delete($item->main_image);
            }
        });
    }

    //@relations
    public function market()
    {
        return $this->belongsTo(Market::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(OfferImages::class);
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'branch_offers');
    }
}
