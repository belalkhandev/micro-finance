<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CloseDpsApplication extends Model
{
    use HasFactory;

    public function application():BelongsTo
    {
        return $this->belongsTo(DpsApplication::class, 'dps_application_id', 'id');
    }
}
