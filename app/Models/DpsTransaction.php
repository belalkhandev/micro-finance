<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DpsTransaction extends Model
{
    use HasFactory;

    public function application()
    {
        return $this->belongsTo(DpsApplication::class, 'dps_application_id', 'id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}
