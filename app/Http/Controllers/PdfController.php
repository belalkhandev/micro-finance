<?php

namespace App\Http\Controllers;
use App\Repositories\Report\ReportRepositoryInterface;
use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class PdfController extends Controller
{
    protected $report;

    public function __construct(ReportRepositoryInterface $report)
    {
        $this->report = $report;
    }

    public function memberProfile()
    {
        return Pdf::loadview('pdf.test')->stream('test.pdf');

    }

    public function allDps()
    {
        $applications = $this->report->allDps();
        $data =[
            'transactions'=> $applications,
            'title'=>"All Dps Report"
        ];
        return Pdf::loadview('pdf.transaction', compact('data'))->stream('dps.pdf');
    }

    public function allLoan()
    {
        $applications = $this->report->allLoan();
        $data =[
            'transactions'=> $applications,
            'title'=>"All Loan Report"
        ];

        return Pdf::loadview('pdf.transaction', compact('data'))->stream('allLoan.pdf');
    }

    public function allCurrentDps()
    {
        $applications = $this->report->allCurrentDps();
        $data =[
            'transactions'=> $applications,
            'title'=>"Current Dps Report"
        ];

        return Pdf::loadview('pdf.transaction', compact('data'))->stream('allCurrentDps.pdf');
    }

    public function allPaidDps()
    {
        $applications = $this->report->allPaidDps();
        $data =[
            'transactions'=> $applications,
            'title'=>"Paid Dps Report"
        ];

        return Pdf::loadview('pdf.transaction', compact('data'))->stream('allPaidDps.pdf');
    }

    public function allDueDps()
    {
        $applications = $this->report->allDueDps();
        $data =[
            'transactions'=> $applications,
            'title'=>"Due Dps Report"
        ];

        return Pdf::loadview('pdf.transaction', compact('data'))->stream('allDueDps.pdf');
    }

    public function allCurrentLoan()
    {
        $applications = $this->report->allCurrentLoan();
        $data =[
            'transactions'=> $applications,
            'title'=>"Current Loan Report"
        ];

        return Pdf::loadview('pdf.transaction', compact('data'))->stream('allCurrentLoan.pdf');
    }

    public function allPaidLoan()
    {
        $applications = $this->report->allPaidLoan();
        $data =[
            'transactions'=> $applications,
            'title'=>"Paid Loan Report"
        ];

        return Pdf::loadview('pdf.transaction', compact('data'))->stream('allPaidLoan.pdf');
    }

    public function allDueLoan()
    {
        $applications = $this->report->allDueLoan();
        $data =[
            'transactions'=> $applications,
            'title'=>"Due Loan Report"
        ];

        return Pdf::loadview('pdf.transaction', compact('data'))->stream('allDueLoan.pdf');
    }
}
