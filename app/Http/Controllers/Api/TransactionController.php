<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\DpsTransaction\DpsTransactionRepositoryInterface;
use App\Repositories\LoanTransaction\LoanTransactionRepositoryInterface;
use App\Repositories\Savings\SavingsRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    protected $dps;
    protected $loan;
    protected $savings;

    public function __construct(DpsTransactionRepositoryInterface $dps_tr, LoanTransactionRepositoryInterface $loan_tr, SavingsRepositoryInterface $savings)
    {
        $this->dps = $dps_tr;
        $this->loan = $loan_tr;
        $this->savings = $savings;
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
    public function dpsTransactionList(Request $request): \Illuminate\Http\JsonResponse
    {
        $dps_trs = $this->dps->getByPaginate($request, 20);

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
     * all dps transaction list
     * */
    public function dpsTransactionPaidList(Request $request)
    {
        $dps_trs = $this->dps->allPaid($request);

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
     * all dps transaction list
     * */
    public function dpsTransactionUnpaidList(Request $request)
    {
        $dps_trs = $this->dps->allUnpaid($request);

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
     * all dps transaction list
     * */
    public function memberDpsTransactions($member_id)
    {
        $dps_trs = $this->dps->memberTransactions($member_id);

        if ($dps_trs) {
            return response()->json([
                'status' => true,
                'transactions' => $dps_trs
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'No Dps transaction found'
        ]);
    }

    /*
     * all dps transaction list
     * */
    public function memberLoanTransactions($member_id)
    {
        $loan_trs = $this->loan->memberTransactions($member_id);

        if ($loan_trs) {
            return response()->json([
                'status' => true,
                'transactions' => $loan_trs
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
    public function loanTransactionList(Request $request)
    {
        $loan_trs = $this->loan->getByPaginate($request, 15);

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

    /*
     * All load transaction list
     * */
    public function loanTransactionUnpaidList()
    {
        $loan_trs = $this->loan->allUnpaid();

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
    /*
     * All load transaction list
     * */
    public function loanTransactionPaidList()
    {
        $loan_trs = $this->loan->allPaid();

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

    public function dpsCollection(Request $request)
    {
        $transaction = $this->dps->payment($request);

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

    public function loanCollection(Request $request)
    {
        $transaction = $this->loan->payment($request);

        if ($request->input('savings_type') && $request->input('savings_amount')) {
            $this->savings->storeFromLoan($request);
        }

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
