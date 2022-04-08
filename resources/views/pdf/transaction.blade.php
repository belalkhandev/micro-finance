<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
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
                <h3 style="margin-top: 15px">Report</h3>
            </div>
        </div>
    </header>

    <h2 class="text-center title-line">{{ $data['title'] }}</h2>
    <div class="invoice-body">
        <div>
            <table class="table">
                <tr>
                    <th>#</th>
                    <th>Tr. no</th>
                    <th>Member/Acc. no</th>
                    <th>DPS Type/Amount</th>
                    <th>Balance.</th>
                    <th>Tr. Day</th>
                    <th>Due Date</th>
                    <th>Issue Date</th>
                    <th>Status</th>
                </tr>
                @if($data['transactions'])
                @foreach($data['transactions'] as $key =>$transaction)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $transaction->transaction_no }}</td>
                            <td>
                                    {{ $transaction->member_name }} <br>
                                    {{ $transaction->member_account_no }}
                            </td>
                            <td>{{ $transaction->application->dps_type }} <br> {{ $transaction->amount }}</td>
                            <td>{{$transaction->balance }}</td>
                            <td>{{ userFormattedDate($transaction->transaction_date) }}</td>
                            <td>{{ userFormattedDate($transaction->due_date) }}</td>
                            <td>{{ userFormattedDate($transaction->created_at) }}</td>
                            <td>
                                @if($transaction->is_paid == true)
                                Paid
                                @else
                                Due
                                @endif
                            </td>

                    </tr>
                @endforeach
                @endif
            </table>
        </div>
    </div>
</div>
</body>
</html>


