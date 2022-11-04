<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nominee extends Model
{
    use HasFactory;

    protected $appends = ['main_photo'];

    public function getMainPhotoAttribute()
    {
        if($this->attributes['photo']) {
            return base_path('public/'.$this->attributes['photo']);
        }

        return base_path('public/images/profile.jpg');
    }
}
