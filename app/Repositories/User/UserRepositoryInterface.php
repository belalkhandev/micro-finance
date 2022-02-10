<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    public function all($excepts_ids);

    public function store($request);

    public function update($request, $id);

    public function delete($id);

    public function find($id);

    public function storeProfile($request, $user_id);
}
