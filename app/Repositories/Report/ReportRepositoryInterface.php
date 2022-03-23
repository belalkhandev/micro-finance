<?php

namespace App\Repositories\Report;

interface ReportRepositoryInterface
{
    public function allLoan();

    public function allDps();

    public function allCurrentLoan();

    public function allCurrentDps();
}
