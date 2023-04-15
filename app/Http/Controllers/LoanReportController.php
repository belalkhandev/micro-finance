<?php

namespace App\Http\Controllers;

use App\Repositories\LoanApplication\LoanApplicationRepositoryInterface;
use App\Repositories\Member\MemberRepositoryInterface;
use Illuminate\Http\Request;
use PDF;

class LoanReportController extends Controller
{
    protected LoanApplicationRepositoryInterface $loanApplicationRepository;
    protected MemberRepositoryInterface $memberRepository;

    public function __construct(LoanApplicationRepositoryInterface $loanApplicationRepository, MemberRepositoryInterface $memberRepository)
    {
        $this->loanApplicationRepository = $loanApplicationRepository;
        $this->memberRepository = $memberRepository;
    }

    public function allLoanApplication(Request $request)
    {
        $applications = $this->loanApplicationRepository->allApplications($request);

        if ($request->has('member_id')) {
            $member = $this->memberRepository->find($request->input('member_id'));
        }

        $filterData = [
            'from_date' => $request->input('from_date', null),
            'to_date' => $request->input('to_date', null),
            'member' => $member ?? null,
        ];

        $data =[
            'applications'=> $applications,
        ];

        return PDF::loadview('pdf.loan-application', compact('data', 'filterData'), [], [
            'format' => 'A4-L'
        ])->stream(time().'-loan-applications-report.pdf');
    }
}
