<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    public function nominee()
    {
        return $this->hasOne(Nominee::class, 'member_id', 'id');
    }
}
