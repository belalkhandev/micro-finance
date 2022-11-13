<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanApplication extends Model
{
    use HasFactory;

    public function transactions()
    {
        return $this->hasMany(LoanTransaction::class, 'loan_application_id', 'id');
    }

    public function paidTransactions()
    {
        return $this->hasMany(LoanTransaction::class, 'loan_application_id', 'id')->where('is_paid', 1);
    }


    public function transactionsTotalAmount()
    {
        if ($this->transactions->isNotEmpty()) {
            return $this->transactions->where('is_paid', 1)->sum('amount');
        }

        return 0;
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}
