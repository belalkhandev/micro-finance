<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Member\MemberRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    protected $member;

    public function __construct(MemberRepositoryInterface $member)
    {
        $this->member = $member;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $members = $this->member->all();

        if ($members) {
            return response()->json([
                'status' => true,
                'members' => $members,
                'message' => 'Found members data'
            ]);
        }

        return response()->json([
            'status' => false,
            'members' => null,
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
            'name' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'village_id' => 'required',
            'post_office_id' => 'required',
            'address' => 'required',
            'joining_date' => 'required',
            'account_no' => 'required',
            'member_type' => 'required',
            'day' => 'required',
            'nominee_name' => 'required',
            'nominee_father_name' => 'required',
            'nominee_mother_name' => 'required',
            'nominee_gender' => 'required',
            'nominee_phone' => 'required',
            'member_photo' => 'nullable|mimes:jpg,png,jpeg',
            'nominee_photo' => 'nullable|mimes:jpg,png,jpeg',
        ];

        $messages = [
            'father_name.required' => "Father or spouse name is required",
            'nominee_father_name.required' => "Father or spouse name is required",
            'village_id.required' => "Village is required",
            'post_office_id.required' => "Post office is required",
        ];

        $validation = Validator::make($request->all(), $rules, $messages);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ]);
        }

        //check duplication account number on different group
        if ($this->member->duplicateCheck($request)) {
            return response()->json([
                'status' => false,
                'errors' => [
                    'account_no' => ["Account number already exist!"]
                ]
            ]);
        }

        $member = $this->member->store($request);

        if ($member) {
            //store nominee
            $this->member->storeNominee($request, $member->id);
            return response()->json([
                'status' => true,
                'member' => $member,
                'message' => 'Member has been stored successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to store member'
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
        $member = $this->member->find($id);

        if ($member) {
            return response()->json([
                'status' => true,
                'member' => $member,
                'message' => 'Found member data'
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
            'member_name' => 'required'
        ];

        $validation = Validator::make($request->all(), $rules);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ]);
        }

        $member = $this->member->update($request, $id);

        if ($member) {
            //store none
            $this->member->updateNominee($request, $member->nominee->id);
            return response()->json([
                'status' => true,
                'member' => $member,
                'message' => 'Member has been updated successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'member' => null,
            'message' => 'Failed to update member'
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
        if ($this->member->delete($id)) {
            return response()->json([
                'status' => true,
                'message' => 'member has been deleted successfully'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Failed to delete member'
        ]);
    }
}
