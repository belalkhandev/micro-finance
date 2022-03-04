<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Member extends Model
{
    use HasFactory;

    public function nominee()
    {
        return $this->hasOne(Nominee::class, 'member_id', 'id');
    }

    public function village()
    {
        return $this->belongsTo(Village::class, 'village_id', 'id');
    }

    public function postOffice()
    {
        return $this->belongsTo(PostOffice::class, 'post_office_id', 'id');
    }

    public function getPhotoAttribute($value)
    {
        if($value) {
            return URL::to('/').'/'.$value;
        }

        return null;
    }
}
