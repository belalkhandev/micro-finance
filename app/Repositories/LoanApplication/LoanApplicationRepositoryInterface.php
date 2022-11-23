<?php

namespace App\Repositories\LoanApplication;

interface LoanApplicationRepositoryInterface
{
    public function all();
    public function getByPaginate($request, $limit);
    public function store($request);
    public function update($request, $id);
    public function delete($id);
    public function find($id);

    public function memberLoans($member_id);
    public function memberLoanTransactions($member_id);
    public function loanTransactions($loan_id);

    public function transactionStore($request, $loan_id);
    public function transactionUpdate($request, $trans_id);
    public function transactionDelete($trans_id);
    public function transactionFind($trans_id);
}
