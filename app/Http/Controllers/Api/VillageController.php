<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Village\VillageRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VillageController extends Controller
{
    protected $village;

    public function __construct(VillageRepositoryInterface $village)
    {
        $this->village = $village;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $villages = $this->village->all();

        if ($villages) {
            return response()->json([
                'status' => true,
                'villages' => $villages,
                'message' => 'Found villages data'
            ]);
        }

        return response()->json([
            'status' => false,
            'villages' => null,
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'upazilla_id' => 'required',
            'union_id' => 'required',
            'name' => 'required',
            'bn_name' => 'required'
        ];

        $validation = Validator::make($request->all(), $rules, ['upazilla_id.required' => 'Upazilla filed is required', 'union_id.required' => 'Union field is required']);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ]);
        }

        //check duplicate
        if ($this->village->duplicate([
            'upazilla_id' => $request->input('upazilla_id'),
            'union_id' => $request->input('union_id'),
            'name' => $request->input('name'),
        ])) {
            return response()->json([
                'status' => false,
                'message' => 'Village already exists'
            ]);
        }

        $village = $this->village->store($request);

        if ($village) {
            return response()->json([
                'status' => true,
                'village' => $village,
                'message' => 'Village has been stored successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to store village'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $village = $this->village->find($id);

        if ($village) {
            return response()->json([
                'status' => true,
                'village' => $village,
                'message' => 'Found village data'
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
            'upazilla_id' => 'required',
            'union_id' => 'required',
            'name' => 'required',
            'bn_name' => 'required'
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ]);
        }

        $village = $this->village->update($request, $id);

        if ($village) {
            return response()->json([
                'status' => true,
                'village' => $village,
                'message' => 'Village has been updated successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'village' => null,
            'message' => 'Failed to update village'
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
        if ($this->village->delete($id)) {
            return response()->json([
                'status' => true,
                'message' => 'Village has been deleted successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to delete village'
        ]);
    }
}
