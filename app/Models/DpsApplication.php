<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DpsApplication extends Model
{
    use HasFactory;

    public function transactions()
    {
        return $this->hasMany(DpsInstallment::class, 'dps_application_id', 'id');
    }
}
