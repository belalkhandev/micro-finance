<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostOffice extends Model
{
    use HasFactory;

    protected $appends = ['upazilla_name'];

    public function upazilla()
    {
        return $this->belongsTo(Upazilla::class, 'upazilla_id', 'id');
    }

    public function getUpazillaNameAttribute()
    {
        return $this->upazilla ? $this->upazilla->name : null;
    }
}
