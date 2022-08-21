<?php

namespace App\Repositories\Report;

interface ReportRepositoryInterface
{
    public function allLoan();

    public function memberLoan($memberId);

    public function allDps();

    public function memberDps($memberId);

    public function allCurrentLoan();

    public function allCurrentDps();

    public function allPaidDps();

    public function allDueDps();

    public function allPaidLoan();

    public function allDueLoan();

    public function savingsAccountTransactions($memberId);
}
