<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Expense;

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
    public function index()
    {
        $defaulters     = 0;
        $income         = 0;
        $expense        = Expense::sum('amount');
        $balance        = 0;

        return view('dashboard',[
            'defaulters'    => $defaulters,
            'income'        => $income,
            'expense'       => $expense,
            'balance'       => $balance
        ]);
    }
}
