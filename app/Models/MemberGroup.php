<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberGroup extends Model
{
    use HasFactory;

    protected $appends = ['total_member'];

    public function members()
    {
        return $this->hasMany(Member::class, 'member_group_id', 'id');
    }

    public function getTotalMemberAttribute()
    {
        return $this->hasMany(Member::class, 'member_group_id', 'id')->count();
    }
}
