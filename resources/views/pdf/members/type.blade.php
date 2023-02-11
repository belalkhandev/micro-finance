<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data['title'] }}</title>
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
                <h3 class="bn-font" style="margin-top: 15px">{{ $data['title'] }}</h3>
            </div>
        </div>
    </header>
    <div class="invoice-body">
        <div>
            <table class="table">
                <tr>
                    <th>A/N</th>
                    <th>Name</th>
                    <th>F/S Name</th>
                    <th>Mother Name</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Group</th>
                    <th>Member Type</th>
                    <th>Status</th>
                </tr>
                @if($data['members'])
                    @foreach($data['members'] as $key =>$member)
                        <tr>
                            <td>{{ $member->account_no }}</td>
                            <td class="bn-font">{{ $member->name }}</td>
                            <td class="bn-font">{{ $member->father_name }}</td>
                            <td class="bn-font">{{ $member->mother_name }}</td>
                            @if($member->village)
                                <td class="bn-font" style="width: 120px">{{ $member->village->name.', '  .$member->village->union->name }}</td>
                            @else
                                <td>--</td>
                            @endif
                            <td class="bn-font">{{ $member->phone }}</td>
                            <td class="bn-font">{{ $member->group ? $member->group->group_name : '-' }}</td>
                            <td>{{ $member->member_type }}</td>
                            <td>{{ $member->is_active ? 'Active' : 'Inactive' }}</td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
</div>
</body>
</html>


