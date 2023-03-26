<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LoanApplication;
use App\Models\LoanTransaction;
use App\Repositories\LoanApplication\LoanApplicationRepositoryInterface;
use Illuminate\Http\JsonResponse;
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
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $applications = $this->loan->getByPaginate($request);

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
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function memberApplications($member_id)
    {
        $applications = LoanApplication::where('member_id', $member_id)->get();
        $total_amount = $applications->sum('total_amount');
        $total_paid = 0;

        foreach ($applications as $application) {
            $total_paid += $application->transactionsTotalAmount();
        }

        if ($applications->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'loan' => [
                    'applications' => $applications,
                    'total_amount' => $total_amount,
                    'total_paid' => $total_paid
                ],
                'message' => 'Loan applications found'
            ]);
        }

        return response()->json([
            'status' => false,
            'loan' => null,
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
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'member_id' => 'required',
            'loan_amount' => 'required',
            'service' => 'required',
            'total_installment' => 'required',
            'dps_type' => 'required',
        ];

        $messages = [
            'member_id.required' => 'Member is required',
            'loan_amount.required' => 'Loan amount is required',
            'total_installment.required' => 'Installment amount is required',
        ];

        if ($request->input('dps_type') === 'weekly') {
            $rules['w_day'] = 'required';
            $messages['w_day.required'] = "Select a weekly date";
        }else if ($request->input('dps_type') === 'monthly') {
            $rules['m_date'] = 'required';
            $messages['m_date.required'] = "Select a date for start installment";
        }

        $validation = Validator::make($request->all(), $rules, $messages);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ]);
        }

        //validation monthly date
        if ($request->input('dps_type') === 'monthly' && $request->input('m_date') === 'Invalid date') {
            return response()->json([
                'status' => false,
                'errors' => [
                    'm_date' => ["Select a date for start installment"]
                ]
            ]);
        }

        $loan = $this->loan->store($request);

        if ($loan) {
            return response()->json([
                'status' => true,
                'application' => $loan,
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
     * @return JsonResponse
     */
    public function show($id)
    {
        $application = $this->loan->find($id);

        if ($application) {
            return response()->json([
                'status' => true,
                'application' => $application,
                'message' => 'Dps application found'
            ]);
        }

        return response()->json([
            'status' => false,
            'application' => null,
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
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'member_id' => 'required',
            'loan_amount' => 'required',
            'service' => 'required',
            'total_installment' => 'required',
            'dps_type' => 'required',
        ];

        $messages = [
            'member_id.required' => 'Member is required',
            'loan_amount.required' => 'Loan amount is required',
            'total_installment.required' => 'Installment amount is required',
        ];

        if ($request->input('dps_type') === 'weekly') {
            $rules['w_day'] = 'required';
            $messages['w_day.required'] = "Select a weekly date";
        }else if ($request->input('dps_type') === 'monthly') {
            $rules['m_date'] = 'required';
            $messages['m_date.required'] = "Select a date for start installment";
        }


        $validation = Validator::make($request->all(), $rules, $messages);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ]);
        }

        //validation monthly date
        if ($request->input('dps_type') === 'monthly' && $request->input('m_date') === 'Invalid date') {
            return response()->json([
                'status' => false,
                'errors' => [
                    'm_date' => ["Select a date for start installment"]
                ]
            ]);
        }

        $loan = $this->loan->update($request, $id);

        if ($loan) {
            return response()->json([
                'status' => true,
                'application' => $loan,
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
     * @return JsonResponse
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


    public function loanApplicationCalculation()
    {
        $accounts = $this->loan->all();
        $total_amounts = $accounts->sum('total_amount');
        $collections = $accounts->sum('balance');
        $dues = $total_amounts - $collections;

        return response()->json([
            'status' => true,
            'total' => [
                'total_amounts' => $total_amounts,
                'collections' => $collections,
                'dues' => $dues,
            ]
        ]);
    }
}
