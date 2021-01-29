<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class ContractorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $contractors = Contractor::all();
        return view('contractor.index',[
            'contractors' => $contractors,
        ]);
    }
    
    public function create()
    {
        return view('contractor.create');
    }
    
    public function store(Request $request)
    {
        Contractor::create([
            'name' => request('name'),
            'cnic' => request('cnic'),
            'mobile' => request('mobile'),
            'notes' => request('notes'),            
            'created_by' => auth()->id()
        ]);

        session()->flash('success','Contractor Created!');
        return redirect('/contractor');
    }
    
    public function edit($id)
    {
        $contractor = Contractor::findOrFail($id);
        return view('contractor.edit',[
            'contractor' => $contractor,
        ]);
    }
    
    public function update($id)
    {
        $contractor = Contractor::findOrFail($id);
        $contractor->update([
            'name' => request('name'),
            'cnic' => request('cnic'),
            'mobile' => request('mobile'),
            'notes' => request('notes'),    
            'updated_by' => auth()->id()
        ]);

        session()->flash('success','Contractor Updated!');
        return redirect('/contractor');
    }

    public function payment($id)
    {
        $contractor = Contractor::findOrFail($id);

        return view('contractor.payment',[
            'contractor' => $contractor
        ]);
    }

    public function payment_save ($id)
    {
        $month  = strtoupper(date("M-Y", strtotime(request('month'))));
        $date   = strtoupper(date("d-M-Y", strtotime(request('date'))));

        $payment = Maintenance::create([
            'head_id' => 0,
            'flat_id' => 0,
            'contractor_id' => $id,            
            'amount' => request('amount'),
            'discount' => request('discount'),
            'method' => request('method'),
            'cheque_no' => request('cheque_no') ?? "",
            'date' => $date,
            'type' => request('type'),
            'month' => $month,
            'payment' => request('payment'),
            'description' => request('description'),
            'old_slip_no' => request('old_slip_no'),     
        ]);

        return redirect("/contractor/slip/$payment->id"); 
        
    }

    public function slip ($id)
    {     
        $payment = Maintenance::findOrFail($id);

        return view("contractor.slip",[
            'payment' => $payment,
        ]); 
    }
    
    public function show($id)
    {
        $contractor = Contractor::findOrFail($id);
        return view('contractor.show',[
            'contractor' => $contractor,
        ]);
    }

    public function cancel($id)
    {
        $maintenance    = Maintenance::findOrFail($id);
        $maintenance->update([            
            'is_cancelled'=> true,
            'updated_by'=> auth()->id(),
        ]);
        session()->flash('success','Maintenance Cancelled!');
        return back();
    }

    public function print($id)
    {
        $contractor = Contractor::findOrFail($id);
        return view('contractor.ledger',[
            'contractor' => $contractor,
        ]);
    }


}
