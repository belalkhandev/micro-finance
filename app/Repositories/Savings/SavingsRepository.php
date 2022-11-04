<?php

namespace App\Repositories\Savings;

use App\Models\LoanTransaction;
use App\Models\Savings;
use Carbon\Carbon;

class SavingsRepository implements SavingsRepositoryInterface {

    public function all()
    {
        $savings = Savings::latest()->get();

        if ($savings->isNotEmpty()) {
            return $savings;
        }

        return false;
    }

    public function memberSavings($member_id)
    {
        $savings = Savings::where('member_id', $member_id)->latest()->get();

        if ($savings->isNotEmpty()) {
            return $savings;
        }

        return false;
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
