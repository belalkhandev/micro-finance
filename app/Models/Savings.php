<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Savings extends Model
{
    use HasFactory;

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    public function transaction()
    {
        return $this->belongsTo(LoanTransaction::class, 'loan_transaction_id', 'id');
    }
}
