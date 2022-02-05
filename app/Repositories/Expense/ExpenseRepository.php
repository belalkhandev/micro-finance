<?php

namespace App\Repositories\Expense;

use App\Models\Expense;

class ExpenseRepository implements ExpenseRepositoryInterface {

    protected $model;

    public function __construct(Expense $model)
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
