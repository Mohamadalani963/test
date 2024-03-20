<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class BranchOffer extends Pivot
{
    use HasFactory;

    protected $fillable = ['branch_id', 'offer_id'];

    //TODO Relations
    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }
}
