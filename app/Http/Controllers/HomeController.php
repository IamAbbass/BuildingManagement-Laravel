<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Expense;
use App\Models\Maintenance;
use App\Models\AccountHead;
use App\Models\Flat;
use App\Models\ExpenseHead;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        return view('home');
    }

    public function dashboard()
    {
        $defaulters     = Maintenance::where('payment', 0)->count();
        $due            = Maintenance::sum('amount');
        $income         = Maintenance::sum('payment');
        $balance        = $due - $income;

        $total_expense  = Expense::sum('amount');
        
        // Head Wise Income & Expenses
        $account_heads = AccountHead::all();
        $expense_heads = ExpenseHead::all();


        return view('dashboard',[
            'defaulters'    => $defaulters,
            'income'        => $income,
            'total_expense' => $total_expense,
            'balance'       => $balance,

            // ---- Headwise Inmcome ----
            'account_heads' => $account_heads,
            'expense_heads' => $expense_heads
        ]);
    }

    public function dup()
    {


        ini_set('max_execution_time', 3600);

        $flats = Flat::all();
        // $flats = Flat::where('id',131)->get();

        foreach($flats as $flat){
            foreach($flat->payments->where('type','full') as $payment){
                $duplicates   = Maintenance::where('head_id',1)
                ->where('flat_id',$flat->id)
                ->where('type','partial')
                ->where('month',$payment->month)
                ->where('payment',0)
                ->get();

                foreach($duplicates as $duplicate){
                    $duplicate->delete();
                }
                
            }    
            
            echo $flat->id."<br/";

        }        
    }
}
