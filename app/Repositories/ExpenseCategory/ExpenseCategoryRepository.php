<?php

namespace App\Repositories\ExpenseCategory;

use App\Models\ExpenseCategory;

class ExpenseCategoryRepository implements ExpenseCategoryRepositoryInterface {

    protected $model;

    public function __construct(ExpenseCategory $model)
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
