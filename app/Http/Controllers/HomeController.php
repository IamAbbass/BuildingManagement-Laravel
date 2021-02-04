<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Expense;
use App\Models\Maintenance;

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
        $defaulters     = 0;
        $income         = 0;
        $expense        = Expense::sum('amount');
        $balance        = 0;

        $monthly_maintainance = Maintenance::where('head_id', 1)->sum('amount');
        $membership           = Maintenance::where('head_id', 2)->sum('amount');
        $ro                   = Maintenance::where('head_id', 3)->sum('amount');
        $membership_tenant    = Maintenance::where('head_id', 4)->sum('amount');
        $membership_purchaser = Maintenance::where('head_id', 5)->sum('amount');
        $membership_owner     = Maintenance::where('head_id', 6)->sum('amount');
        $event_charges        = Maintenance::where('head_id', 7)->sum('amount');
        $ur_net               = Maintenance::where('head_id', 8)->sum('amount');

        return view('dashboard',[
            'defaulters'    => $defaulters,
            'income'        => $income,
            'expense'       => $expense,
            'balance'       => $balance,

            // ---- Headwise Inmcome ----
            'monthly_maintainance' => $monthly_maintainance,
            'membership'           => $membership,
            'ro'                   => $ro,
            'membership_tenant'    => $membership_tenant,
            'membership_purchaser' => $membership_purchaser,
            'membership_owner'     => $membership_owner,
            'event_charges'        => $event_charges,
            'ur_net'               => $ur_net
        ]);
    }
}
