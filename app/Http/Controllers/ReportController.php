<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Maintenance;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function daily_report()
    {    
        return view('report.daily');
    }

    public function daily_report_print()
    {
        $date   = strtoupper(date('d-M-Y',strtotime(request('date'))));
        // $to     = request('to');        
        $payments = Maintenance::where('date',$date)->get();        

        return view('report.daily_print',[
            'payments' => $payments,
            'date' => $date,
        ]);
    }

    
}
