<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'contact_information', 'image', 'address', 'lat', 'lng', 'market_id', 'district_id'];

    protected $casts = [
        'contact_information' => 'array',
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

    //@ Relations
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function offers()
    {
        return $this->belongsToMany(Offer::class, 'branch_offers');
    }
}
