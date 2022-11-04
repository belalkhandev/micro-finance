<?php

namespace App\Repositories\ExpenseCategory;

interface ExpenseCategoryRepositoryInterface
{
    public function all();

    public function store($request);

    public function update($request, $id);

    public function delete($id);

    public function find($id);

    public function search($search);
}
