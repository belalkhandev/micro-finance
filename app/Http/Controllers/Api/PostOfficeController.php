<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\PostOffice\PostOfficeRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostOfficeController extends Controller
{
    protected $po;

    public function __construct(PostOfficeRepositoryInterface $po)
    {
        $this->po = $po;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $post_offices = $this->po->all();

        if ($post_offices) {
            return response()->json([
                'status' => true,
                'post_offices' => $post_offices,
                'message' => 'Found post offices data'
            ]);
        }

        return response()->json([
            'status' => false,
            'post_offices' => null,
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
            'upazilla_id' => 'required',
            'name' => 'required',
            'bn_name' => 'required',
            'post_code' => 'required'
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ]);
        }

        //check duplicate
        if ($this->po->duplicate([
            'upazilla_id' => $request->input('upazilla_id'),
            'union_id' => $request->input('union_id'),
            'name' => $request->input('name'),
        ])) {
            return response()->json([
                'status' => false,
                'message' => 'Post office already exists'
            ]);
        }

        $po = $this->po->store($request);

        if ($po) {
            return response()->json([
                'status' => true,
                'post_office' => $po,
                'message' => 'Post office has been stored successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to store post office'
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
        $po = $this->po->find($id);

        if ($po) {
            return response()->json([
                'status' => true,
                'post_office' => $po,
                'message' => 'Found post office data'
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'upazilla_id' => 'required',
            'name' => 'required',
            'bn_name' => 'required',
            'post_code' => 'required'
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ], 422);
        }

        $po = $this->po->update($request, $id);

        if ($po) {
            return response()->json([
                'status' => true,
                'post_office' => $po,
                'message' => 'Post office has been updated successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'post_office' => null,
            'message' => 'Failed to update post office'
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
        if ($this->po->delete($id)) {
            return response()->json([
                'status' => true,
                'message' => 'Post office has been deleted successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to delete post office'
        ]);
    }
}
