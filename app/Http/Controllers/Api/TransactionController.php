<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DpsApplication;
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

    /**
     * generate Transactions DPS and loan
     *
     * @return \Illuminate\Http\JsonResponse
     */
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
            ]);
        }

        if ($request->input('transaction_type') === 'deposit') {
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

    /*
     * all dps transaction list
     * */
    public function dpsTransactionList()
    {
        $dps_trs = $this->dps->all();

        if ($dps_trs) {
            return response()->json([
                'status' => true,
                'dps_transactions' => $dps_trs
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'No Dps transaction found'
        ]);
    }

    /*
     * All load transaction list
     * */
    public function loanTransactionList()
    {
        $loan_trs = $this->loan->all();

        if ($loan_trs) {
            return response()->json([
                'status' => true,
                'loan_transactions' => $loan_trs
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'No Loan transaction found'
        ]);
    }

    public function loanCollection(Request $request)
    {
        $transaction = $this->loan->payment($request);

        if ($transaction) {
            return response()->json([
                'status' => true,
                'transaction' => $transaction
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Something went wrong'
        ]);
    }
}
