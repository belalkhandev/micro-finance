<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanApplication extends Model
{
    use HasFactory;

    public function transactions()
    {
        return $this->hasMany(LoanInstallment::class, 'loan_application_id', 'id');
    }
}
