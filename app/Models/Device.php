<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\PersonalAccessToken;

class Device extends Model
{
    use HasFactory;

    protected $fillable = ['ip', 'fcm_token', 'user_id', 'token_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function token()
    {
        return $this->belongsTo(PersonalAccessToken::class, 'token_id');
    }
}
