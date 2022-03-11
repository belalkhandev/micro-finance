<?php

namespace App\Repositories\DpsTransaction;

use App\Models\DpsApplication;
use App\Models\DpsInstallment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LoanTransactionRepository implements LoanTransactionRepositoryInterface {

    public function all()
    {
        $applications = DpsApplication::latest()->get();

        if ($applications->isNotEmpty()) {
            return $applications;
        }

        return false;
    }

    public function generate()
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
        $dps->total_amount = $request->input('total_dps');
        $dps->receiving = $request->input('receiving');
        $dps->profit = $request->input('profit');
        $dps->dps_type = $request->input('dps_type');

        if ($request->input('dps_type') === 'weekly') {
            $dps->w_day = $request->input('w_day');
        }else {
            $dps->m_date = databaseFormattedDate($request->input('m_date'));
        }

        $dps->created_by = Auth::guard('sanctum')->user()->id;

        if ($dps->save()) {
            return $dps->with('member');
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
        $dps->balance = $request->input('balance');
        $dps->dps_type = $request->input('dps_type');

        if ($request->input('dps_type') === 'weekly') {
            $dps->w_day = $request->input('w_day');
        }else {
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

}
