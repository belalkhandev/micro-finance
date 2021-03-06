<?php

namespace App\Repositories\LoanTransaction;

interface LoanTransactionRepositoryInterface
{
    public function all();
    public function allUnpaid();
    public function allPaid();
    public function generateTransaction($request);
    public function store($application, $date);
    public function payment($request);
    public function delete($id);
    public function find($id);
    public function applicationTransactions($app_id);
    public function memberTransactions($member_id);
}
