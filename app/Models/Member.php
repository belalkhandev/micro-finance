<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Member extends Model
{
    use HasFactory;

    protected $appends = ['main_photo'];

    public function nominee()
    {
        return $this->hasOne(Nominee::class, 'member_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo(MemberGroup::class, 'member_group_id', 'id');
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

    public function getMainPhotoAttribute()
    {
        if($this->attributes['photo']) {
            return base_path('public/'.$this->attributes['photo']);
        }

        return base_path('public/images/profile.jpg');
    }

    public function dpsApplications()
    {
        return $this->hasMany(DpsApplication::class, 'member_id', 'id');
    }

    public function loanApplications()
    {
        return $this->hasMany(LoanApplication::class, 'member_id', 'id');
    }
}
