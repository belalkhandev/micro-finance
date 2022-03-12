<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\DpsTransaction\DpsTransactionRepositoryInterface;
use App\Repositories\LoanTransaction\LoanTransactionRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    protected $dps;
    protected $loan;

    public function __construct(DpsTransactionRepositoryInterface $dps_tr, LoanTransactionRepositoryInterface $loan_tr)
    {
        $this->dps = $dps_tr;
        $this->loan = $loan_tr;
    }

    public function generateTransaction(Request $request)
    {
        $rules = [
            'transaction_type' => 'required',
            'application_type' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ], 422);
        }

        $type = $request->input('transaction_type');

        if ($type === 'deposit') {
            if ($this->dps->generateTransaction($request)) {
                return response()->json([
                    'status' => true,
                    'message' => "DPS transaction has been generated successfully"
                ]);
            }
        } else {
            if ($this->loan->generateTransaction($request)) {
                return response()->json([
                    'status' => true,
                    'message' => "Loan transaction has been generated successfully"
                ]);
            }
        }

        return response()->json([
            'status' => false,
            'message' => "Failed to generate transaction"
        ]);
    }
}
