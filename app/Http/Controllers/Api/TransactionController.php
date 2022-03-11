<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\DpsTransaction\DpsTransactionRepositoryInterface;
use App\Repositories\LoanTransaction\LoanTransactionRepositoryInterface;
use Illuminate\Http\Request;

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
        $type = $request->input('transaction_type');
        switch ($type) {
            case 'all':
                $this->dps->generateTransaction();
                $this->loan->generateTransaction();
                break;
            case 'deposit':
                $this->dps->generateTransaction();
                break;
            case 'loan':
                $this->loan->generateTransaction();
                break;
            default:
                return false;
        }

        return true;
    }
}
