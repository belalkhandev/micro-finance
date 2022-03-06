<?php

namespace App\Repositories\DpsApplication;

use App\Models\DpsApplication;
use App\Models\DpsInstallment;
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

    public function store($request)
    {
        $dps = new DpsApplication();
        $dps->member_id = $request->input('member_id');
        $dps->dps_amount = $request->input('dps_amount');
        $dps->year = $request->input('year');
        $dps->receiving = $request->input('receiving');
        $dps->profit = $request->input('profit');
        $dps->dps_type = $request->input('dps_type');

        if ($request->input('dps_type') === 'weekly') {
            $dps->w_day = $request->input('w_day');
        }else {
            $dps->w_date = databaseFormattedDate($request->input('w_date'));
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
        $dps->receiving = $request->input('receiving');
        $dps->profit = $request->input('profit');
        $dps->balance = $request->input('balance');
        $dps->dps_type = $request->input('dps_type');

        if ($request->input('dps_type') === 'weekly') {
            $dps->w_day = $request->input('w_day');
        }else {
            $dps->w_date = databaseFormattedDate($request->input('w_date'));
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
        $transactions = DpsInstallment::where('dps_application_id', $dps_id)->get();

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
        $transactions = DpsInstallment::where('member_id', $member_id)->get();

        if ($transactions) {
            return $transactions;
        }

        return false;
    }

    public function transactionStore($request, $dps_id)
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
