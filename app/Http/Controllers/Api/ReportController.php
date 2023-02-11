<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Report\ReportRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportController extends Controller
{
    protected $report;

    public function __construct(ReportRepositoryInterface $report)
    {
        $this->report = $report;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function allDpsReport(Request $request)
    {
        $applications = $this->report->allDps($request);

        if ($applications) {
            return response()->json([
                'status' => true,
                'applications' => $applications,
                'message' => 'Dps applications found'
            ]);
        }

        return response()->json([
            'status' => false,
            'applications' => null,
            'message' => 'No data found'
        ]);
    }


    public function allLoanReport(Request $request)
    {
        $applications = $this->report->allLoan($request);

        if ($applications) {
            return response()->json([
                'status' => true,
                'applications' => $applications,
                'message' => 'Loan applications found'
            ]);
        }

        return response()->json([
            'status' => false,
            'applications' => null,
            'message' => 'No data found'
        ]);
    }

    public function allCurrentDpsReport()
    {
        $applications = $this->report->allCurrentDps();

        if ($applications) {
            return response()->json([
                'status' => true,
                'applications' => $applications,
                'message' => 'Dps applications found'
            ]);
        }

        return response()->json([
            'status' => false,
            'applications' => null,
            'message' => 'No data found'
        ]);
    }

    public function allPaidDpsReport()
    {
        $applications = $this->report->allPaidDps();

        if ($applications) {
            return response()->json([
                'status' => true,
                'applications' => $applications,
                'message' => 'Dps applications found'
            ]);
        }

        return response()->json([
            'status' => false,
            'applications' => null,
            'message' => 'No data found'
        ]);
    }

    public function allDueDpsReport()
    {
        $applications = $this->report->allDueDps();

        if ($applications) {
            return response()->json([
                'status' => true,
                'applications' => $applications,
                'message' => 'Dps applications found'
            ]);
        }

        return response()->json([
            'status' => false,
            'applications' => null,
            'message' => 'No data found'
        ]);
    }


    public function allCurrentLoanReport()
    {
        $applications = $this->report->allCurrentLoan();

        if ($applications) {
            return response()->json([
                'status' => true,
                'applications' => $applications,
                'message' => 'Loan applications found'
            ]);
        }

        return response()->json([
            'status' => false,
            'applications' => null,
            'message' => 'No data found'
        ]);
    }

    public function allPaidLoanReport()
    {
        $applications = $this->report->allPaidLoan();

        if ($applications) {
            return response()->json([
                'status' => true,
                'applications' => $applications,
                'message' => 'Loan applications found'
            ]);
        }

        return response()->json([
            'status' => false,
            'applications' => null,
            'message' => 'No data found'
        ]);
    }

    public function allDueLoanReport()
    {
        $applications = $this->report->allDueLoan();

        if ($applications) {
            return response()->json([
                'status' => true,
                'applications' => $applications,
                'message' => 'Loan applications found'
            ]);
        }

        return response()->json([
            'status' => false,
            'applications' => null,
            'message' => 'No data found'
        ]);
    }

}
