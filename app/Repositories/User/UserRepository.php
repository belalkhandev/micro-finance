<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements UserRepositoryInterface {

    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function all()
    {

    }

    public function store($requst)
    {

    }

    public function update($request, $id)
    {

    }

    public function delete($id)
    {

    }

    public function find($id)
    {

    }


}
