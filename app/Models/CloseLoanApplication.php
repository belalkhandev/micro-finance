<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CloseLoanApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_application_id',
        'payable_loan_amount',
        'service_amount',
        'early_payment_discount',
        'beginning_balance',
        'payable_amount',
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
        return $this->belongsTo(LoanApplication::class, 'loan_application_id', 'id');
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
