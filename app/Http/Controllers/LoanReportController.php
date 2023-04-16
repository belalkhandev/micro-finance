<?php

namespace App\Http\Controllers;

use App\Repositories\LoanApplication\LoanApplicationRepositoryInterface;
use App\Repositories\Member\MemberRepositoryInterface;
use App\Repositories\Report\ReportRepositoryInterface;
use Illuminate\Http\Request;
use PDF;

class LoanReportController extends Controller
{
    protected LoanApplicationRepositoryInterface $loanApplicationRepository;
    protected ReportRepositoryInterface $reportRepository;
    protected MemberRepositoryInterface $memberRepository;

    public function __construct(
        LoanApplicationRepositoryInterface $loanApplicationRepository,
        MemberRepositoryInterface $memberRepository,
        ReportRepositoryInterface $reportRepository
    )
    {
        $this->loanApplicationRepository = $loanApplicationRepository;
        $this->memberRepository = $memberRepository;
        $this->reportRepository = $reportRepository;
    }

    public function allLoanApplication(Request $request)
    {
        $applications = $this->loanApplicationRepository->allApplications($request);

        if ($request->member_id) {
            $member = $this->memberRepository->find($request->input('member_id'));
        }

        $filterData = $this->getFormattedFilterData($request);

        $data =[
            'applications'=> $applications,
        ];

        return PDF::loadview('pdf.loan-application', compact('data', 'filterData'), [], [
            'format' => 'A4-L'
        ])->stream(time().'-loan-applications-report.pdf');
    }

    public function allLoanTransactions(Request $request)
    {
        $transactions = $this->reportRepository->allLoanTransactionsReport($request);

        $data =[
            'transactions'=> $transactions['transactions'] ?? null,
        ];

        $filterData = $this->getFormattedFilterData($request);

        return PDF::loadview('pdf.loan-transaction', compact('data', 'filterData'), [], [
            'format' => 'A4-L'
        ])->stream('loan-transactions-report.pdf');
    }

    public function loanApplicationDownloadTransactions($applicationId)
    {
        $transactions = $this->reportRepository->downlaodLoanTransactionByApplicationId($applicationId);

        $data =[
            'transactions'=> $transactions ?? null,
        ];

        $application = $this->loanApplicationRepository->find($applicationId);

        return PDF::loadview('pdf.loan-application-transaction', compact('data', 'application'), [], [
            'format' => 'A4-L'
        ])
            ->stream('loan-application-transactions-report.pdf');
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
