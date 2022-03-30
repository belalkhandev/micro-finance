<?php

namespace App\Repositories\Savings;

use App\Models\Savings;

class SavingsRepository implements SavingsRepositoryInterface {

    public function all()
    {
        $savings = Savings::get();

        if ($savings->isNotEmpty()) {
            return $savings;
        }

        return false;
    }

    public function memberSavings($member_id)
    {
        $savings = Savings::where('member_id', $member_id)->get();

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
        $savings->savings_date = $request->input('savings_date');

        if ($request->input('loan_transaction_id')) {
            $savings->loan_transaction_id = $request->input('loan_transaction_id');
        }

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
        $savings->savings_date = $request->input('savings_date');

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
