<?php

namespace App\Repositories\DpsTransaction;

use App\Models\DpsApplication;
use App\Models\DpsTransaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DpsTransactionRepository implements DpsTransactionRepositoryInterface {

    public function all()
    {
        $transactions = DpsTransaction::with('application')
            ->orderBy('is_paid', 'ASC')
            ->latest()
            ->get();

        if ($transactions->isNotEmpty()) {
            return $transactions;
        }

        return false;
    }

    public function getByPaginate($request, $limit)
    {
        $transactions = DpsTransaction::with('member:id,account_no,name,photo', 'application:id,dps_type');

        if ($request->from_date && $request->to_date) {
            $transactions = $transactions->whereDate('created_at', '>=', databaseFormattedDate($request->from_date))
                ->whereDate('created_at', '<=', databaseFormattedDate($request->to_date));
        }

        if ($request->member_id) {
            $transactions = $transactions->where('member_id', $request->member_id);
        }

        $transactions = $transactions->latest()->paginate($limit);

        $transactions = array_merge($transactions->toArray(), [
            'total_dps_amount' => $this->totalDpsTransactions($request),
            'total_paid_dps_amount' => $this->totalDpsTransactions($request, 'paid'),
            'total_unpaid_dps_amount' => $this->totalDpsTransactions($request, 'unpaid')
        ]);


        if ($transactions) {
            return $transactions;
        }

        return false;
    }

    public function allPaid($request, $limit = 20)
    {
        $transactions = DpsTransaction::with('member:id,account_no,name,photo', 'application:id,dps_type')->where('is_paid', 1);

        if ($request->from_date && $request->to_date) {
            $transactions = $transactions->whereDate('created_at', '>=', databaseFormattedDate($request->from_date))
                ->whereDate('created_at', '<=', databaseFormattedDate($request->to_date));
        }

        if ($request->member_id) {
            $transactions = $transactions->where('member_id', $request->member_id);
        }

        $transactions = $transactions->latest()->paginate($limit);

        $transactions = array_merge($transactions->toArray(), [
            'total_paid_amount' => $this->totalPaidTransactions()
        ]);

        if ($transactions) {
            return $transactions;
        }

        return false;
    }

    public function allUnpaid($request, $limit = 20)
    {
        $transactions = DpsTransaction::with('member:id,account_no,name,photo', 'application:id,dps_type')->where('is_paid', 0);

        if ($request->from_date && $request->to_date) {
            $transactions = $transactions->whereDate('created_at', '>=', databaseFormattedDate($request->from_date))
                ->whereDate('created_at', '<=', databaseFormattedDate($request->to_date));
        }

        if ($request->member_id) {
            $transactions = $transactions->where('member_id', $request->member_id);
        }

        $transactions = $transactions->latest()->paginate($limit);

        $transactions = array_merge($transactions->toArray(), [
            'total_unpaid_amount' => $this->totalUnpaidTransactions()
        ]);

        if ($transactions) {
            return $transactions;
        }

        return false;
    }

    public function memberTransactions($member_id)
    {
        $transactions = DpsTransaction::with('application')
            ->where('member_id', $member_id)
            ->where('is_paid', 1)
            ->latest()->get();

        if ($transactions->isNotEmpty()) {
            return $transactions;
        }

        return false;
    }

    public function generateTransaction($request)
    {
        $tr_date = $request->input('from_date');
        $tr_to = $request->input('to_date');

        if ($tr_date > $tr_to) {
            $temp_date = $tr_date;
            $tr_date = $tr_to;
            $tr_to = $temp_date;
        }

        try {
            do{
                $date = databaseFormattedDate($tr_date);
                if ($request->input('application_type') == 'weekly') {
                    $day_name = Carbon::parse($date)->dayName;
                    $applications = DpsApplication::where('w_day', $day_name)->where('is_active', 1)->get();

                } else {
                    $app_start_date = Carbon::parse($date)->format('d');
                    $applications = DpsApplication::whereDay('m_date', $app_start_date)->where('m_date', '<=', $date)->where('is_active', 1)->get();
                }

                foreach ($applications as $application) {
                    $transactions_amount = $this->applicationTransactions($application->id) ? $this->applicationTransactions($application->id)->sum('amount') : 0;
                    if ($transactions_amount < $application->total_amount) {
                        $this->store($application, $date);
                    }
                }

                $tr_date = Carbon::parse($date)->addDay();

            }while(databaseFormattedDate($tr_date) <= databaseFormattedDate($tr_to));

            return true;

        }catch (\Exception $e) {
            return false;
        }

    }

    public function store($application, $date)
    {
        try{
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
            $tr->created_by = Auth::guard('sanctum')->user()->id;

            if ($tr->save()) {
                return $tr;
            }

            return false;
        }catch (\Exception $e) {
            return false;
        }


    }

    public function payment($request)
    {
        if ($request->input('payment_status') != 'paid') {
            return false;
        }

        $transaction = $this->find($request->input('transaction_id'));

        $dpsApplication = DpsApplication::find($transaction->dps_application_id);
        $beginningBalance = $dpsApplication->balance;

        $transaction->beginning_balance = $beginningBalance;
        $transaction->ending_balance = $beginningBalance + $transaction->amount;
        $transaction->is_paid = 1;
        $transaction->transaction_date = databaseFormattedDate($request->input('transaction_date'));
        $transaction->updated_by = Auth::guard('sanctum')->user()->id;

        if ($transaction->save()) {
            $dpsApplication->balance = $transaction->ending_balance;
            $dpsApplication->save();

            return $transaction;
        }

        return false;
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


    public function applicationTransactions($app_id)
    {
        $transactions = DpsTransaction::where('dps_application_id', $app_id)->get();

        if ($transactions->isNotEmpty()) {
            return $transactions;
        }

        return false;
    }

    private function totalPaidTransactions()
    {
        return round(DpsTransaction::query()->where('is_paid', 1)->sum('amount'), 2);
    }

    private function totalUnpaidTransactions()
    {
        return round(DpsTransaction::query()->where('is_paid', 0)->sum('amount'), 2);
    }

    private function totalDpsTransactions($request, $paidStatus = 'all'): float
    {
        $transactions = DpsTransaction::query();

        if ($paidStatus === 'paid') {
            $transactions = $transactions->where('is_paid', 1);
        } else if ($paidStatus === 'unpaid') {
            $transactions = $transactions->where('is_paid', 0);
        }

        if ($request->from_date && $request->to_date) {
            $transactions = $transactions->whereDate('created_at', '>=', databaseFormattedDate($request->from_date))
                ->whereDate('created_at', '<=', databaseFormattedDate($request->to_date));
        }

        if ($request->member_id) {
            $transactions = $transactions->where('member_id', $request->member_id);
        }

        $transactions = $transactions->sum('amount');

        return round($transactions, 2);
    }

}
