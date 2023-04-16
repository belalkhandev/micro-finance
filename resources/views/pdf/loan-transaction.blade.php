<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Loan paid transaction report</title>
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
                <h3 style="margin-top: 15px">Loan transactions reports</h3>
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
                    <th style="width: 100px">Tr. no</th>
                    <th>Member/Acc. no</th>
                    <th>Installment</th>
                    <th>Beginning  Bal.</th>
                    <th>Ending  Bal.</th>
                    <th>Transaction Date</th>
                    <th>Paid at</th>
                </tr>
                @if($data['transactions'])
                @foreach($data['transactions'] as $key =>$transaction)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $transaction->transaction_no }}</td>
                        <td>
                        <span class="bn-font">{{ $transaction->member->name }}</span> <br>
                        {{ 'AC No: '. $transaction->member->account_no }}
                        </td>
                        <td>{{ number_format(round($transaction->amount), 2) }} / <small>{{ ucfirst($transaction->application->dps_type) }}</small></td>
                        <td>{{ number_format(round($transaction->beginning_balance), 2) }}</td>
                        <td>{{ number_format(round($transaction->ending_balance), 2) }}</td>
                        <td>{{ userFormattedDate($transaction->transaction_date) }}</td>
                        <td>{{ userFormattedDate($transaction->paid_at) }}</td>
                    </tr>
                @endforeach
                    <tr>
                        <th colspan="3" class="text-left">Total</th>
                        <th class="text-left">{{ number_format(round($data['transactions']->sum('amount')), 2) }}</th>
                        <th colspan="4"></th>
                    </tr>
                @endif
            </table>
        </div>
    </div>
</div>
</body>
</html>


