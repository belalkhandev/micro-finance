<?php

namespace App\Http\Controllers;
use App\Models\Member;
use App\Models\MemberGroup;
use App\Repositories\Report\ReportRepositoryInterface;
use Illuminate\Http\Request;
use PDF;

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

        return PDF::loadview('pdf.member-profile', $data, [], [
            'format' => 'A4-P'
        ])->stream('member-'.$member->account_no.'.pdf');

    }

    public function allDps(Request $request)
    {
        $applications = $this->report->allDpsDownload($request);

        $data =[
            'transactions'=> $applications,
            'title'=> "DPS transaction report (all member)",
            'sub_title' => "Transactions report"
        ];

        return PDF::loadview('pdf.dps-transaction', compact('data'), [], [
            'format' => 'A4-L'
        ])->stream('dps.pdf');
    }

    public function memberDpsTransactions(Request $request, $member_id)
    {
        $applications = $this->report->memberDps($request, $member_id);
        $member = Member::find($member_id);

        $data =[
            'transactions'=> $applications,
            'title'=> "DPS transactions report ($member->name)",
            'sub_title' => "Transactions report"
        ];

        return PDF::loadview('pdf.dps-transaction', compact('data'), [], [
            'format' => 'A4-L'
        ])->stream('dps-transactions-'.$member->account_no.'.pdf');
    }

    public function memberLoanTransactions(Request $request, $member_id)
    {
        $applications = $this->report->memberLoan($request, $member_id);
        $member = Member::find($member_id);

        $data =[
            'transactions'=> $applications,
            'title'=> "Loan transactions report ($member->name)",
            'sub_title' => "Transactions report"
        ];
        return PDF::loadview('pdf.dps-transaction', compact('data'), [], [
            'format' => 'A4-L'
        ])->stream('loan-transactions-'.$member->account_no.'.pdf');
    }

    public function allLoan(Request $request)
    {
        $applications = $this->report->allLoanDownload($request);

        $data =[
            'transactions'=> $applications['transactions'],
            'total_beginning_balance'=> $applications['total_beginning_balance'],
            'total_ending_balance'=> $applications['total_ending_balance'],
            'title'=> "Loan transaction report (all member)",
            'sub_title' => "Transactions report"
        ];

        return PDF::loadview('pdf.loan-transaction', compact('data'), [], [
            'format' => 'A4-L'
        ])->stream('allLoan.pdf');
    }

    public function allCurrentDps()
    {
        $applications = $this->report->allCurrentDps();
        $data =[
            'transactions'=> $applications,
            'title'=>"Current Dps Report",
            'sub_title'=>"Transactions Report"
        ];

        return PDF::loadview('pdf.transaction', compact('data'), [], [
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

        return PDF::loadview('pdf.transaction', compact('data'), [], [
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

        return PDF::loadview('pdf.transaction', compact('data'), [], [
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

        return PDF::loadview('pdf.transaction', compact('data'),[], [
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

        return PDF::loadview('pdf.transaction', compact('data'),[], [
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

        return PDF::loadview('pdf.transaction', compact('data'),[], [
            'format' => 'A4-l'
        ])->stream('allDueLoan.pdf');
    }


    public function savingAccountTransactions(Request $request, $member_id)
    {
        $transactions = $this->report->savingsAccountTransactions($request, $member_id);
        $member = Member::find($member_id);

        $data =[
            'transactions'=> $transactions,
            'member' => $member,
            'title'=> "Savings Accounts Transactions ($member->name)",
            'sub_title' => "Transactions report"
        ];
        return PDF::loadview('pdf.savings-transaction', compact('data'), [], [
            'format' => 'A4-L'
        ])->stream('savings-transactions-'.$member->account_no.'.pdf');
    }

    public function allMemberList()
    {
        $members = Member::with('group:id,group_name')->orderBy('account_no')->get();

        $data = [
            'members' => $members,
            'title' => 'All Members List ('.$members->count().')'
        ];

        return PDF::loadview('pdf.members.all', compact('data'), [], [
            'format' => 'A4-L'
        ])->stream(databaseFormattedDate(now()).'-all-members-list.pdf');
    }

    public function membersGroup($groupId)
    {
        $members = Member::where('member_group_id', $groupId)->orderBy('account_no')->get();
        $group = MemberGroup::findOrFail($groupId);
        $data = [
            'members' => $members,
            'title' => $group->group_name.' ('.$members->count().')'
        ];

        return PDF::loadview('pdf.members.group', compact('data'), [], [
            'format' => 'A4-L'
        ])->stream(databaseFormattedDate(now()).'-'.$group->group_name.'-members-list.pdf');
    }

    public function membersType($type)
    {
        $members = Member::where('member_type', 'LIKE', $type.'%')->orderBy('account_no')->get();

        $data = [
            'members' => $members,
            'title' => ucfirst($type).' member list ('.$members->count().')'
        ];

        return PDF::loadview('pdf.members.type', compact('data'), [], [
            'format' => 'A4-L'
        ])->stream(databaseFormattedDate(now()).'-'.$type.'-members-list.pdf');
    }

}
