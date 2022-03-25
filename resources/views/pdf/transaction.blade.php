<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box
        }
    
        body {
            font-size: 14px;
            padding: 25px 35px;
            margin: 35px 35px;
            line-height: 15px;
            font-family: 'kalpurush', Arial, Helvetica, sans-serif;
        }
    
        h1 , h2, h3, p {
            margin: 0;
            padding: 0;
        }
    
        .invoice-header {
            line-height: 25px;
            padding-bottom: 25px;
            margin: 0px 50px 0px 50px;
        }
    
        .invoice-header .invoice-header-logo {
            float: left;
            width: 80px;
            text-align: right;
        }
    
        .invoice-header .invoice-header-logo img {
    
        }
    
        .invoice-header-content {
            float: left;
            width: calc(100% - 100px);
            text-align: center;
        }
    
        .title-line{
            border-top: 3px double gray;
            padding-top: 10px;
            padding-bottom: 10px;
        }
    
        .invoice-header-content h1 {
            font-weight: 500;
            margin-bottom: 5px;
        }
    
        .invoice-header-content p {
            margin-bottom: 5px;
        }
    
        .invoice-body {
            border: 1px solid gray;
        }
    
        .text-center {
            text-align: center
        }
    
        .text-right {
            text-align: right
        }
    
        .text-left {
            text-align: left
        }
    
        .table {
            width: 100%;
            font-size: 14px;
            border-collapse: collapse
        }
    
        .table th, .table td {
            padding: 5px 5px;
            font-weight: 400;
    
        }
    
        .table th {
            text-align: left;
            font-weight: 500;
        }
        /*.bill-provisional{*/
        /*    border-bottom: 1px solid gray;*/
        /*}*/
    
        .bill-provisional   h2 {
            font-weight: 600;
            font-size: 28px;
            text-decoration: underline;
    
    
        }
    
        .bill-head {
            margin-top: 15px;
            border-top: 1px dashed gray;
            border-bottom: 1px dashed gray;
        }
    
        .bill-head-title {
            width: 38%;
        }
    
        .bill-items {
            margin-bottom: 15px;
        }
    
    
        .bill-items h3 {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 5px;
            padding: 5px 5px;
        }
    
        .bill-items .table tr td {
            border: 1px solid gray;
        }
    
        .bill-items .table tr td:first-child {
            border-left: none;
        }
    
        .bill-items .table tr td:last-child {
            border-right: none;
        }
    
        .bill-items .table tr:last-child td {
            border: none;
        }
    
        .invoice-footer {
            margin-top: 10px;
        }
    
        .invoice-footer .footer-left {
            width: 50%;
            float: left;
        }
    
        .invoice-footer .footer-right {
            float: left;
            width: 50%;
        }
    
        .invoice-footer .footer-left .signature p {
            padding: 10px 25px;
            margin-right: 40%;
            margin-left: 20px;
            border-top: 1px solid gray;
        }
    
        .invoice-footer .footer-right .signature p {
            padding: 10px 15px;
            margin-left: 52%;
            border-top: 1px solid gray;
        }
    
        .signature{
            margin-top: 60px;
        }
    
        .admission-title{
            margin-top: 20px;
        }
    
        .due {
            margin: 25px 0px 30px;
        }
    
        .due h1{
            color: #333333;
            font-weight: 500;
        }
    
        .due h1 span{
            font-size: 36px;
            color: #000000;
        }
    
        .diagnosis{
            margin-top: 5px;
            padding: 5px;
            border: 1px solid gray;
            font-size: 15px;
        }
    </style>
    
</head>
<body>
<div class="invoice-wrapper">
    <div class="invoice-header">
        <div class="invoice-header-logo">
            <img src="{{ base_path('public/images/logo.png') }}" alt="">
        </div>
        <div class="invoice-header-content">
            <h1>pdscdcsl</h1>
            {{-- <p>22/14-B, Khilji Road, Shaymoli, Mohammadpur, Dhaka-1207</p>
            <p>MOB: 01949400800, 01910949596</p> --}}
        </div>
    </div>

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


