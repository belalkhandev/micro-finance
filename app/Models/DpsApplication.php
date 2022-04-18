<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DpsApplication extends Model
{
    use HasFactory;

    protected $appends = ['member_name', 'member_account_no'];

    public function transactions()
    {
        return $this->hasMany(DpsInstallment::class, 'dps_application_id', 'id');
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

    public function getMemberNameAttribute()
    {
        return $this->member->name;
    }

    public function getMemberAccountNoAttribute()
    {
        return $this->member->account_no;
    }
}
