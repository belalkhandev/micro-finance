<?php
namespace App\Repositories\Member;

use App\Models\FileUpload;
use App\Models\Member;
use App\Models\Nominee;
use Illuminate\Support\Facades\Auth;

class MemberRepository implements MemberRepositoryInterface {

    public function all()
    {
        $members = Member::with('nominee')->get();

        if ($members->isNotEmpty()) {
            return $members;
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
        $member->joining_date = $request->input('joining_date');
        $member->member_type = $request->input('member_type');
        $member->member_group_id = $request->input('member_group_id');
        $member->day = $request->input('day');

        //upload photo
        if ($request->hasFile('photo')) {
            $path = FileUpload::upload($request, 'photo', 'members');
            $member->photo = $path;
        }

        $member->created_by = Auth::group('sanctum')->user()->id;

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
        $member->joining_date = $request->input('joining_date');
        $member->member_type = $request->input('member_type');
        $member->member_group_id = $request->input('member_group_id');
        $member->day = $request->input('day');

        if ($request->hasFile('photo')) {
            //delete previous profile photo
            if ($member->photo) {
                unlink($member->photo);
            }

            $path = FileUpload::upload($request, 'photo', 'members');
            $member->photo = $path;
        }

        $member->updated_by = Auth::group('sanctum')->user()->id;

        if ($member->save()) {
            return $member;
        }

        return false;
    }

    public function delete($id)
    {
        $member = Member::find($id);

        if ($member->photo) {
            if ($member->photo) {
                unlink($member->photo);
            }
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
        $nominee = new Member();
        $nominee->member_id = $member_id;
        $nominee->name = $request->input('nominee_name');
        $nominee->father_name = $request->input('nominee_father_name');
        $nominee->mother_name = $request->input('nominee_mother_name');
        $nominee->phone = $request->input('nominee_phone');
        $nominee->nid = $request->input('nominee_nid');
        $nominee->gender = $request->input('nominee_gender');
        $nominee->address = $request->input('nominee_address');
        $nominee->relation = $request->input('nominee_relation');

        if ($request->hasFile('nominee_photo')) {
            $path = FileUpload::upload($request, 'nominee_photo', 'nominees');
            $nominee->photo = $path;
        }
        if ($nominee->save()) {
            return $nominee;
        }

        return false;
    }

    public function updateNominee($request, $id)
    {
        $nominee = Member::find($id);
        $nominee->name = $request->input('nominee_name');
        $nominee->father_name = $request->input('nominee_father_name');
        $nominee->mother_name = $request->input('nominee_mother_name');
        $nominee->phone = $request->input('nominee_phone');
        $nominee->nid = $request->input('nominee_nid');
        $nominee->gender = $request->input('nominee_gender');
        $nominee->address = $request->input('nominee_address');
        $nominee->relation = $request->input('nominee_relation');

        if ($request->hasFile('nominee_photo')) {
            //delete previous profile photo
            if ($nominee->photo) {
                unlink($nominee->photo);
            }

            $path = FileUpload::upload($request, 'nominee_photo', 'nominees');
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
            if ($nominee->photo) {
                unlink($nominee->photo);
            }
        }

        if ($nominee->delete()) {
            return true;
        }

        return false;
    }
}
