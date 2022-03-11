<?php

namespace App\Repositories\DpsTransaction;

use App\Models\DpsApplication;
use App\Models\DpsTransaction;
use Carbon\Carbon;

class DpsTransactionRepository implements DpsTransactionRepositoryInterface {

    public function all()
    {
        $applications = DpsApplication::latest()->get();

        if ($applications->isNotEmpty()) {
            return $applications;
        }

        return false;
    }

    public function generateTransaction($request)
    {
        $tr_date = $request->input('from_date');
        $tr_to = $request->input('to_date');

        try {
            do{
                $date = databaseFormattedDate($tr_date);
                if ($request->input('application_type') == 'weekly') {
                    $day_name = Carbon::parse($date)->dayName();
                    $applications = DpsApplication::where('w_day', $day_name)->wherNe('is_active', 1)->get();
                } else {
                    $app_start_date = Carbon::parse($date)->format('d');
                    $applications = DpsApplication::whereDay('m_date', $app_start_date)->wherNe('is_active', 1)->get();
                }

                foreach ($applications as $application) {
                    $this->store($application, $date);
                }

                $tr_date = Carbon::parse($date)->addDay();
            }while(databaseFormattedDate($tr_date) > databaseFormattedDate($tr_to));
        }catch (\Exception $e) {
            return false;
        }

    }

    public function store($application, $date)
    {
        $tr = DpsTransaction::where('dps_application_id', $application->id)->whereDate('transaction_date', $date)->first();
        if(!$tr) {
           $tr = new DpsTransaction();
           $tr->transaction_no = DpsTransaction::where('dps_application_id', $application->id)->get()->count() + 1;
        }
        $tr->dps_application_id = $application->id;
        $tr->member_id = $application->member_id;
        $tr->transaction_date = $date;
        if ($application->dps_type === 'weekly') {
            $tr->due_date = Carbon::parse($date)->addDay(3);
        } else {
            $tr->due_date = Carbon::parse($date)->addDay(10);
        }
        $tr->amount = $application->dps_amount;

        if ($tr->save()) {
            return true;
        }

        return false;


    }

    public function payment($request)
    {
        //payment
    }

    public function delete($id)
    {
        $dps = DpsTransaction::find($id);

        if ($dps) {
            return $dps->delete();
        }

        return false;
    }

    public function find($id)
    {
        $dps = DpsTransaction::find($id);

        if ($dps) {
            return $dps;
        }

        return false;
    }

}
