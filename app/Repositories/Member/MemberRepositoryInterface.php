<?php
namespace App\Repositories\Member;

interface MemberRepositoryInterface {
    public function all();

    public function store($request);

    public function update($request, $id);

    public function delete($id);

    public function find($id);

    public function storeNominee($request, $member_id);

    public function updateNominee($request, $id);

    public function deleteNominee($id);

    public function duplicateCheck($request);
}
