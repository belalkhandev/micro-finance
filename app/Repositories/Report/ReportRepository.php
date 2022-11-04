<?php

namespace App\Repositories\Report;

use App\Models\LoanTransaction;
use App\Models\DpsTransaction;
use App\Models\Savings;
use Carbon\Carbon;

class ReportRepository implements ReportRepositoryInterface {

    public function allLoan()
    {
        $transactions = LoanTransaction::with('application')
            ->where('is_paid', 1)
            ->orderBy('member_id', 'ASC')
            ->get();

        if ($transactions->isNotEmpty()) {
            return $transactions;
        }

        return false;
    }

    public function memberLoan($request, $memberId)
    {
        $transactions = LoanTransaction::with('application')
            ->where('is_paid', 1)
            ->where('member_id', $memberId);

        if ($request->from_date && $request->to_date) {
            $from_date = databaseFormattedDate($request->from_date);
            $to_date = databaseFormattedDate($request->to_date);
            $transactions = $transactions->whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date);
        }

        $transactions = $transactions->get();

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
        $transactions = DpsTransaction::with('application')
            ->where('is_paid', 1)
            ->get();

        if ($transactions->isNotEmpty()) {
            return $transactions;
        }

        return false;
    }

    public function memberDps($request, $memberId)
    {
        $transactions = DpsTransaction::with('application')
            ->where('is_paid', 1)
            ->where('member_id', $memberId);

        if ($request->from_date && $request->to_date) {
            $from_date = databaseFormattedDate($request->from_date);
            $to_date = databaseFormattedDate($request->to_date);
            $transactions = $transactions->whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date);
        }

        $transactions = $transactions->get();

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

    public function allPaidDps()
    {
        $transactions = DpsTransaction::with('application')->where('is_paid', true)->latest()->get();

        if ($transactions->isNotEmpty()) {
            return $transactions;
        }

        return false;
    }

    public function allDueDps()
    {
        $transactions = DpsTransaction::with('application')->where('is_paid', false)->latest()->get();

        if ($transactions->isNotEmpty()) {
            return $transactions;
        }

        return false;
    }

    public function allPaidLoan()
    {
        $transactions = DpsTransaction::with('application')->where('is_paid', true)->latest()->get();

        if ($transactions->isNotEmpty()) {
            return $transactions;
        }

        return false;
    }

    public function allDueLoan()
    {
        $transactions = DpsTransaction::with('application')->where('is_paid', false)->latest()->get();

        if ($transactions->isNotEmpty()) {
            return $transactions;
        }

        return false;
    }


    public function savingsAccountTransactions($request, $memberId)
    {
        $transactions = Savings:: where('member_id', $memberId);
        if ($request->from_date && $request->to_date) {
            $from_date = databaseFormattedDate($request->from_date);
            $to_date = databaseFormattedDate($request->to_date);
            $transactions = $transactions->whereDate('created_at', '>=', $from_date)->whereDate('created_at', '<=', $to_date);
        }
        $transactions =$transactions->get();

        if ($transactions->isNotEmpty()) {
            return $transactions;
        }

        return false;
    }

}
