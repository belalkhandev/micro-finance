<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Expense\ExpenseRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    protected $expense;

    public function __construct(ExpenseRepositoryInterface $expense)
    {
        $this->expense = $expense;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $expenses = $this->expense->all();

        if ($expenses) {
            return response()->json([
                'status' => true,
                'expenses' => $expenses,
                'message' => 'Found expenses data'
            ]);
        }

        return response()->json([
            'status' => false,
            'expenses' => null,
            'message' => 'No data found'
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'amount' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ], 422);
        }

        $expense = $this->expense->store($request);

        if ($expense) {
            return response()->json([
                'status' => true,
                'expense' => $expense,
                'message' => 'expense has been stored successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to store expense'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $expense = $this->expense->find($id);

        if ($expense) {
            return response()->json([
                'status' => true,
                'expense' => $expense,
                'message' => 'Found expense data'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'No data found'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'amount' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ], 422);
        }

        $expense = $this->expense->update($request, $id);

        if ($expense) {
            return response()->json([
                'status' => true,
                'expense' => $expense,
                'message' => 'expense has been updated successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'expense' => null,
            'message' => 'Failed to update expense'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->expense->delete($id)) {
            return response()->json([
                'status' => true,
                'message' => 'expense has been deleted successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to delete expense'
        ]);
    }
}
