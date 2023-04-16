<?php

namespace App\Http\Controllers;

use App\Repositories\Member\MemberRepositoryInterface;
use App\Repositories\Savings\SavingsRepositoryInterface;
use Illuminate\Http\Request;
use PDF;

class SavignsReportController extends Controller
{
    protected SavingsRepositoryInterface $savingsRepository;
    protected MemberRepositoryInterface $memberRepository;

    public function __construct(
        SavingsRepositoryInterface $savingsRepository,
        MemberRepositoryInterface $memberRepository,
    )
    {
        $this->savingsRepository = $savingsRepository;
        $this->memberRepository = $memberRepository;
    }

    public function allSavingsTransactions(Request $request)
    {
        $savingsTransactions = $this->savingsRepository->allSavingsTransactions($request);

        $filterData = $this->getFormattedFilterData($request);

        $data =[
            'transactions'=> $savingsTransactions,
        ];

        return PDF::loadview('pdf.savings-report', compact('data', 'filterData'), [], [
            'format' => 'A4-L'
        ])->stream(time().'-savings-transactions-report.pdf');
    }

    public function getFormattedFilterData($request)
    {
        if ($request->member_id) {
            $member = $this->memberRepository->find($request->input('member_id'));
        }

        return [
            'from_date' => $request->input('from_date', null),
            'to_date' => $request->input('to_date', null),
            'member' => $member ?? null,
        ];
    }
}
