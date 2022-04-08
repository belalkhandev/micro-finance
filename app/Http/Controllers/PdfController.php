<?php

namespace App\Http\Controllers;
use App\Models\Member;
use App\Repositories\Report\ReportRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class PdfController extends Controller
{
    protected $report;

    public function __construct(ReportRepositoryInterface $report)
    {
        $this->report = $report;
    }

    public function memberProfile($id)
    {
        $member = Member::find($id);

        $data = [
            'member' => $member
        ];

        return Pdf::loadview('pdf.member-profile', $data, [], [
            'format' => 'A4-P'
        ])->stream('member-'.$member->account_no.'.pdf');

    }

    public function allDps()
    {
        $applications = $this->report->allDps();
        $data =[
            'transactions'=> $applications,
            'title'=>"All Dps Report"
        ];
        return Pdf::loadview('pdf.transaction', compact('data'), [], [
            'format' => 'A4-L'
        ])->stream('dps.pdf');
    }

    public function allLoan()
    {
        $applications = $this->report->allLoan();
        $data =[
            'transactions'=> $applications,
            'title'=>"All Loan Report"
        ];

        return Pdf::loadview('pdf.transaction', compact('data'), [], [
            'format' => 'A4-L'
        ])->stream('allLoan.pdf');
    }

    public function allCurrentDps()
    {
        $applications = $this->report->allCurrentDps();
        $data =[
            'transactions'=> $applications,
            'title'=>"Current Dps Report"
        ];

        return Pdf::loadview('pdf.transaction', compact('data'), [], [
            'format' => 'A4-L'
        ])->stream('allCurrentDps.pdf');
    }

    public function allPaidDps()
    {
        $applications = $this->report->allPaidDps();
        $data =[
            'transactions'=> $applications,
            'title'=>"Paid Dps Report"
        ];

        return Pdf::loadview('pdf.transaction', compact('data'), [], [
            'format' => 'A4-L'
        ])->stream('allPaidDps.pdf');
    }

    public function allDueDps()
    {
        $applications = $this->report->allDueDps();
        $data =[
            'transactions'=> $applications,
            'title'=>"Due Dps Report"
        ];

        return Pdf::loadview('pdf.transaction', compact('data'), [], [
            'format' => 'A4-l'
        ])->stream('allDueDps.pdf');
    }

    public function allCurrentLoan()
    {
        $applications = $this->report->allCurrentLoan();
        $data =[
            'transactions'=> $applications,
            'title'=>"Current Loan Report"
        ];

        return Pdf::loadview('pdf.transaction', compact('data'),[], [
            'format' => 'A4-l'
        ])->stream('allCurrentLoan.pdf');
    }

    public function allPaidLoan()
    {
        $applications = $this->report->allPaidLoan();
        $data =[
            'transactions'=> $applications,
            'title'=>"Paid Loan Report"
        ];

        return Pdf::loadview('pdf.transaction', compact('data'),[], [
            'format' => 'A4-l'
        ])->stream('allPaidLoan.pdf');
    }

    public function allDueLoan()
    {
        $applications = $this->report->allDueLoan();
        $data =[
            'transactions'=> $applications,
            'title'=>"Due Loan Report"
        ];

        return Pdf::loadview('pdf.transaction', compact('data'),[], [
            'format' => 'A4-l'
        ])->stream('allDueLoan.pdf');
    }
}
