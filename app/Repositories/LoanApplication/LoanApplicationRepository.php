<?php

namespace App\Repositories\LoanApplication;

use App\Models\LoanApplication;
use App\Models\LoanInstallment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LoanApplicationRepository implements LoanApplicationRepositoryInterface {

    public function all()
    {
        $applications = LoanApplication::with('member:id,account_no,name,photo')
            ->latest()
            ->get();

        if ($applications->isNotEmpty()) {
            return $applications;
        }

        return false;
    }

    public function allApplications($request)
    {
        $applications = LoanApplication::with('member:id,account_no,name,photo');

        if ($request->member_id) {
            $applications->where('member_id', $request->member_id);
        }

        if ($request->filled(['from_date', 'to_date'])) {
            $fromDate = Carbon::parse($request->from_date)->startOfDay();
            $toDate = Carbon::parse($request->to_date)->endOfDay();
            $applications->whereDate('created_at', '>=', $fromDate)->whereDate('created_at', '<=', $toDate);
        }

        if ($request->filled(['status'])) {
            $applications->where('status', $request->status);
        }

        return $applications->get();
    }

    public function getByPaginate($request, $limit = 20)
    {
        $applications = LoanApplication::with('member:id,account_no,name,photo');


        if ($request->filled(['from_date', 'to_date'])) {
            $fromDate = Carbon::parse($request->from_date)->startOfDay();
            $toDate = Carbon::parse($request->to_date)->endOfDay();
            $applications->whereDate('created_at', '>=', $fromDate)->whereDate('created_at', '<=', $toDate);
        }

        if ($request->member_id) {
            $applications = $applications->where('member_id', $request->member_id);
        }

        $applications = $applications->latest()->paginate($limit);

        if ($applications) {
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
        $loan->dps_type = $request->input('dps_type');

        if ($request->input('dps_type') === 'weekly') {
            $loan->w_day = $request->input('w_day');
        }else {
            $loan->m_date = databaseFormattedDate($request->input('m_date'));
        }

        $loan->prev_deposit = $request->input('prev_deposit') ?? 0;
        $loan->balance = $request->input('total_loan') - $request->input('prev_deposit') ?? 0;
        $loan->remarks = $request->input('remarks') ?? null;

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
        $loan->loan_amount = $request->input('loan_amount');
        $loan->service = $request->input('service');
        $loan->service_amount = $request->input('service_amount');
        $loan->total_amount = $request->input('total_loan');
        $loan->installment = $request->input('total_installment');
        $loan->installment_amount = $request->input('installment_amount');
        $loan->dps_type = $request->input('dps_type');

        if ($request->input('dps_type') === 'weekly') {
            $loan->w_day = $request->input('w_day');
            $loan->m_date = null;
        }else {
            $loan->m_date = databaseFormattedDate($request->input('m_date'));
            $loan->w_day = null;
        }


        if ($request->input('prev_deposit')) {
            $loan->prev_deposit = $request->input('prev_deposit');
            $loan->balance = $loan->total_amount - $request->input('prev_deposit');
            $loan->remarks = $request->input('remarks');
        }

        $loan->updated_by = Auth::guard('sanctum')->user()->id;

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
        $loan = LoanApplication::with('member:id,account_no,name,photo,phone,member_type', 'createdUser:id,name', 'paidTransactions', 'closeApplication', 'closeApplication.user')->find($id);

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

        if ($dps->isNotEmpty()) {
            return $dps;
        }

        return false;
    }

    public function memberLoanTransactions($member_id)
    {
        $transactions = LoanInstallment::where('member_id', $member_id)->get();

        if ($transactions->isNotEmpty()) {
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

    public function updateStatus($id, $status)
    {
        $application = LoanApplication::findOrFail($id);
        $application->status = $status;
        return $application->save();
    }


}
