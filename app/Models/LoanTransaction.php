<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanTransaction extends Model
{
    use HasFactory;

    protected $appends = ['member_name', 'member_account_no'];

    public function loanApplication()
    {
        return $this->belongsTo(LoanApplication::class, 'loan_application_id', 'id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    public function getMemberNameAttribute()
    {
        return $this->member->name;
    }

    public function getMemberAccountNoAttribute()
    {
        return $this->member->account_no;
    }
}
