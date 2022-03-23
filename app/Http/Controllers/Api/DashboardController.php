<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DpsTransaction;
use App\Models\Expense;
use App\Models\LoanTransaction;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function widgetData()
    {
        $dps_trs = DpsTransaction::get();
        $lns_trs = LoanTransaction::get();
        $members = Member::get()->count();
        $admins = User::get()->count();
        $transactions_dps = $dps_trs->where('is_paid', 1)->sum('amount');
        $transactions_loan = $lns_trs->where('is_paid', 1)->sum('amount');

        $total_collection = $transactions_dps+$transactions_loan;
        $total_dues = $dps_trs->where('is_paid', 0)->sum('amount')+$lns_trs->where('is_paid', 0)->sum('amount')-$total_collection;
        $full_paid = 0;
        $no_paid = 0;
        $total_expense = Expense::get()->sum('amount');
        $fund_amount = $total_collection-$total_expense;

        return response()->json([
            'status' => true,
            'data' => [
                 'members' => $members,
                 'admins' => $admins,
                 'transactions_dps' => $transactions_dps,
                 'transactions_loan' => $transactions_loan,
                 'total_collection' => $total_collection,
                 'total_dues' => $total_dues,
                 'full_paid' => $full_paid,
                 'no_paid' => $no_paid,
                 'fund_amount' => $fund_amount,
                 'total_expense' => $total_expense,
            ]
        ]);
    }
}
