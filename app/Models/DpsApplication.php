<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DpsApplication extends Model
{
    use HasFactory;

    public function transactions()
    {
        return $this->hasMany(DpsTransaction::class, 'dps_application_id', 'id');
    }

    public function transactionsTotalAmount()
    {
        if ($this->transactions->isNotEmpty()) {
            return $this->transactions->where('is_paid', 1)->sum('amount');
        }

        return 0;
    }

    public function member(): BelongsTo
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    public function createdUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function closeApplication(): HasOne
    {
        return $this->hasOne(CloseDpsApplication::class, 'dps_application_id', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeClosed($query)
    {
        return $query->where('status', 'closed');
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 'inactive');
    }
}
