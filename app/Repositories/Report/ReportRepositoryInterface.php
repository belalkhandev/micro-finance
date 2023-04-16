<?php

namespace App\Repositories\Report;

interface ReportRepositoryInterface
{
    public function allLoan($request);

    public function allLoanUnpaid($request);

    public function downlaodDpsTransactionByApplicationId($applicationId);

    public function downlaodLoanTransactionByApplicationId($applicationId);

    public function memberLoan($request, $memberId);

    public function allDps($request);
    public function allDpsUnpaid($request);

    public function memberDps($request, $memberId);

    public function allCurrentLoan();

    public function allCurrentDps();

    public function allPaidDps();

    public function allDueDps();

    public function allPaidLoan();

    public function allDueLoan();

    public function savingsAccountTransactions($request, $memberId);
}
