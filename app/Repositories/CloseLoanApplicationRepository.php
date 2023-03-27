<?php

namespace App\Repositories;

use App\Models\CloseDpsApplication;
use App\Models\CloseLoanApplication;
use Illuminate\Support\Facades\Auth;

class CloseLoanApplicationRepository extends Repository
{

    /**
     * @inheritDoc
     */
    public function model()
    {
        return CloseLoanApplication::class;
    }

    public function storeByRequest($request)
    {
        return $this->create([
            'loan_application_id' => $request->application_id,
            'payable_loan_amount' => $request->deposit_balance,
            'service_amount' => $request->incentive ?? 0,
            'early_payment_discount' => $request->incentive_type,
            'beginning_balance' => $request->incentive_amount ?? 0,
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
