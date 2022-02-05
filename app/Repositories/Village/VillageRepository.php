<?php

namespace App\Repositories\Village;

use App\Models\Village;

class VillageRepository implements VillageRepositoryInterface {

    protected $model;

    public function __construct(Village $model)
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
