<?php

namespace App\Repositories;

use App\Models\CloseDpsApplication;
use Illuminate\Support\Facades\Auth;

class CloseDpsApplicationRepository extends Repository
{

    /**
     * @inheritDoc
     */
    public function model()
    {
        return CloseDpsApplication::class;
    }

    public function storeByRequest($request)
    {
        return $this->create([
            'dps_application_id' => $request->application_id,
            'deposit_balance' => $request->deposit_balance,
            'incentive' => $request->incentive ?? 0,
            'incentive_type' => $request->incentive_type,
            'incentive_amount' => $request->incentive_amount ?? 0,
            'total_payable' => $request->payable_amount,
            'payment' => $request->payment,
            'payment_method' => $request->payment_method,
            'payment_channel' => $request->payment_channel ?? null,
            'transaction_no' => $request->transaction_no ?? null,
            'cheque_no' => $request->cheque_no ?? null,
            'note' => $request->note,
            'created_by' => Auth::guard('sanctum')->user()->id,
        ]);
    }
}
