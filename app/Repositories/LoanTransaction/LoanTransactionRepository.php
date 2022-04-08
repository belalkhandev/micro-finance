<?php

namespace App\Repositories\LoanTransaction;

use App\Models\LoanApplication;
use App\Models\LoanTransaction;
use Carbon\Carbon;

class LoanTransactionRepository implements LoanTransactionRepositoryInterface {

    public function all()
    {
        $transactions = LoanTransaction::with('application')->orderBy('is_paid', 'ASC')->latest()->get();

        if ($transactions->isNotEmpty()) {
            return $transactions;
        }

        return false;
    }

    public function memberTransactions($member_id)
    {
        $transactions = LoanTransaction::with('application')
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
        $tr_date = databaseFormattedDate($request->input('from_date'));
        $tr_to = databaseFormattedDate($request->input('to_date'));

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
                    $applications = LoanApplication::where('w_day', $day_name)->where('is_active', 1)->get();
                } else {
                    $app_start_date = Carbon::parse($date)->format('d');
                    $applications = LoanApplication::whereDay('m_date', $app_start_date)->where('is_active', 1)->get();
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

        $tr = LoanTransaction::where('loan_application_id', $application->id)->whereDate('transaction_date', $date)->first();

        if(!$tr) {
            $tr = new LoanTransaction();
            $tr->transaction_no = LoanTransaction::where('loan_application_id', $application->id)->get()->count() + 1;
        }

        $tr->loan_application_id = $application->id;
        $tr->member_id = $application->member_id;
        $tr->transaction_date = $date;
        if ($application->dps_type === 'weekly') {
            $tr->due_date = Carbon::parse($date)->addDay(3);
        } else {
            $tr->due_date = Carbon::parse($date)->addDay(10);
        }
        $tr->amount = $application->installment_amount;

        if ($tr->save()) {
            return true;
        }

        return false;

    }

    public function payment($request)
    {
        $transaction = $this->find($request->input('transaction_id'));

        $last_balance = LoanTransaction::where('loan_application_id', $transaction->loan_application_id)
            ->where('is_paid', 1)
            ->where('id', '!=', $transaction->id)
            ->get()
            ->sum('amount');

        if ($request->input('payment_status') === 'paid') {
            $transaction->balance = $last_balance+$transaction->amount;
            $transaction->is_paid = 1;
        } else {
            $transaction->balance = 0;
            $transaction->is_paid = 0;
        }

        if ($transaction->save()) {
            //update loan application balance

            //update dps_application balance
            $all_transactions = $this->all()->where('is_paid', 1)->sum('amount');
            $loan_application = LoanApplication::find($transaction->loan_application_id);
            $loan_application->balance = $all_transactions;
            $loan_application->save();

            return $transaction;
        }

        return false;
    }

    public function delete($id)
    {
        $dps = LoanTransaction::find($id);

        if ($dps) {
            return $dps->delete();
        }

        return false;
    }

    public function find($id)
    {
        $dps = LoanTransaction::find($id);

        if ($dps) {
            return $dps;
        }

        return false;
    }

    public function applicationTransactions($app_id)
    {
        $transactions = LoanTransaction::where('loan_application_id', $app_id)->get();

        if ($transactions->isNotEmpty()) {
            return $transactions;
        }

        return false;
    }

}
