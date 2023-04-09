<?php

namespace App\Repositories\LoanTransaction;

use App\Models\LoanApplication;
use App\Models\LoanTransaction;
use App\Repositories\LoanApplication\LoanApplicationRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\returnArgument;

class LoanTransactionRepository implements LoanTransactionRepositoryInterface {

    protected LoanApplicationRepositoryInterface $applicationRepository;

    public function all()
    {
        $transactions = LoanTransaction::with('application')->orderBy('is_paid', 'ASC')
            ->latest()
            ->get();

        if ($transactions->isNotEmpty()) {
            return $transactions;
        }

        return false;
    }

    public function getByPaginate($request, $limit = 20)
    {
        $transactions = LoanTransaction::with('member:id,account_no,name,photo', 'application:id,dps_type');

        if ($request->from_date && $request->to_date) {
            $transactions = $transactions->whereDate('created_at', '>=', databaseFormattedDate($request->from_date))
                ->whereDate('created_at', '<=', databaseFormattedDate($request->to_date));
        }

        if ($request->member_id) {
            $transactions = $transactions->where('member_id', $request->member_id);
        }

        $transactions = $transactions->latest()->paginate($limit);

        $transactions = array_merge($transactions->toArray(), [
            'total_loan_amount' => $this->totalLoanTransactions($request),
            'total_paid_loan_amount' => $this->totalLoanTransactions($request, 'paid'),
            'total_unpaid_loan_amount' => $this->totalLoanTransactions($request, 'unpaid')
        ]);


        if ($transactions) {
            return $transactions;
        }

        return false;
    }

    public function allPaid($request, $limit = 20)
    {
        $transactions = LoanTransaction::with('member:id,account_no,name,photo', 'application:id,dps_type')->where('is_paid', 1);

        if ($request->from_date && $request->to_date) {
            $transactions = $transactions->whereDate('created_at', '>=', databaseFormattedDate($request->from_date))
                ->whereDate('created_at', '<=', databaseFormattedDate($request->to_date));
        }

        if ($request->member_id) {
            $transactions = $transactions->where('member_id', $request->member_id);
        }

        $transactions = $transactions->latest()->paginate($limit);

        $transactions = array_merge($transactions->toArray(), [
            'total_paid_amount' => $this->totalLoanTransactions($request, 'paid')
        ]);

        if ($transactions) {
            return $transactions;
        }

        return false;
    }

    public function allUnpaid($request, $limit = 20)
    {
        $transactions = LoanTransaction::with('member:id,account_no,name,photo', 'application:id,dps_type')->where('is_paid', 0);

        if ($request->from_date && $request->to_date) {
            $transactions = $transactions->whereDate('created_at', '>=', databaseFormattedDate($request->from_date))
                ->whereDate('created_at', '<=', databaseFormattedDate($request->to_date));
        }

        if ($request->member_id) {
            $transactions = $transactions->where('member_id', $request->member_id);
        }

        $transactions = $transactions->latest()->paginate($limit);

        $transactions = array_merge($transactions->toArray(), [
            'total_unpaid_amount' => $this->totalLoanTransactions($request, 'unpaid')
        ]);

        if ($transactions) {
            return $transactions;
        }

        return false;
    }

    public function memberTransactions($member_id)
    {
        $transactions = LoanTransaction::with('application')
            ->where('member_id', $member_id)
            ->where('is_paid', 1)
            ->latest()
            ->get();

        if ($transactions) {
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
                    $applications = LoanApplication::where('w_day', $day_name)
                        ->active()
                        ->get();
                } else {
                    $app_start_date = Carbon::parse($date)->format('d');
                    $applications = LoanApplication::whereDay('m_date', $app_start_date)
                        ->active()
                        ->get();
                }

                foreach ($applications as $application) {
                    $transactions_amount = $this->applicationTransactions($application->id) ? $this->applicationTransactions($application->id)->sum('amount') : 0;

                    $applicationBalance = $transactions_amount + $application->prev_deposit;
                    $transactionInstallmentAmountDiff = $application->total_amount - $applicationBalance;

                    if ($applicationBalance < $application->total_amount && $transactionInstallmentAmountDiff >= $application->installment_amount) {
                        $this->store($application, $date, $application->installment_amount);
                    } else if ($transactionInstallmentAmountDiff < $application->installment_amount && $transactionInstallmentAmountDiff > 0) {
                        $this->store($application, $date, $transactionInstallmentAmountDiff);
                    }
                }

                $tr_date = Carbon::parse($date)->addDay();
            }while(databaseFormattedDate($tr_date) <= databaseFormattedDate($tr_to));

            return true;
        }catch (\Exception $e) {
            return false;
        }

    }

    public function store($application, $date, $amount)
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
        $tr->amount = $amount;

        $tr->created_by = Auth::guard('sanctum')->user()->id;

        if ($tr->save()) {
            return true;
        }

        return false;

    }

    public function payment($request)
    {
        if ($request->input('payment_status') != 'paid') {
            return false;
        }

        $transaction = $this->find($request->input('transaction_id'));

        $loanApplication = LoanApplication::find($transaction->loan_application_id);
        $beginningBalance = $loanApplication->balance;

        $transaction->beginning_balance = $beginningBalance;
        $transaction->ending_balance = $beginningBalance - $transaction->amount;
        $transaction->is_paid = 1;
        $transaction->paid_at = databaseFormattedDate($request->input('transaction_date'));
        $transaction->updated_by = Auth::guard('sanctum')->user()->id;

        if ($transaction->save()) {
            $loanApplication->balance = $transaction->ending_balance;
            $loanApplication->save();

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

    private function totalLoanTransactions($request, $paidStatus = 'all'): float
    {
        $transactions = LoanTransaction::query();

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
