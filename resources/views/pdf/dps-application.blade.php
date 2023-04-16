<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DPS Application Report</title>
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
                <h3 class="bn-font" style="margin-top: 15px">DPS Application Reports</h3>
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
                    <th class="text-center">Dps Amount</th>
                    <th style="width: 150px">DPS Total Amount</th>
                    <th style="width: 150px">Receivable</th>
                    <th style="width: 150px">Profitable</th>
                    <th>Balance.</th>
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
                            <td>
                                {{ $application->dps_amount }}
                                <small>({{ ucfirst($application->dps_type) }})</small> <br>
                                {{ $application->year }} years
                            </td>
                            <td class="text-right">{{ number_format($application->total_amount, 2) }}</td>
                            <td class="text-right">{{ number_format($application->receiving, 2) }}</td>
                            <td class="text-right">{{ number_format($application->profit, 2) }}</td>
                            <td class="text-right">{{ number_format(round($application->balance), 2) }}</td>
                            <td>{{ $application->status }}</td>
                            <td>{{ userFormattedDate($application->created_at) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="3" class="text-left">Total</th>
                        <th class="text-right">{{ number_format(round($data['applications']->sum('total_amount')), 2) }}</th>
                        <th class="text-right">{{ number_format(round($data['applications']->sum('receiving')), 2) }}</th>
                        <th class="text-right">{{ number_format(round($data['applications']->sum('profit')), 2) }}</th>
                        <th class="text-right">{{ number_format(round($data['applications']->sum('balance')), 2) }}</th>
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


