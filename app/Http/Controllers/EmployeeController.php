<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $employees = Employee::all();
        return view('employee.index',[
            'employees' => $employees,
        ]);
    }
    
    public function create()
    {
        return view('employee.create');
    }
    
    public function store(Request $request)
    {
        Employee::create([
            'name' => request('name'),
            'cnic' => request('cnic'),
            'mobile' => request('mobile'),
            'salary' => request('salary'),
            'department' => request('department'),
            'notes' => request('notes'),            
            'created_by' => auth()->id()
        ]);

        session()->flash('success','Employee Created!');
        return redirect('/employee');
    }
    
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        return view('employee.edit',[
            'employee' => $employee,
        ]);
    }
    
    public function update($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->update([
            'name' => request('name'),
            'cnic' => request('cnic'),
            'mobile' => request('mobile'),
            'salary' => request('salary'),
            'department' => request('department'),
            'notes' => request('notes'),    
            'updated_by' => auth()->id()
        ]);

        session()->flash('success','Employee Updated!');
        return redirect('/employee');
    }
    
}
