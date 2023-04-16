<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Expenses report</title>
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
                <h3>Expense report</h3>
            </div>
        </div>
    </header>

    <ul class="member-list">
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
                    <th>Expense date</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Amount</th>
                </tr>
                @if($data['expenses'])
                    @foreach($data['expenses'] as $key => $expense)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ userFormattedDate($expense->expense_date) }}</td>
                            <td>{{ $expense->title }}</td>
                            <td>{{ $expense->category->name }}</td>
                            <td>{{ ucfirst($expense->expense_type) }}</td>
                            <td class="text-right">{{ number_format($expense->amount, 2) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th colspan="5" class="text-left">Total</th>
                        <th class="text-right">{{ number_format($data['expenses']->sum('amount'), 2) }}</th>
                    </tr>
                @endif
            </table>
        </div>
    </div>
</div>
</body>
</html>


