<?php

namespace App\Http\Controllers;

use App\Repositories\DpsApplication\DpsApplicationRepositoryInterface;
use App\Repositories\Member\MemberRepositoryInterface;
use App\Repositories\Report\ReportRepositoryInterface;
use Illuminate\Http\Request;
use PDF;

class DpsReportController extends Controller
{
    protected DpsApplicationRepositoryInterface $dpsApplicationRepository;
    protected ReportRepositoryInterface $reportRepository;
    protected MemberRepositoryInterface $memberRepository;

    public function __construct(
        DpsApplicationRepositoryInterface $dpsApplicationRepository,
        MemberRepositoryInterface $memberRepository,
        ReportRepositoryInterface $reportRepository
    )
    {
        $this->dpsApplicationRepository = $dpsApplicationRepository;
        $this->reportRepository = $reportRepository;
        $this->memberRepository = $memberRepository;
    }

    public function allDpsApplication(Request $request)
    {
        $applications = $this->dpsApplicationRepository->allApplications($request);

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

        return PDF::loadview('pdf.dps-application', compact('data', 'filterData'), [], [
            'format' => 'A4-L'
        ])->stream(time().'-dps-applications-report.pdf');
    }

    public function allDpsTransactions(Request $request)
    {
        $transactions = $this->reportRepository->allDpsDownload($request);

        $data =[
            'transactions'=> $transactions ?? null,
        ];

        $filterData = $this->getFormattedFilterData($request);

        return PDF::loadview('pdf.dps-transaction', compact('data', 'filterData'), [], [
            'format' => 'A4-L'
        ])->stream('dps-paid-transactions-report.pdf');
    }

    public function getFormattedFilterData($request)
    {
        if ($request->has('member_id')) {
            $member = $this->memberRepository->find($request->input('member_id'));
        }

        return [
            'from_date' => $request->input('from_date', null),
            'to_date' => $request->input('to_date', null),
            'member' => $member ?? null,
        ];
    }
}
