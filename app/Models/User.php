<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements HasName, FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'type',
        'password',
        'lat',
        'lng',
    ];

    // lat and lng are used to determine the nearest offers to the user
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function canAccessPanel(\Filament\Panel $panel): bool
    {
        return $this->type == 'super_admin';
    }
    protected static function booted()
    {
        parent::booted();

        self::creating(function ($user) {
            if ($user->type != 'guest') {
                $user->password = Hash::make($user->password);
            }
        });

        static::updating(function ($user) {
            if ($user->isDirty('password')) {
                $user->password = Hash::make($user->password);
            }
        });
    }
    public function getFilamentName(): string
    {
        return $this->username;
    }

    public function abilities()
    {
        return $this->belongsToMany(Ability::class, 'user_abilities');
    }

    public function devices()
    {
        return $this->hasMany(Device::class);
    }
    public function ShoppingList()
    {
        return $this->hasMany(ShoppingList::class);
    }
    public function owner()
    {
        return $this->hasOne(MarketOwner::class);
    }
}
