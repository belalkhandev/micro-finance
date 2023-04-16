<?php

namespace App\Repositories\Report;

use App\Models\LoanTransaction;
use App\Models\DpsTransaction;
use App\Models\Savings;
use Carbon\Carbon;

class ReportRepository implements ReportRepositoryInterface {

    public function allLoan($request, $limit = 20)
    {
        $transactions = LoanTransaction::with('member:id,account_no,name,photo', 'application:id,dps_type')
            ->where('is_paid', 1);

        if ($request->from_date && $request->to_date) {
            $transactions = $transactions->whereDate('paid_at', '>=', databaseFormattedDate($request->from_date))
                ->whereDate('paid_at', '<=', databaseFormattedDate($request->to_date));
        }

        if ($request->member_id) {
            $transactions = $transactions->where('member_id', $request->member_id);
        }

        $transactions = $transactions->latest()->paginate($limit);


        $transactions = array_merge($transactions->toArray(), [
            'total_loan_amount' => $this->totalLoanTransactions($request),
            'total_paid_loan_amount' => $this->totalLoanTransactions($request, 'paid'),
            'total_unpaid_loan_amount' => $this->totalLoanTransactions($request, 'unpaid')
        ]);

        if ($transactions) {
            return $transactions;
        }

        return false;
    }

    public function memberLoan($request, $memberId)
    {
        $transactions = LoanTransaction::with('member:id,account_no,name,photo', 'application:id,dps_type')
            ->where('is_paid', 1)
            ->where('member_id', $memberId);

        if ($request->from_date && $request->to_date) {
            $from_date = databaseFormattedDate($request->from_date);
            $to_date = databaseFormattedDate($request->to_date);
            $transactions = $transactions->whereDate('created_at', '>=', $from_date)
                ->whereDate('created_at', '<=', $to_date);
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
        $transactions = LoanTransaction::with('member:id,account_no,name,photo', 'application:id,dps_type')
            ->whereDate('transaction_date', '=', $today )
            ->orderBy('is_paid', 'ASC')
            ->latest()
            ->get();

        if ($transactions->isNotEmpty()) {
            return $transactions;
        }

        return false;
    }

    public function allDps($request, $limit = 20)
    {
        $transactions = DpsTransaction::with('member:id,account_no,name,photo', 'application:id,dps_type')
            ->where('is_paid', 1);

        if ($request->from_date && $request->to_date) {
            $transactions = $transactions->whereDate('created_at', '>=', databaseFormattedDate($request->from_date))
                ->whereDate('created_at', '<=', databaseFormattedDate($request->to_date));
        }

        if ($request->member_id) {
            $transactions = $transactions->where('member_id', $request->member_id);
        }

        $transactions = $transactions->latest()->paginate($limit);

        $transactions = array_merge($transactions->toArray(), [
            'total_dps_amount' => $this->totalDpsTransactions($request),
            'total_paid_dps_amount' => $this->totalDpsTransactions($request, 'paid'),
            'total_unpaid_dps_amount' => $this->totalDpsTransactions($request, 'unpaid')
        ]);

        if ($transactions) {
            return $transactions;
        }

        return false;
    }

    public function memberDps($request, $memberId)
    {
        $transactions = DpsTransaction::with('member:id,account_no,name,photo', 'application:id,dps_type')
            ->where('is_paid', 1)
            ->where('member_id', $memberId);

        if ($request->from_date && $request->to_date) {
            $from_date = databaseFormattedDate($request->from_date);
            $to_date = databaseFormattedDate($request->to_date);
            $transactions = $transactions
                ->whereDate('created_at', '>=', $from_date)
                ->whereDate('created_at', '<=', $to_date);
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
        $transactions = DpsTransaction::with('member:id,account_no,name,photo', 'application:id,dps_type')
            ->whereDate('transaction_date', '=',$today )
            ->paid()
            ->orderBy('is_paid', 'ASC')
            ->latest()
            ->get();

        if ($transactions->isNotEmpty()) {
            return $transactions;
        }

        return false;
    }

    public function allPaidDps()
    {
        $transactions = DpsTransaction::with('member:id,account_no,name,photo', 'application:id,dps_type')->where('is_paid', true)->latest()->get();

        if ($transactions->isNotEmpty()) {
            return $transactions;
        }

        return false;
    }

    public function allDueDps()
    {
        $transactions = DpsTransaction::with('member:id,account_no,name,photo', 'application:id,dps_type')->where('is_paid', false)->latest()->get();

        if ($transactions->isNotEmpty()) {
            return $transactions;
        }

        return false;
    }

    public function allPaidLoan()
    {
        $transactions = DpsTransaction::with('member:id,account_no,name,photo', 'application:id,dps_type')
            ->where('is_paid', true)->latest()->get();

        if ($transactions->isNotEmpty()) {
            return $transactions;
        }

        return false;
    }

    public function allDueLoan()
    {
        $transactions = DpsTransaction::with('member:id,account_no,name,photo', 'application:id,dps_type')
            ->where('is_paid', false)->latest()->get();

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
            $transactions = $transactions->whereDate('created_at', '>=', $from_date)
                ->whereDate('created_at', '<=', $to_date);
        }
        $transactions =$transactions->get();

        if ($transactions->isNotEmpty()) {
            return $transactions;
        }

        return false;
    }

    private function totalDpsTransactions($request, $paidStatus = 'all'): float
    {
        $transactions = DpsTransaction::query();

        if ($paidStatus === 'paid') {
            $transactions = $transactions->where('is_paid', 1);
        } else if ($paidStatus === 'unpaid') {
            $transactions = $transactions->where('is_paid', 0);
        }

        if ($request->from_date && $request->to_date) {
            $transactions = $transactions->whereDate('created_at', '>=', databaseFormattedDate($request->from_date))
                ->whereDate('created_at', '<=', databaseFormattedDate($request->to_date));
        }

        if ($request->member_id) {
            $transactions = $transactions->where('member_id', $request->member_id);
        }

        $transactions = $transactions->sum('amount');

        return round($transactions, 2);
    }

    private function totalLoanTransactions($request, $paidStatus = 'all'): float
    {
        $transactions = LoanTransaction::query();

        if ($paidStatus === 'paid') {
            $transactions = $transactions->where('is_paid', 1);
        } else if ($paidStatus === 'unpaid') {
            $transactions = $transactions->where('is_paid', 0);
        }

        if ($request->from_date && $request->to_date) {
            $transactions = $transactions->whereDate('created_at', '>=', databaseFormattedDate($request->from_date))
                ->whereDate('created_at', '<=', databaseFormattedDate($request->to_date));
        }

        if ($request->member_id) {
            $transactions = $transactions->where('member_id', $request->member_id);
        }

        $transactions = $transactions->sum('amount');

        return round($transactions, 2);
    }

    public function allDpsDownload($request)
    {
        $transactions = DpsTransaction::with('member:id,account_no,name,photo', 'application:id,dps_type')
            ->where('is_paid', 1);

        if ($request->filled(['from_date', 'to_date'])) {
            $fromDate = Carbon::parse($request->from_date)->startOfDay();
            $toDate = Carbon::parse($request->to_date)->endOfDay();
            $transactions = $transactions->whereDate('paid_at', '>=', $fromDate)->whereDate('paid_at', '<=',$toDate);
        }

        if ($request->member_id) {
            $transactions = $transactions->where('member_id', $request->member_id);
        }

        $transactions = $transactions->latest()->get();

        if ($transactions) {
            return $transactions;
        }

        return false;
    }

    public function downlaodDpsTransactionByApplicationId($applicationId)
    {
        return DpsTransaction::with('member:id,account_no,name,photo', 'application:id,dps_type')
            ->where('dps_application_id', $applicationId)
            ->where('is_paid', 1)
            ->latest()
            ->get();
    }

    public function downlaodLoanTransactionByApplicationId($applicationId)
    {
        return LoanTransaction::with('member:id,account_no,name,photo', 'application:id,dps_type')
            ->where('loan_application_id', $applicationId)
            ->where('is_paid', 1)
            ->latest()
            ->get();
    }

    public function allLoanTransactionsReport($request)
    {
        $transactions = LoanTransaction::with('member:id,account_no,name,photo', 'application:id,dps_type')
            ->where('is_paid', 1);

        if ($request->filled(['from_date', 'to_date'])) {
            $fromDate = Carbon::parse($request->from_date)->startOfDay();
            $toDate = Carbon::parse($request->to_date)->endOfDay();
            $transactions = $transactions->whereDate('paid_at', '>=', $fromDate)->whereDate('paid_at', '<=',$toDate);
        }

        if ($request->member_id) {
            $transactions = $transactions->where('member_id', $request->member_id);
        }

        $transactions = $transactions->orderBy('loan_application_id')->orderBy('transaction_no')->get();

        if ($transactions->isEmpty()) {
            return false;
        }

        return [
            'transactions' => $transactions,
        ];
    }

}
