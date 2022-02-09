<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    protected $appends = ['union_name'];

    public function union()
    {
        return $this->belongsTo(Union::class, 'union_id', 'id');
    }

    public function getUnionNameAttribute()
    {
        return $this->union ? $this->union->name : null;
    }
}
