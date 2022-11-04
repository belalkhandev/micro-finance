<?php

namespace App\Repositories\MemberGroup;

use App\Models\MemberGroup;

class MemberGroupRepository implements MemberGroupRepositoryInterface {

    public function all()
    {
        $groups = MemberGroup::get();

        if ($groups->isNotEmpty()) {
            return $groups;
        }

        return false;
    }

    public function store($request)
    {
        $group = new MemberGroup();
        $group->group_no = $request->input('group_no');
        $group->group_name = $request->input('group_name');
        $group->day = $request->input('day');

        if ($group->save()) {
            return $group;
        }

        return false;

    }

    public function update($request, $id)
    {
        $group = MemberGroup::find($id);
        $group->group_no = $request->input('group_no');
        $group->group_name = $request->input('group_name');
        $group->day = $request->input('day');

        if ($group->save()) {
            return $group;
        }

        return false;
    }

    public function delete($id)
    {
        $group = MemberGroup::find($id);

        if ($group) {
            return $group->delete();
        }

        return false;
    }

    public function find($id)
    {
        $group = MemberGroup::find($id);

        if ($group) {
            return $group;
        }

        return false;
    }


}
