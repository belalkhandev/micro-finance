<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Savings transaction reports</title>
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
                <h3>Savings transactions report</h3>
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
                    <th>Member</th>
                    <th>Tr. Date</th>
                    <th>Deposit Amount</th>
                    <th>WithDraw Amount</th>
                    <th>Beginning Balance</th>
                    <th>Ending Balance</th>
                </tr>
                @if($data['transactions'])
                    @php $balance = 0; @endphp
                    @foreach($data['transactions'] as $key =>$transaction)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>
                                <span class="bn-font">{{ $transaction->member->name }}</span> <br>
                                {{ 'AC No: '. $transaction->member->account_no }}
                            </td>
                            <td>{{ userFormattedDate($transaction->savings_date) }}</td>
                            <td class="text-right">
                                @if($transaction->savings_type === 'deposit')
                                    {{ number_format(round($transaction->amount), 2) }}
                                @else
                                    {{ number_format(0, 2) }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if($transaction->savings_type === 'withdraw')
                                    {{ number_format(round($transaction->amount), 2) }}
                                @else
                                    {{ number_format(0, 2) }}
                                @endif
                            </td>
                            <td class="text-right">{{ number_format($transaction->beginning_balance, 2) }}</td>
                            <td class="text-right">{{ number_format($transaction->ending_balance, 2) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="3" class="text-left">Total</th>
                        <th class="text-right">{{ number_format($data['transactions']->where('savings_type', 'deposit')->sum('amount'), 2) }}</th>
                        <th class="text-right">{{ number_format($data['transactions']->where('savings_type', 'withdraw')->sum('amount'), 2) }}</th>
                        <th></th>
                        <th></th>
                    </tr>
                @endif
            </table>
        </div>
    </div>
</div>
</body>
</html>


