<?php

namespace App\Repositories\PostOffice;

use App\Models\PostOffice;

class PostOfficeRepository implements PostOfficeRepositoryInterface {

    public function all()
    {
        $offices = PostOffice::get();

        if ($offices->isNotEmpty()) {
            return $offices;
        }

        return false;
    }

    public function store($request)
    {
        $po = new PostOffice();
        $po->upazilla_id = $request->input('upazilla_id');
        $po->union_id = $request->input('union_id');
        $po->name = $request->input('name');
        $po->bn_name = $request->input('bn_name');
        $po->code = $request->input('post_code');

        if ($po->save()) {
            return $po;
        }

        return false;

    }

    public function update($request, $id)
    {
        $po = PostOffice::find($id);
        $po->upazilla_id = $request->input('upazilla_id');
        $po->union_id = $request->input('union_id');
        $po->name = $request->input('name');
        $po->bn_name = $request->input('bn_name');
        $po->code = $request->input('post_code');

        if ($po->save()) {
            return $po;
        }

        return false;
    }

    public function delete($id)
    {
        $po = PostOffice::find($id);

        if ($po) {
            $po->delete();
        }

        return false;
    }

    public function find($id)
    {
        $po = PostOffice::find($id);

        if ($po) {
            return $po;
        }

        return false;
    }

    public function duplicate($filters)
    {
        $po = PostOffice::where('name', $filters['name'])->where('upazilla_id', $filters['upazilla_id'])->where('union_id', $filters['union_id'])->first();

        if ($po) {
            return true;
        }

        return false;
    }


}
