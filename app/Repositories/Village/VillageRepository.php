<?php

namespace App\Repositories\Village;

use App\Models\Village;

class VillageRepository implements VillageRepositoryInterface {

    public function all()
    {
        $villages = Village::get();

        if ($villages->isNotEmpty()) {
            return $villages;
        }

        return false;
    }

    public function store($request)
    {
        $village = new Village();
        $village->upazilla_id = $request->input('upazilla_id');
        $village->union_id = $request->input('union_id');
        $village->name = $request->input('name');
        $village->bn_name = $request->input('bn_name');

        if ($village->save()) {
            return $village;
        }

        return false;

    }

    public function update($request, $id)
    {
        $village = Village::find($id);
        $village->upazilla_id = $request->input('upazilla_id');
        $village->union_id = $request->input('union_id');
        $village->name = $request->input('name');
        $village->bn_name = $request->input('bn_name');

        if ($village->save()) {
            return $village;
        }

        return false;
    }

    public function delete($id)
    {
        $village = Village::find($id);

        if ($village) {
            return $village->delete();
        }

        return false;
    }

    public function find($id)
    {
        $village = Village::find($id);

        if ($village) {
            return $village;
        }

        return false;
    }

    public function duplicate($filters)
    {
        $village = Village::where('name', $filters['name'])->where('upazilla_id', $filters['upazilla_id'])->where('union_id', $filters['union_id'])->first();

        if ($village) {
            return true;
        }

        return false;
    }


}
