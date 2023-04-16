<?php

namespace App\Repositories\Expense;

interface ExpenseRepositoryInterface
{
    public function allExpenses($request);

    public function getByPaginate($request, $limit);

    public function store($request);

    public function update($request, $id);

    public function delete($id);

    public function find($id);
}
