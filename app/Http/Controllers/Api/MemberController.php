<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MemberResource;
use App\Http\Resources\MembersResource;
use App\Repositories\Member\MemberRepository;
use App\Repositories\Member\MemberRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    protected $member;
    protected $memberRepo;

    public function __construct(MemberRepositoryInterface $member, MemberRepository $memberRepository)
    {
        $this->member = $member;
        $this->memberRepo = $memberRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $members = $this->memberRepo->getByPagination(20);

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
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function searchData()
    {
        $members = $this->memberRepo->getMembersSearchData();

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
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function membersGroup($groupId)
    {
        $members = $this->memberRepo->getByGroupPagination($groupId, 20);

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
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function membersType($type)
    {
        $members = $this->memberRepo->getByTypePagination($type, 20);

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
     * Show the specific resource.
     *
     * @return JsonResponse
     */
    public function show($memberId)
    {
        $member = $this->memberRepo->getByMemberId($memberId);

        if ($member) {
            return response()->json([
                'status' => true,
                'member' => new MemberResource($member),
                'message' => 'Found members data'
            ]);
        }

        return response()->json([
            'status' => false,
            'member' => null,
            'message' => 'No data found'
        ]);
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
            'name' => 'required',
            'father_name' => 'required',
            'gender' => 'required',
            'phone' => 'required|unique:members,phone',
            'village_id' => 'required',
            'post_office_id' => 'required',
            'joining_date' => 'required',
            'account_no' => 'required',
            'member_type' => 'required',
            'day' => 'required',
//            'nominee_name' => 'required',
//            'nominee_father_name' => 'required',
//            'nominee_gender' => 'required',
//            'nominee_phone' => 'required',
//            'member_photo' => 'nullable|mimes:jpg,png,jpeg',
//            'nominee_photo' => 'nullable|mimes:jpg,png,jpeg',
        ];

        $messages = [
            'father_name.required' => "Father or spouse name is required",
            'village_id.required' => "Village is required",
            'post_office_id.required' => "Post office is required",
        ];


        if ($request->input('nominee_name')) {
            $rules['nominee_father_name'] = 'required';
            $rules['nominee_gender'] = 'required';
            $rules['nominee_phone'] = 'required';

            $messages['nominee_father_name.required'] = "Father/Spouse name is required";
            $messages['nominee_gender.required'] = "Gender is required";
            $messages['nominee_phone.required'] = "Phone is required";
        }

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
            if ($request->input('nominee_name')) {
                $this->member->storeNominee($request, $member->id);
            }
            $member = $this->member->find($member->id);
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
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'father_name' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'village_id' => 'required',
            'post_office_id' => 'required',
            'joining_date' => 'required',
            'account_no' => 'required',
            'member_type' => 'required',
        ];

        $messages = [
            'father_name.required' => "Father or spouse name is required",
            'village_id.required' => "Village is required",
            'post_office_id.required' => "Post office is required",
        ];

        if ($request->input('nominee_name')) {
            $rules['nominee_father_name'] = 'required';
            $rules['nominee_gender'] = 'required';
            $rules['nominee_phone'] = 'required';

            $messages['nominee_father_name.required'] = "Father/Spouse name is required";
            $messages['nominee_gender.required'] = "Gender is required";
            $messages['nominee_phone.required'] = "Phone is required";
        }

        $validation = Validator::make($request->all(), $rules, $messages);

        if ($validation->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validation->errors()
            ]);
        }

        $member = $this->member->update($request, $id);

        if ($member) {
            //store none
            if ($member->nominee) {
                $this->member->updateNominee($request, $member->nominee->id);
            } else {
                if ($request->input('nominee_name')) {
                    $this->member->storeNominee($request, $member->id);
                }
            }
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
     * @return JsonResponse
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
