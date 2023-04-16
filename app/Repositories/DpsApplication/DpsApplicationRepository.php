<?php

namespace App\Repositories\DpsApplication;

use App\Models\DpsApplication;
use App\Models\DpsTransaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DpsApplicationRepository implements DpsApplicationRepositoryInterface {

    public function allApplications($request)
    {
        $applications = DpsApplication::with('member:id,account_no,name,photo');

        if ($request->member_id) {
            $applications->where('member_id', $request->member_id);
        }

        if ($request->filled(['from_date', 'to_date'])) {
            $fromDate = Carbon::parse($request->from_date)->startOfDay();
            $toDate = Carbon::parse($request->to_date)->endOfDay();
            $applications->whereDate('created_at', '>=', $fromDate)
                ->whereDate('created_at', '<=', $toDate);
        }

        if($request->status) {
            $applications = $applications->where('status', $request->status);
        }

        return $applications->get();
    }


    public function getByPaginate($request, $limit = 20)
    {
        $applications = DpsApplication::with('member:id,account_no,name,photo');

        if ($request->member_id) {
            $applications = $applications->where('member_id', $request->member_id);
        }

        if ($request->from_date && $request->to_date) {
            $applications = $applications->whereDate('created_at', '>=', databaseFormattedDate($request->from_date))
                ->whereDate('created_at', '<=', databaseFormattedDate($request->to_date));
        }

        $applications = $applications->latest()->paginate($limit);

        $tempApplications = $applications;

        $applications = array_merge($applications->toArray(), [
            'total_dps_amount' => $tempApplications->sum('total_amount'),
            'total_receivable_amount' => $tempApplications->sum('receiving'),
            'total_profitable_amount' => $tempApplications->sum('profit'),
        ]);

        if ($applications) {
            return $applications;
        }

        return false;
    }

    public function store($request)
    {
        $dps = new DpsApplication();
        $dps->member_id = $request->input('member_id');
        $dps->dps_amount = $request->input('dps_amount');
        $dps->year = $request->input('year');
        $dps->total_amount = $request->input('total_dps');
        $dps->receiving = $request->input('receiving');
        $dps->profit = $request->input('profit');
        $dps->dps_type = $request->input('dps_type');

        if ($request->input('prev_deposit')) {
            $dps->prev_deposit = $request->input('prev_deposit');
            $dps->balance = $request->input('prev_deposit');
            $dps->remarks = $request->input('remarks');
        }

        if ($request->input('dps_type') === 'weekly') {
            $dps->w_day = $request->input('w_day');
        }else {
            $dps->m_date = databaseFormattedDate($request->input('m_date'));
        }

        $dps->created_by = Auth::guard('sanctum')->user()->id;

        if ($dps->save()) {
            return $dps;
        }

        return false;

    }

    public function update($request, $id)
    {
        $dps = DpsApplication::find($id);
        $dps->member_id = $request->input('member_id');
        $dps->dps_amount = $request->input('dps_amount');
        $dps->year = $request->input('year');
        $dps->total_amount = $request->input('total_dps');
        $dps->receiving = $request->input('receiving');
        $dps->profit = $request->input('profit');
        $dps->dps_type = $request->input('dps_type');
        $dps->status = $request->input('status');

        if ($request->input('prev_deposit')) {
            $dps->prev_deposit = $request->input('prev_deposit');
            $dps->balance = $dps->transactionsTotalAmount() + $request->input('prev_deposit');
            $dps->remarks = $request->input('remarks');
        }

        if ($request->input('dps_type') === 'weekly') {
            $dps->w_day = $request->input('w_day');
            $dps->m_date = null;
        }else {
            $dps->w_day = null;
            $dps->m_date = databaseFormattedDate($request->input('m_date'));
        }

        $dps->updated_by = Auth::guard('sanctum')->user()->id;

        if ($dps->save()) {
            return $dps;
        }

        return false;
    }

    public function delete($id)
    {
        $dps = DpsApplication::find($id);

        if ($dps) {
            return $dps->delete();
        }

        return false;
    }

    public function find($id)
    {
        return DpsApplication::with('member:id,account_no,name,photo,phone,member_type', 'createdUser:id,name', 'transactions', 'closeApplication', 'closeApplication.user')->find($id);
    }

    public function dpsTransactions($dps_id)
    {
        $transactions = DpsTransaction::where('dps_application_id', $dps_id)->get();

        if ($transactions) {
            return $transactions;
        }

        return false;
    }

    public function memberDps($member_id)
    {
        $dps = DpsApplication::with('transactions')->where('member_id', $member_id)->get();

        if ($dps) {
            return $dps;
        }

        return false;
    }

    public function memberDpsTransactions($member_id)
    {
        $transactions = DpsTransaction::where('member_id', $member_id)->get();

        if ($transactions) {
            return $transactions;
        }

        return false;
    }

    public function updateStatus($id, $status)
    {
        $application = DpsApplication::findOrFail($id);
        $application->status = $status;
        return $application->save();
    }

}
