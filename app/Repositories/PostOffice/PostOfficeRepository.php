<?php

namespace App\Repositories\PostOffice;

use App\Models\PostOffice;

class PostOfficeRepository implements PostOfficeRepositoryInterface {

    protected $model;

    public function __construct(PostOffice $model)
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
