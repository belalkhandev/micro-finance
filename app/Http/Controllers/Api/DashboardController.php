<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DpsTransaction;
use App\Models\Expense;
use App\Models\LoanApplication;
use App\Models\LoanTransaction;
use App\Models\Member;
use App\Models\Savings;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function widgetData()
    {
        $dps_trs = DpsTransaction::latest()->get();
        $lns_trs = LoanTransaction::latest()->get();
        $savings = Savings::all();
        $recent_dps_trs = $dps_trs->where('is_paid', 1)->take(5);
        $recent_lns_trs = $lns_trs->where('is_paid', 1)->take(5);
        $loan_applications = LoanApplication::where('is_active', 1)->get();
        $members = Member::get()->count();
        $admims = User::get()->count();
        $transactions_dps = $dps_trs->where('is_paid', 1)->sum('amount');
        $transactions_loan = $lns_trs->where('is_paid', 1)->sum('amount');
        $total_collection = $transactions_dps+$transactions_loan;
        $total_dues = $dps_trs->where('is_paid', 0)->sum('amount')+$lns_trs->where('is_paid', 0)->sum('amount')-$total_collection;
        $full_paid = 0;
        $no_paid = 0;
        $dps_savings = $savings->where('savings_type', 'deposit')->sum('amount');
        $wtd_savings = $savings->where('savings_type', 'withdraw')->sum('amount');
        $balance_savings = $dps_savings - $wtd_savings;
        $total_expense = Expense::get()->sum('amount');
        $fund_amount = $total_collection+$balance_savings-$total_expense-$loan_applications->sum('loan_amount');

        return response()->json([
            'status' => true,
            'data' => [
                 'members' => $members,
                 'transactions_dps' => $transactions_dps,
                 'transactions_loan' => $transactions_loan,
                 'total_collection' => $total_collection,
                 'total_dues' => $total_dues,
                 'full_paid' => $full_paid,
                 'no_paid' => $no_paid,
                 'fund_amount' => $fund_amount,
                 'total_expense' => $total_expense,
                'admins' => $admims
            ]
        ]);
    }
}
