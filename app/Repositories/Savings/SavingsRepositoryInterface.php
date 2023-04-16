<?php

namespace App\Repositories\Savings;

interface SavingsRepositoryInterface
{
    public function allSavingsTransactions($request);

    public function getByPaginate($request, $limit);

    public function memberSavings($member_id);

    public function store($request);

    public function storeFromLoan($request);

    public function update($request, $id);

    public function delete($id);

    public function find($id);
}
