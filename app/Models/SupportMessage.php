<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SupportMessage extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','message','contact_email','title','file','status'];

    protected static function boot()
    {
        parent::boot();
        static::updating(function ($item) {
            $file = $item->getOriginal('file');
            if ($item->isDirty('file') && $file) {
                Storage::delete($file);
            }
        });
        static::deleted(function ($item) {
            if ($item->file) {
                Storage::delete($item->file);
            }
        });
    }

    //@relations
    public function user(){
        return $this->belongsTo(User::class);
    }
}
