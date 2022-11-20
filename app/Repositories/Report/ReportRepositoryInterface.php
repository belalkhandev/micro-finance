<?php

namespace App\Repositories\Report;

interface ReportRepositoryInterface
{
    public function allLoan($request);

    public function memberLoan($request, $memberId);

    public function allDps();

    public function memberDps($request, $memberId);

    public function allCurrentLoan();

    public function allCurrentDps();

    public function allPaidDps();

    public function allDueDps();

    public function allPaidLoan();

    public function allDueLoan();

    public function savingsAccountTransactions($request, $memberId);
}
