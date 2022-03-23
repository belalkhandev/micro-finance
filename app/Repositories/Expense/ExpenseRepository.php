<?php

namespace App\Repositories\Expense;

use App\Models\Expense;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ExpenseRepository implements ExpenseRepositoryInterface {

    public function all()
    {
        $expenses = Expense::get();

        if ($expenses->isNotEmpty()) {
            return $expenses;
        }

        return false;
    }

    public function store($request)
    {
        $expense = new Expense();
        $expense->expense_category_id = $request->input('expense_category_id');
        $expense->title = $request->input('expense_title');
        $expense->description = $request->input('description');
        $expense->amount = $request->input('amount');
        $expense->expense_type = $request->input('expense_type');
        $expense->expense_date = $request->input('expense_date') ? Carbon::parse($request->input('expense_date'))->format('Y-m-d') : Carbon::now()->format('Y-m-d');
        $expense->created_by = Auth::guard('sanctum')->user()->id;

        if ($expense->save()) {
            return $expense;
        }

        return false;

    }

    public function update($request, $id)
    {
        $expense = Expense::find($id);
        $expense->expense_category_id = $request->input('expense_category_id');
        $expense->description = $request->input('description');
        $expense->amount = $request->input('amount');
        $expense->expense_date = $request->input('expense_date') ? Carbon::parse($request->input('expense_date'))->format('Y-m-d') : Carbon::now()->format('Y-m-d');
        $expense->updated_by = Auth::guard('sanctum')->user()->id;

        if ($expense->save()) {
            return $expense;
        }

        return false;
    }

    public function delete($id)
    {
        $expense = Expense::find($id);

        if ($expense) {
            return $expense->delete();
        }

        return false;
    }

    public function find($id)
    {
        $expense = Expense::find($id);

        if ($expense) {
            return $expense;
        }

        return false;
    }


}
