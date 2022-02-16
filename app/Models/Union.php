<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
    use HasFactory;

    protected $appends = ['upazilla_name'];

    public function getUpazillaNameAttribute()
    {
        return $this->upazilla->name;
    }

    public function upazilla()
    {
        return $this->belongsTo(Upazilla::class, 'upazilla_id', 'id');
    }
}
