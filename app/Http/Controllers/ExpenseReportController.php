<?php

namespace App\Http\Controllers;

use App\Repositories\Expense\ExpenseRepositoryInterface;
use Illuminate\Http\Request;
use PDF;

class ExpenseReportController extends Controller
{
    public function __construct(
        protected ExpenseRepositoryInterface $expenseRepository
    )
    {
    }

    public function allExpenses(Request $request)
    {
        $expenses = $this->expenseRepository->allExpenses($request);

        $filterData = $this->getFormattedFilterData($request);

        $data =[
            'expenses'=> $expenses,
        ];

        return PDF::loadview('pdf.expenses-report', compact('data', 'filterData'), [], [
            'format' => 'A4-L'
        ])->stream(time().'-expenses-report.pdf');
    }

    public function getFormattedFilterData($request)
    {
        return [
            'from_date' => $request->input('from_date', null),
            'to_date' => $request->input('to_date', null),
        ];
    }
}
