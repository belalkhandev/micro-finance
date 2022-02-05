<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\MemberGroup\MemberGroupRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberGroupController extends Controller
{
    protected $group;

    public function __construct(MemberGroupRepositoryInterface $group)
    {
        $this->group = $group;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = $this->group->all();

        if ($groups) {
            return response()->json([
                'status' => true,
                'groups' => $groups,
                'message' => 'Found groups data'
            ]);
        }

        return response()->json([
            'status' => false,
            'groups' => null,
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
            'group_name' => 'required',
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ], 422);
        }
        
        $group = $this->group->store($request);

        if ($group) {
            return response()->json([
                'status' => true,
                'group' => $group,
                'message' => 'Group has been stored successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to store group'
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
        $group = $this->group->find($id);

        if ($group) {
            return response()->json([
                'status' => true,
                'group' => $group,
                'message' => 'Found group data'
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
            'group_name' => 'required'
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ], 422);
        }

        $group = $this->group->update($request, $id);

        if ($group) {
            return response()->json([
                'status' => true,
                'group' => $group,
                'message' => 'Group has been updated successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'group' => null,
            'message' => 'Failed to update group'
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
        if ($this->group->delete($id)) {
            return response()->json([
                'status' => true,
                'message' => 'Group has been deleted successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to delete group'
        ]);
    }
}
