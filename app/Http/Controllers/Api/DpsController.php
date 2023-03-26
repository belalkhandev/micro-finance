<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DpsApplication;
use App\Repositories\CloseDpsApplicationRepository;
use App\Repositories\DpsApplication\DpsApplicationRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DpsController extends Controller
{
    protected $dps;
    protected CloseDpsApplicationRepository $closeDpsApplicationRepository;

    public function __construct(
        DpsApplicationRepositoryInterface $dps,
        CloseDpsApplicationRepository $closeDpsApplicationRepository
    )
    {
        $this->dps = $dps;
        $this->closeDpsApplicationRepository = $closeDpsApplicationRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $applications = $this->dps->getByPaginate($request, 20);

        if ($applications) {
            return response()->json([
                'status' => true,
                'applications' => $applications,
                'message' => 'Dps applications found'
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $application = $this->dps->find($id);

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'member_id' => 'required',
            'dps_amount' => 'required',
            'year' => 'required',
            'receiving' => 'required',
            'dps_type' => 'required',
        ];

        $messages = [
            'member_id.required' => 'Member is required',
            'dps_amount.required' => 'DPS amount is required',
            'receiving.required' => 'Getting/Receiving Amount is Required'
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

        if ($request->input('dps_type') === 'monthly' && $request->input('m_date') === 'Invalid date') {
            return response()->json([
                'status' => false,
                'errors' => [
                    'm_date' => ["Select a date for start installment"]
                ]
            ]);
        }

        $dps = $this->dps->store($request);

        if ($dps) {
            return response()->json([
                'status' => true,
                'application' => $dps,
                'message' => 'DPS application has been saved'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to store Dps Application'
        ]);
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
            'dps_amount' => 'required',
            'year' => 'required',
            'receiving' => 'required',
            'dps_type' => 'required',
        ];

        $messages = [
            'member_id.required' => 'Member is required',
            'dps_amount.required' => 'DPS amount is required',
            'receiving.required' => 'Getting/Receiving Amount is Required'
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

        if ($request->input('dps_type') === 'monthly' && $request->input('m_date') === 'Invalid date') {
            return response()->json([
                'status' => false,
                'errors' => [
                    'm_date' => ["Select a date for start installment"]
                ]
            ]);
        }

        $dps = $this->dps->update($request, $id);

        if ($dps) {
            return response()->json([
                'status' => true,
                'application' => $dps,
                'message' => 'DPS application has been updated'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to update Dps Application'
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
        if ($this->dps->delete($id)) {
            return response()->json([
                'status' => true,
                'message' => 'Dps application has been deleted successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to delete Dps application'
        ]);
    }

    public function dpsApplicationCalculation()
    {
        $accounts = $this->dps->all();
        $total_amounts = $accounts ? $accounts->sum('total_amount') : 0;
        $collections = $accounts ? $accounts->sum('balance') : 0;
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
    public function closeDpsApplication(Request $request, $id)
    {
        $rules = [
            'deposit_balance' => 'required',
            'payment' => 'required',
            'transaction_no' => 'required_if:payment_method,mobile_banking',
            'cheque_no' => 'required_if:payment_method,bank',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ]);
        }

        $close = $this->closeDpsApplicationRepository->storeByRequest($request);

        if ($close) {
            $this->dps->updateStatus($id, 'closed');
        }

        return response()->json([
            'status' => true,
            'message' => 'Dps application has been closed successfully'
        ]);
    }

}
