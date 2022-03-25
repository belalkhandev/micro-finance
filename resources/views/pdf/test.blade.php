<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
    <style>
        h1, h2, h3, h4, h5, h6, p {
            margin: 0px;
            padding: 0px;
        }
        body {
            font-family: 'Roboto', sans-serif ;
            font-size: 14px;
        }

        .bn-font {
            font-family: 'kalpurush', sans-serif ;
        }

        .invoice-wrapper {
            width: 825px;
        }

        header, .invoice-to {
            overflow: hidden;
            border-bottom: 1px solid #f3f3f3;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }

        .invoice-to {
            border-bottom: 0px solid #f3f3f3;
        }

        .header-logo, .invoice-to-left {
            float: left;
            width: 50%;
        }

        .header-info, .invoice-to-right {
            float: right;
            width: 50%;
            text-align: right;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table thead tr th{
            background-color: #f3f3f3;
        }

        .table tr td, .table tr th {
            border: 1px solid #f3f3f3;
            padding: 5px;
        }

        .text-right {
            text-align: right;
        }

        main {
            margin-bottom: 50px;
        }

    </style>
</head>
<body>
<div class="invoice-wrapper">
    <header>
        <img src="{{ base_path('public/images/logo.png') }}" alt="">
        <div class="bn-font">
            যে কথাকে কাজে লাগাতে চাও, তাকে কাজে লাগানোর কথা চিন্তা করার আগে ভাবো, তুমি কি সেই কথার জাদুতে আচ্ছন্ন হয়ে গেছ কিনা। তুমি যদি নিশ্চিত হও যে, তুমি কোনো মোহাচ্ছাদিত আবহে আবিষ্ট হয়ে অন্যের শেখানো বুলি আত্মস্থ করছো না, তাহলে তুমি নির্ভয়ে, নিশ্চিন্তে অগ্রসর হও। তুমি সেই কথাকে জানো, বুঝো, আত্মস্থ করো; মনে রাখবে, যা অনুসরণ করতে চলেছো, তা আগে অনুধাবন করা জরুরি; এখানে কিংকর্তব্যবিমূঢ় হবার কোনো সুযোগ নেই।
        </div>
    </header>

    <main>
        <p class="bn-font">যে কথাকে কাজে লাগাতে চাও, তাকে কাজে লাগানোর কথা চিন্তা করার আগে ভাবো, তুমি কি সেই কথার জাদুতে আচ্ছন্ন হয়ে গেছ কিনা। তুমি যদি নিশ্চিত হও যে, তুমি কোনো মোহাচ্ছাদিত আবহে আবিষ্ট হয়ে অন্যের শেখানো বুলি আত্মস্থ করছো না, তাহলে তুমি নির্ভয়ে, নিশ্চিন্তে অগ্রসর হও। তুমি সেই কথাকে জানো, বুঝো, আত্মস্থ করো; মনে রাখবে, যা অনুসরণ করতে চলেছো, তা আগে অনুধাবন করা জরুরি; এখানে কিংকর্তব্যবিমূঢ় হবার কোনো সুযোগ নেই।</p>
    </main>

    <footer>
        <p class="bn-font">যে কথাকে কাজে লাগাতে চাও, তাকে কাজে লাগানোর কথা চিন্তা করার আগে ভাবো, তুমি কি সেই কথার জাদুতে আচ্ছন্ন হয়ে গেছ কিনা। তুমি যদি নিশ্চিত হও যে, তুমি কোনো মোহাচ্ছাদিত আবহে আবিষ্ট হয়ে অন্যের শেখানো বুলি আত্মস্থ করছো না, তাহলে তুমি নির্ভয়ে, নিশ্চিন্তে অগ্রসর হও। তুমি সেই কথাকে জানো, বুঝো, আত্মস্থ করো; মনে রাখবে, যা অনুসরণ করতে চলেছো, তা আগে অনুধাবন করা জরুরি; এখানে কিংকর্তব্যবিমূঢ় হবার কোনো সুযোগ নেই।</p>
    </footer>
</div>
</body>
</html>
