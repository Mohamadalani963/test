<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BranchOffer extends Pivot
{
    use HasFactory;

    protected $fillable = ['branch_id', 'offer_id', 'lat', 'lng'];
    protected $table = 'branch_offers';
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($item) {
            $branch = $item->branch;
            $item->lat = $branch->lat;
            $item->lng = $branch->lng;
        });
    }
    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
