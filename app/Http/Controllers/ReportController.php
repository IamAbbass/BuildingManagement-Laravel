<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Maintenance;
use \App\Models\Expense;

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
        $expense = Expense::where('date',$date)->sum('amount');

        return view('report.daily_print',[
            'date' => $date,
            'payments' => $payments,
            'expense'  => $expense,
        ]);
    }

    
}
