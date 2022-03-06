<?php

namespace App\Repositories\LoanApplication;

use App\Models\LoanApplication;
use App\Models\LoanInstallment;
use Illuminate\Support\Facades\Auth;

class LoanApplicationRepository implements LoanApplicationRepositoryInterface {

    public function all()
    {
        $applications = LoanApplication::latest()->get();

        if ($applications->isNotEmpty()) {
            return $applications;
        }

        return false;
    }

    public function store($request)
    {
        $loan = new LoanApplication();
        $loan->member_id = $request->input('member_id');
        $loan->loan_amount = $request->input('loan_amount');
        $loan->service = $request->input('service');
        $loan->service_amount = $request->input('service_amount');
        $loan->total_amount = $request->input('total_loan');
        $loan->installment = $request->input('total_installment');
        $loan->installment_amount = $request->input('installment_amount');
        $loan->balance = $request->input('total_loan');
        $loan->dps_type = $request->input('dps_type');

        if ($request->input('dps_type') === 'weekly') {
            $loan->w_day = $request->input('w_day');
        }else {
            $loan->w_date = databaseFormattedDate($request->input('w_date'));
        }

        $loan->created_by = Auth::guard('sanctum')->user()->id;

        if ($loan->save()) {
            return $loan;
        }

        return false;

    }

    public function update($request, $id)
    {
        $loan = LoanApplication::find($id);
        $loan->member_id = $request->input('member_id');
        $loan->loan_amount = $request->input('dps_amount');
        $loan->service = $request->input('service');
        $loan->service_amount = $request->input('service_amount');
        $loan->total_amount = $request->input('total_loan');
        $loan->installment = $request->input('installment');
        $loan->installment_amount = $request->input('installment_amount');
        $loan->balance = $request->input('total_loan');
        $loan->dps_type = $request->input('dps_type');

        if ($request->input('dps_type') === 'weekly') {
            $loan->w_day = $request->input('w_day');
        }else {
            $loan->w_date = databaseFormattedDate($request->input('w_date'));
        }

        $loan->created_by = Auth::guard('sanctum')->user()->id;

        if ($loan->save()) {
            return $loan;
        }

        return false;
    }

    public function delete($id)
    {
        $loan = LoanApplication::find($id);

        if ($loan) {
            return $loan->delete();
        }

        return false;
    }

    public function find($id)
    {
        $loan = LoanApplication::with('transactions')->find($id);

        if ($loan) {
            return $loan;
        }

        return false;
    }

    public function loanTransactions($loan_id)
    {
        $transactions = LoanApplication::where('loan_application_id', $loan_id)->get();

        if ($transactions) {
            return $transactions;
        }

        return false;
    }

    public function memberLoans($member_id)
    {
        $dps = LoanApplication::with('transactions')->where('member_id', $member_id)->get();

        if ($dps) {
            return $dps;
        }

        return false;
    }

    public function memberLoanTransactions($member_id)
    {
        $transactions = LoanInstallment::where('member_id', $member_id)->get();

        if ($transactions) {
            return $transactions;
        }

        return false;
    }

    public function transactionStore($request, $loan_id)
    {
        // TODO: Implement transactionStore() method.
    }

    public function transactionUpdate($request, $trans_id)
    {
        // TODO: Implement transactionUpdate() method.
    }

    public function transactionFind($trans_id)
    {
        // TODO: Implement transactionFind() method.
    }

    public function transactionDelete($trans_id)
    {
        // TODO: Implement transactionDelete() method.
    }


}
