<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Savings Account</title>
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
                <h3 style="margin-top: 15px">{{ $data['member']->name }}</h3>
                <h4>Account no: {{ $data['member']->account_no }}</h4>

            </div>
        </div>
    </header>

    <h2 class="text-center title-line">{{ $data['sub_title'] }} (Savings Account): {{ $data['member']->account_no }}</h2>
    <div class="invoice-body">
        <div>
            <table class="table">
                <tr>
                    <th>#</th>
                    <th>Tr. Date</th>
                    <th>Deposit Amount</th>
                    <th>WithDraw Amount</th>
                    <th>Balance</th>
                </tr>
                @if($data['transactions'])
                    @php $balance = 0; @endphp
                    @foreach($data['transactions'] as $key =>$transaction)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ userFormattedDate($transaction->savings_date) }}</td>
                            <td class="text-right">
                                @if($transaction->savings_type === 'deposit')
                                    @php $balance  += $transaction->amount  @endphp
                                    {{ number_format(round($transaction->amount), 2) }}
                                @else
                                    {{ number_format(0, 2) }}
                                @endif
                            </td>
                            <td class="text-right">
                                @if($transaction->savings_type === 'withdraw')
                                    @php $balance  -= $transaction->amount  @endphp
                                    {{ number_format(round($transaction->amount), 2) }}
                                @else
                                    {{ number_format(0, 2) }}
                                @endif
                            </td>
                            <td class="text-right">{{ number_format(round($balance), 2) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="2" class="text-left">Total</th>
                        <th class="text-right">{{ number_format($data['transactions']->where('savings_type', 'deposit')->sum('amount'), 2) }}</th>
                        <th class="text-right">{{ number_format($data['transactions']->where('savings_type', 'withdraw')->sum('amount'), 2) }}</th>
                        <th class="text-right">{{ number_format(round($balance), 2) }}</th>
                    </tr>
                @endif
            </table>
        </div>
    </div>
</div>
</body>
</html>


