<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class PdfController extends Controller
{
    public function memberProfile()
    {
        return Pdf::loadview('pdf.test')->stream('test.pdf');

    }
}
