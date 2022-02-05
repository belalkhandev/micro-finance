<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements UserInterface {

    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;   
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