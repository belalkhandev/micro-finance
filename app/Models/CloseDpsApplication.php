<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CloseDpsApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'dps_application_id',
        'deposit_balance',
        'incentive',
        'incentive_type',
        'incentive_amount',
        'total_payable',
        'payment',
        'payment_method',
        'payment_channel',
        'transaction_no',
        'cheque_no',
        'note',
        'created_by'
    ];

    public function application():BelongsTo
    {
        return $this->belongsTo(DpsApplication::class, 'dps_application_id', 'id');
    }
}
