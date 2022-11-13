<?php

namespace App\Repositories\DpsApplication;

use App\Models\DpsApplication;
use App\Models\DpsTransaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DpsApplicationRepository implements DpsApplicationRepositoryInterface {

    public function all()
    {
        $applications = DpsApplication::latest()->get();

        if ($applications->isNotEmpty()) {
            return $applications;
        }

        return false;
    }

    public function getByPaginate($limit = 20)
    {
        $applications = DpsApplication::with('member:id,account_no,name,photo')
            ->latest()
            ->paginate($limit);

        if ($applications->isNotEmpty()) {
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
        $dps = DpsApplication::with('transactions')->find($id);

        if ($dps) {
            return $dps;
        }

        return false;
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

}
