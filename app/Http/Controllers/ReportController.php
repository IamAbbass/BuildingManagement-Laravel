<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Maintenance;
use \App\Models\Expense;
use Carbon\CarbonPeriod;

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
        $from   = strtoupper(date('d-M-Y',strtotime(request('from'))));
        $to     = strtoupper(date('d-M-Y',strtotime(request('to'))));

        $dates = CarbonPeriod::create($from,$to);
        $queryDates = array();

        foreach($dates as $date){
            $queryDates[] = strtoupper(date('d-M-Y',strtotime($date)));
        }

        $payments = Maintenance::whereIn('date',$queryDates)->where('is_cancelled',false)->get();
        $expense  = Expense::whereIn('date',$queryDates)->sum('amount');

        return view('report.daily_print',[
            'from'     => $from,
            'to'       => $to,
            'payments' => $payments,
            'expense'  => $expense,
        ]);
    }


}
