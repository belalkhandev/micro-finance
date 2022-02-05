<?php

namespace App\Repositories\MemberGroup;

interface MemberGroupRepositoryInterface
{
    public function all();

    public function store($request);

    public function update($request, $id);

    public function delete($id);

    public function find($id);
}
