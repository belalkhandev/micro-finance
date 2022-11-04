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
<div class="invoice-wrapper">
    <header>
        <div class="header-common">
            <div class="header-img">
                <img src="{{ base_path('public/images/logo.png') }}" alt="">
            </div>
            <div class="header-content">
                <h2>Poor Development Savings & Credit Donation Co-Operative Society Ltd.</h2>
                <h3 style="margin-top: 15px">Member Details</h3>
            </div>
        </div>
    </header>

    <main>
        <table class="table no-border">
            <tr>
                <th class="text-left" colspan="3">Personal Information</th>
            </tr>
            <tr>
                <td style="width: 25%">Name</td>
                <td class="bn-font">{{ $member->name }}</td>
                <td style="width: 25%;text-align: center" rowspan="6">
                    <img width="120px" src="{{ $member->main_photo }}" alt="" class="profile-img">
                </td>
            </tr>
            <tr>
                <td style="width: 25%">Phone</td>
                <td>{{ $member->phone }}</td>
            </tr>
            <tr>
                <td style="width: 25%">Father's name</td>
                <td class="bn-font">{{ $member->father_name }}</td>
            </tr>
            <tr>
                <td style="width: 25%">Mother's name</td>
                <td class="bn-font">{{ $member->mother_name }}</td>
            </tr>
            <tr>
                <td style="width: 25%">Gender</td>
                <td>{{ ucfirst($member->gender) }}</td>
            </tr>
            <tr>
                <td style="width: 25%">NID</td>
                <td>{{ $member->nid }}</td>
            </tr>
            <tr>
                <td style="width: 25%">Address</td>
                @if($member->village)
                <td colspan="2">{{ $member->village->name.', '  .$member->village->union->name.', '.$member->village->union->upazilla->name }}</td>
                @else
                    <td>No found</td>
                @endif
            </tr>
        </table>

        <table class="table no-border" style="margin-top: 15px">
            <tr>
                <th class="text-left" colspan="2">Account Information</th>
            </tr>
            <tr>
                <td style="width: 25%">Account No</td>
                <td>{{ $member->account_no }}</td>
            </tr>
            <tr>
                <td style="width: 25%">Joining Date</td>
                <td>{{ userFormattedDate($member->joining_date) }}</td>
            </tr>
            <tr>
                <td style="width: 25%">Member Type</td>
                <td>{{ ucfirst(str_replace('_', ' ', $member->member_type)) }}</td>
            </tr>
            <tr>
                <td style="width: 25%">Group</td>
                @if($member->group)
                    <td class="bn-font">{{ $member->group->group_name }} ({{ $member->group->group_no }})</td>
                @else
                    <td>No Group</td>
                @endif
            </tr>
            <tr>
                <td>Day</td>
                <td>{{ $member->day }}</td>
            </tr>
        </table>

        @if($member->nominee)
        <table class="table no-border" style="margin-top: 15px">
            <tr>
                <th class="text-left" colspan="3">Nominee/Guarantor Information</th>
            </tr>
            <tr>
                <td style="width: 25%">Name</td>
                <td class="bn-font">{{ $member->nominee->name }}</td>
                <td style="width: 25%;text-align: center" rowspan="6">
                    <img width="120px" src="{{ $member->nominee->main_photo }}" alt="" class="profile-img">
                </td>
            </tr>
            <tr>
                <td style="width: 25%">Phone</td>
                <td>{{ $member->nominee->phone }}</td>
            </tr>
            <tr>
                <td style="width: 25%">Father's/Spouse name</td>
                <td class="bn-font">{{ $member->nominee->father_name }}</td>
            </tr>
            <tr>
                <td style="width: 25%">Mother's name</td>
                <td class="bn-font">{{ $member->nominee->mother_name }}</td>
            </tr>
            <tr>
                <td style="width: 25%">Gender</td>
                <td>{{ ucfirst($member->nominee->gender) }}</td>
            </tr>
            <tr>
                <td style="width: 25%">NID</td>
                <td>{{ $member->nominee->nid }}</td>
            </tr>
            <tr>
                <td style="width: 25%">Address</td>
                <td colspan="2" class="bn-font">{{ $member->nominee->address }}</td>
            </tr>
        </table>
        @endif

        <table class="table no-border" style="margin-top: 15px">
            <tr>
                <th class="text-left" colspan="3">Manage By User</th>
            </tr>
            <tr>
                <td style="width: 25%">Created By</td>
                <td>{{ $member->created_by }}, {{ userFormattedDate($member->created_at) }}</td>
            </tr>

            @if($member->updated_by)
                <tr>
                    <td style="width: 25%">Updated By</td>
                    <td>{{ $member->updated_by }}, {{ userFormattedDate($member->updated_at) }}</td>
                </tr>
            @endif
        </table>
    </main>

    <footer>

    </footer>
</div>
</body>
</html>
