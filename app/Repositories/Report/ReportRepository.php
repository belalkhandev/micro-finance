<?php

namespace App\Repositories\Report;

use App\Models\LoanTransaction;
use App\Models\DpsTransaction;
use Carbon\Carbon;

class ReportRepository implements ReportRepositoryInterface {

    public function allLoan()
    {
        $transactions = LoanTransaction::with('application')->orderBy('is_paid', 'ASC')->latest()->get();

        if ($transactions->isNotEmpty()) {
            return $transactions;
        }

        return false;
    }

    public function allCurrentLoan()
    {
        $today = databaseFormattedDate(Carbon::today());
        $transactions = LoanTransaction::with('application')->whereDate('transaction_date', '=',$today )->orderBy('is_paid', 'ASC')->latest()->get();

        if ($transactions->isNotEmpty()) {
            return $transactions;
        }

        return false;
    }

    public function allDps()
    {
        $transactions = DpsTransaction::with('application')->orderBy('is_paid', 'ASC')->latest()->get();

        if ($transactions->isNotEmpty()) {
            return $transactions;
        }

        return false;
    }

    public function allCurrentDps()
    {
        $today = databaseFormattedDate(Carbon::today());
        $transactions = DpsTransaction::with('application')->whereDate('transaction_date', '=',$today )->orderBy('is_paid', 'ASC')->latest()->get();

        if ($transactions->isNotEmpty()) {
            return $transactions;
        }

        return false;
    }

}
