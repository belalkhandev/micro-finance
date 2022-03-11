<?php

namespace App\Repositories\DpsTransaction;

interface DpsTransactionRepositoryInterface
{
    public function all();
    public function generate();
    public function store($request);
    public function update($request, $id);
    public function delete($id);
    public function find($id);
}
