<?php

namespace App\Repositories\Savings;

use App\Models\LoanTransaction;
use App\Models\Savings;
use Carbon\Carbon;

class SavingsRepository implements SavingsRepositoryInterface {

    public function allSavingsTransactions($request)
    {
        $savings = Savings::with('member');

        if ($request->member_id) {
            $savings->where('member_id', $request->member_id);
        }

        if ($request->filled(['from_date', 'to_date'])) {
            $fromDate = Carbon::parse($request->from_date)->startOfDay();
            $toDate = Carbon::parse($request->to_date)->endOfDay();
            $savings->whereDate('created_at', '>=', $fromDate)
                ->whereDate('created_at', '<=', $toDate);
        }

        return $savings->get();
    }

    public function getByPaginate($request, $limit = 15)
    {
        $savings = Savings::with('member');

        if ($request->member_id) {
            $savings->where('member_id', $request->member_id);
        }

        if ($request->filled(['from_date', 'to_date'])) {
            $fromDate = Carbon::parse($request->from_date)->startOfDay();
            $toDate = Carbon::parse($request->to_date)->endOfDay();
            $savings->whereDate('created_at', '>=', $fromDate)
                ->whereDate('created_at', '<=', $toDate);
        }

        if ($request->status) {
            $savings->where('savings_type', $request->status);
        }

        $savings = $savings->latest()->paginate($limit);

        $tempSavings = $savings;

        $totalDepositAmount = $tempSavings->where('savings_type', 'deposit')->sum('amount');
        $totalWithdrawAmount = $tempSavings->where('savings_type', 'withdraw')->sum('amount');

        return array_merge($savings->toArray(), [
            'total_deposit_amount' => $totalDepositAmount,
            'total_withdraw_amount' => $totalWithdrawAmount,
            'total_balance' => $totalDepositAmount - $totalWithdrawAmount
        ]);

    }

    public function memberSavings($member_id)
    {
        $savings = Savings::where('member_id', $member_id)->latest()->get();

        if ($savings->isNotEmpty()) {
            return $savings;
        }

        return false;
    }

    public function getMemberSavings($memberId)
    {
        return Savings::where('member_id', $memberId)->get();
    }

    public function store($request)
    {
        $savings = new Savings();
        $savings->member_id = $request->input('member_id');
        $savings->savings_type = $request->input('savings_type');
        $savings->amount = $request->input('amount');
        $savings->savings_date = $request->input('savings_date') ? databaseFormattedDate($request->input('savings_date')) : databaseFormattedDate(Carbon::now());
        $savings->remarks = $request->input('remarks') ?: null;

        if ($request->input('loan_transaction_id')) {
            $savings->loan_transaction_id = $request->input('loan_transaction_id');
        }

        $memberSavings = $this->getMemberSavings($request->member_id);
        $totalDeposit = $memberSavings->where('savings_type', 'deposit')->sum('amount');
        $totalWithdraw = $memberSavings->where('savings_type', 'withdraw')->sum('amount');
        $beginningBalance = $totalDeposit - $totalWithdraw;

        if ($request->input('savings_type') == 'deposit') {
            $endingBalance = $beginningBalance + $request->input('amount');
        } else {
            $endingBalance = $beginningBalance - $request->input('amount');
        }

        $savings->beginning_balance = $beginningBalance;
        $savings->ending_balance = $endingBalance;

        if ($savings->save()) {
            return $savings;
        }

        return false;
    }

    public function storeFromLoan($request)
    {
        $transaction = LoanTransaction::find($request->input('transaction_id'));

        $savings = new Savings();
        $savings->member_id = $transaction->member_id;
        $savings->savings_type = $request->input('savings_type');
        $savings->amount = $request->input('savings_amount');
        $savings->savings_date = $request->input('savings_date') ? databaseFormattedDate($request->input('savings_date')) : databaseFormattedDate(Carbon::now());
        $savings->loan_transaction_id = $transaction->id;
        $savings->remarks = $request->input('remarks') ?: null;

        $memberSavings = $this->getMemberSavings($request->member_id);
        $totalDeposit = $memberSavings->where('savings_type', 'deposit')->sum('amount');
        $totalWithdraw = $memberSavings->where('savings_type', 'withdraw')->sum('amount');
        $beginningBalance = $totalDeposit - $totalWithdraw;

        if ($request->input('savings_type') == 'deposit') {
            $endingBalance = $beginningBalance + $request->input('amount');
        } else {
            $endingBalance = $beginningBalance - $request->input('amount');
        }

        $savings->beginning_balance = $beginningBalance;
        $savings->ending_balance = $endingBalance;

        if ($savings->save()) {
            return $savings;
        }

        return false;
    }

    public function update($request, $id)
    {
        $savings = Savings::find($id);
        $savings->member_id = $request->input('member_id');
        $savings->savings_type = $request->input('savings_type');
        $savings->amount = $request->input('amount');
        $savings->savings_date = $request->input('savings_date') ? databaseFormattedDate($request->input('savings_date')) : databaseFormattedDate(Carbon::now());
        $savings->remarks = $request->input('remarks') ?: null;

        if ($request->input('loan_transaction_id')) {
            $savings->loan_transaction_id = $request->input('loan_transaction_id');
        }

        if ($savings->save()) {
            return $savings;
        }

        return false;
    }

    public function delete($id)
    {
        $savings = Savings::find($id);

        if ($savings) {
            return $savings->delete();
        }

        return false;
    }

    public function find($id)
    {
        $savings = Savings::find($id);
        if ($savings) {
            return $savings;
        }

        return false;
    }


}
