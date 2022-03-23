<?php

namespace App\Repositories\DpsTransaction;

interface DpsTransactionRepositoryInterface
{
    public function all();
    public function generateTransaction($request);
    public function store($application, $date);
    public function payment($request);
    public function delete($id);
    public function find($id);
    public function applicationTransactions($app_id);
}
