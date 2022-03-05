<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\LoanApplication\LoanApplicationRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LoanController extends Controller
{
    protected $loan;

    public function __construct(LoanApplicationRepositoryInterface  $loan)
    {
        $this->loan = $loan;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $applications = $this->loan->all();

        if ($applications) {
            return response()->json([
                'status' => true,
                'applications' => $applications,
                'message' => 'Loan applications found'
            ]);
        }

        return response()->json([
            'status' => false,
            'applications' => null,
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
            'member_id' => 'required',
            'loan_amount' => 'required',
            'service' => 'required',
            'installment' => 'required',
            'loan_type' => 'required',
        ];

        $messages = [
            'member_id.required' => 'Member is required',
            'loan_amount.required' => 'Loan amount is required',
        ];

        $validation = Validator::make($request->all(), $rules, $messages);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ]);
        }

        $loan = $this->loan->store($request);

        if ($loan) {
            return response()->json([
                'status' => true,
                'dps' => $loan,
                'message' => 'Loan application has been saved'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to store Loan Application'
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
        $loan = $this->loan->find($id);

        if ($loan) {
            return response()->json([
                'status' => true,
                'member' => $loan,
                'message' => 'Found Loan application data'
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'member_id' => 'required',
            'loan_amount' => 'required',
            'service' => 'required',
            'installment' => 'required',
            'loan_type' => 'required',
        ];

        $messages = [
            'member_id.required' => 'Member is required',
            'loan_amount.required' => 'Loan amount is required',
        ];

        $validation = Validator::make($request->all(), $rules, $messages);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ]);
        }

        $loan = $this->loan->update($request, $id);

        if ($loan) {
            return response()->json([
                'status' => true,
                'dps' => $loan,
                'message' => 'Loan application has been updated'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to update Loan Application'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if ($this->loan->delete($id)) {
            return response()->json([
                'status' => true,
                'message' => 'Loan application has been deleted successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to delete Loan application'
        ]);
    }
}
