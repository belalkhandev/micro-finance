<?php
namespace App\Repositories\Member;

use App\Models\FileUpload;
use App\Models\Member;
use App\Models\Nominee;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class MemberRepository implements MemberRepositoryInterface {

    public function all()
    {
        $members = Member::with('nominee', 'group')->get();

        if ($members->isNotEmpty()) {
            return $members;
        }

        return false;
    }

    public function getByPagination($limit = 15)
    {
        $members = Member::paginate($limit);

        if ($members->isNotEmpty()) {
            return $members;
        }

        return false;
    }

    public function getByGroupPagination($groupId, $limit = 15)
    {
        $members = Member::where('member_group_id', $groupId)->paginate($limit);

        if ($members->isNotEmpty()) {
            return $members;
        }

        return false;
    }

    public function getByMemberId($memberId)
    {
        $member = Member::with('nominee', 'group')->find($memberId);

        if ($member) {
            return $member;
        }

        return false;
    }

    public function store($request)
    {
        $member = new Member();
        $member->account_no = $request->input('account_no');
        $member->name = $request->input('name');
        $member->father_name = $request->input('father_name');
        $member->mother_name = $request->input('mother_name');
        $member->phone = $request->input('phone');
        $member->gender = $request->input('gender');
        $member->biodata = $request->input('biodata');
        $member->nid = $request->input('nid');
        $member->birthdate = $request->input('birthdate');
        $member->address = $request->input('address');
        $member->village_id = $request->input('village_id');
        $member->post_office_id = $request->input('post_office_id');
        $member->union_id = $request->input('union_id');
        $member->upazilla_id = $request->input('upazilla_id');
        $member->district_id = $request->input('district_id');
        $member->division_id = $request->input('division_id');
        $member->joining_date = databaseFormattedDate($request->input('joining_date'));
        $member->member_type = $request->input('member_type');
        $member->member_group_id = $request->input('group');
        $member->day = $request->input('day');
        $member->is_active = $request->input('is_active');

        //upload photo
        if ($request->hasFile('member_photo')) {
            $path = FileUpload::uploadWithResize($request, 'member_photo', 'members', 200, 200);
            $member->photo = $path;
        }

        $member->created_by = Auth::guard('sanctum')->user()->id;

        if ($member->save()) {
            return $member;
        }

        return false;
    }

    public function update($request, $id)
    {
        $member = Member::find($id);
        $member->account_no = $request->input('account_no');
        $member->name = $request->input('name');
        $member->father_name = $request->input('father_name');
        $member->mother_name = $request->input('mother_name');
        $member->phone = $request->input('phone');
        $member->gender = $request->input('gender');
        $member->biodata = $request->input('biodata');
        $member->nid = $request->input('nid');
        $member->birthdate = $request->input('birthdate');
        $member->address = $request->input('address');
        $member->village_id = $request->input('village_id');
        $member->post_office_id = $request->input('post_office_id');
        $member->union_id = $request->input('union_id');
        $member->upazilla_id = $request->input('upazilla_id');
        $member->district_id = $request->input('district_id');
        $member->division_id = $request->input('division_id');
        $member->joining_date = Carbon::parse($request->input('joining_date'))->format('Y-m-d');
        $member->member_type = $request->input('member_type');
        $member->member_group_id = $request->input('group');
        $member->day = $request->input('day');
        $member->is_active = $request->input('is_active');

        if ($request->hasFile('photo')) {
            //delete previous profile photo
            if ($member->photo) {
                $photo = str_replace(URL::to('/')."/", "", $member->photo);
                unlink($photo);
            }

            $path = FileUpload::uploadWithResize($request, 'photo', 'members', 200, 200);
            $member->photo = $path;
        }

        $member->updated_by = Auth::guard('sanctum')->user()->id;

        if ($member->save()) {
            return $member;
        }

        return false;
    }

    public function delete($id)
    {
        $member = Member::find($id);

        if ($member->photo) {
            $photo = str_replace(URL::to('/')."/", "", $member->photo);
            unlink($photo);
        }

        if ($member->delete()) {
            return true;
        }

        return false;
    }

    public function find($id)
    {
        $member = Member::with('nominee')->find($id);

        if ($member) {
            return $member;
        }

        return false;
    }

    public function storeNominee($request, $member_id)
    {
        if ($request->input('nominee_name')) {
            $nominee = new Nominee();
            $nominee->member_id = $member_id;
            $nominee->name = $request->input('nominee_name');
            $nominee->father_name = $request->input('nominee_father_name');
            $nominee->mother_name = $request->input('nominee_mother_name');
            $nominee->phone = $request->input('nominee_phone');
            $nominee->nid = $request->input('nominee_nid');
            $nominee->gender = $request->input('nominee_gender');
            $nominee->address = $request->input('nominee_address');
            $nominee->relation = $request->input('relation');

            if ($request->hasFile('nominee_photo')) {
                $path = FileUpload::uploadWithResize($request, 'nominee_photo', 'nominees', 200, 200);
                $nominee->photo = $path;
            }
            if ($nominee->save()) {
                return $nominee;
            }
        }

        return false;
    }

    public function updateNominee($request, $id)
    {
        $nominee = Nominee::find($id);
        $nominee->name = $request->input('nominee_name');
        $nominee->father_name = $request->input('nominee_father_name');
        $nominee->mother_name = $request->input('nominee_mother_name');
        $nominee->phone = $request->input('nominee_phone');
        $nominee->nid = $request->input('nominee_nid');
        $nominee->gender = $request->input('nominee_gender');
        $nominee->address = $request->input('nominee_address');
        $nominee->relation = $request->input('relation');

        if ($request->hasFile('nominee_photo')) {
            //delete previous profile photo
            if ($nominee->photo) {
                $photo = str_replace(URL::to('/')."/", "", $nominee->photo);
                unlink($photo);
            }

            $path = FileUpload::uploadWithResize($request, 'nominee_photo', 'nominees', 200, 200);
            $nominee->photo = $path;
        }
        if ($nominee->save()) {
            return $nominee;
        }

        return false;
    }

    public function deleteNominee($id)
    {
        $nominee = Nominee::find($id);

        if ($nominee->photo) {
            $photo = str_replace(URL::to('/')."/", "", $nominee->photo);
            unlink($photo);
        }

        if ($nominee->delete()) {
            return true;
        }

        return false;
    }

    public function duplicateCheck($request)
    {
        $id = $request->input('member_id');
        if(!$id) {
            if ($request->input('member_group_id')) {
                $member = Member::where('account_no', $request->input('account_no'))->where('member_group_id', $request->input('member_group_id'))->first();
            } else {
                $member = Member::where('account_no', $request->input('account_no'))->where('member_group_id', null)->first();
            }

            if ($member) {
                return true;
            }
        } else {
            $member = Member::where('account_no', $request->input('account_no'))->where('id', '!=', $id);

            if ($request->input('member_group_id')) {
                $member = $member->where('group_id', $request->input('member_group_id'))->first();
            } else {
                $member = $member->first();
            }

            if ($member) {
                return true;
            }
        }

        return false;
    }
}
