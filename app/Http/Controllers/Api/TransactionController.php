<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\DpsApplication\DpsApplicationRepositoryInterface;
use App\Repositories\LoanApplication\LoanApplicationRepositoryInterface;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $dps;
    protected $loan;

    public function __construct(DpsApplicationRepositoryInterface $dps_tr, LoanApplicationRepositoryInterface $loan_tr)
    {
        $this->dps = $dps_tr;
        $this->loan = $loan_tr;
    }

    public function generateTransaction(Request $request)
    {

    }
}
