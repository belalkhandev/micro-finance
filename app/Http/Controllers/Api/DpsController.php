<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\DpsApplication\DpsApplicationRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DpsController extends Controller
{
    protected $dps;

    public function __construct(DpsApplicationRepositoryInterface $dps)
    {
        $this->dps = $dps;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $applications = $this->dps->all();

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

        //validation monthly date
        if ($request->input('m_date') === 'Invalid date') {
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $dps = $this->dps->find($id);

        if ($dps) {
            return response()->json([
                'status' => true,
                'member' => $dps,
                'message' => 'Found DPS application data'
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

        //validation monthly date
        if ($request->input('m_date') === 'Invalid date') {
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

}
