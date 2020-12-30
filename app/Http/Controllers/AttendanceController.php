<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use \App\Models\Employee;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $employees = Employee::all();
        return view('attendance.index',[
            'employees' => $employees,
        ]);
    }
}
