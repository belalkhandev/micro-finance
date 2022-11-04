<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DpsTransaction extends Model
{
    use HasFactory;

    protected $appends = ['member_name', 'member_account_no'];

    public function application()
    {
        return $this->belongsTo(DpsApplication::class, 'dps_application_id', 'id');
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
