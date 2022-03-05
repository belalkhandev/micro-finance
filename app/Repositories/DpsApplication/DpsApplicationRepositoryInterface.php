<?php

namespace App\Repositories\DpsApplication;

interface DpsApplicationRepositoryInterface
{
    public function all();
    public function store($request);
    public function update($request, $id);
    public function delete($id);
    public function find($id);

    public function memberDps($member_id);
    public function memberDpsTransactions($member_id);
    public function dpsTransactions($dps_id);

    public function transactionStore($request, $dps_id);
    public function transactionUpdate($request, $trans_id);
    public function transactionDelete($trans_id);
    public function transactionFind($trans_id);
}
