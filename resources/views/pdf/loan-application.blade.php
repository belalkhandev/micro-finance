<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Loan Application Report</title>
    @include('pdf.style')
</head>
<body>
<htmlpagefooter name="page-footer">
    Date: {{ userFormattedDatetime(\Carbon\Carbon::now()) }}
</htmlpagefooter>
<div class="invoice-wrapper landscape">
    <header>
        <div class="header-common">
            <div class="header-img">
                <img src="{{ base_path('public/images/logo.png') }}" alt="">
            </div>
            <div class="header-content">
                <h2>Poor Development Savings & Credit Donation Co-Operative Society Ltd.</h2>
                <h3 class="bn-font" style="margin-top: 15px">Loan Applications Reports</h3>
            </div>
        </div>
    </header>

    <ul class="member-list">
        @if($filterData['member'])
            <li><strong>Member:</strong> {{ $filterData['member']->name }},<strong> Account:</strong> {{ $filterData['member']->account_no  }}</li>
        @endif
        @if($filterData['from_date'])
            <li class="text-right"><strong>From Date:</strong> {{ \Carbon\Carbon::parse($filterData['from_date'])->format('d M, Y') }}</li>
        @endif
        @if($filterData['to_date'])
            <li class="text-right"><strong>To Date:</strong> {{ \Carbon\Carbon::parse($filterData['to_date'])->format('d M, Y') }}</li>
        @endif
    </ul>

    <div class="invoice-body">
        <div>
            <table class="table">
                <tr>
                    <th>#</th>
                    <th>Member/Acc. no</th>
                    <th class="text-center">Loan amount</th>
                    <th style="width: 150px">Service</th>
                    <th style="width: 150px">Installment</th>
                    <th>Loan (+service)</th>
                    <th>Paid</th>
                    <th>Balance</th>
                    <th>Status</th>
                    <th>Created at</th>
                </tr>
                @if($data['applications'] && $data['applications']->isNotEmpty())
                    @foreach($data['applications'] as $key => $application)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                                <span class="bn-font">{{ $application->member->name }}</span> <br>
                                {{ 'AC No: '. $application->member->account_no }}
                            </td>
                            <td class="text-right">
                                {{ number_format($application->loan_amount, 2) }}<br>
                                <small>({{ ucfirst($application->dps_type) }})</small>
                            </td>
                            <td class="text-right">
                                {{ number_format($application->service_amount, 2) }}<br>
                                <small> {{ ucfirst($application->service) }}% of {{ $application->loan_amount }}</small>
                            </td>
                            <td class="text-right">
                                {{ number_format($application->installment_amount, 2) }}<br>
                                <small>{{ ucfirst($application->installment) }} installments</small>
                            </td>
                            <td class="text-right">{{ number_format($application->total_amount, 2) }}</td>
                            <td class="text-right">{{ number_format($application->total_amount - $application->balance, 2) }}</td>
                            <td class="text-right">{{ number_format($application->balance, 2) }}</td>
                            <td>{{ $application->status }}</td>
                            <td>{{ userFormattedDate($application->created_at) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="2" class="text-left">Total</th>
                        <th class="text-right">{{ number_format($data['applications']->sum('loan_amount'), 2) }}</th>
                        <th class="text-right">{{ number_format($data['applications']->sum('service_amount'), 2) }}</th>
                        <th></th>
                        <th class="text-right">{{ number_format($data['applications']->sum('total_amount'), 2) }}</th>
                        <th class="text-right">{{ number_format($data['applications']->sum('total_amount') - $data['applications']->sum('balance'), 2) }}</th>
                        <th class="text-right">{{ number_format($data['applications']->sum('balance'), 2) }}</th>
                        <th colspan="2"></th>
                    </tr>
                @else
                    <tr>
                        <td colspan="9">No data found!</td>
                    </tr>
                @endif
            </table>
        </div>
    </div>
</div>
</body>
</html>


