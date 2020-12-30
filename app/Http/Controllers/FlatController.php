<?php

namespace App\Http\Controllers;

use \App\Models\Flat;
use \App\Models\AccountHead;
use \App\Models\Maintenance;

use Illuminate\Http\Request;

class FlatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flats = Flat::all();
        return view('flat.index',[
            'flats' => $flats,
        ]);
    }
    
    public function edit($id)
    {
        $flat = Flat::findOrFail($id);
        return view('flat.edit',[
            'flat' => $flat,
        ]);
    }
    
    public function update($id)
    {
        $flat = Flat::findOrFail($id);
        $flat->update([
            'person_name'=> request('person_name'),
            'person_mobile'=> request('person_mobile'),
            'person_mobile2'=> request('person_mobile2'),
            'person_cnic'=> request('person_cnic'),
            'person_perm_address'=> request('person_perm_address'),
            'status'=> request('status'),
            'updated_by'=> auth()->id(),
        ]);
        session()->flash('success','Flat Info Updated!');
        return redirect('/flat'); 
    }

    public function payment ($id)
    {
        $flat           = Flat::findOrFail($id);
        $account_heads  = AccountHead::all();

        return view('flat.payment',[
            'account_heads' => $account_heads,
            'flat' => $flat,
        ]);
    }

    public function payment_save ($id)
    {
        $payment = Maintenance::create([
            'head_id' => request('head_id'),
            'flat_id' => $id,
            'amount' => request('amount'),
            'discount' => request('discount'),
            'method' => request('method'),
            'cheque_no' => request('cheque_no'),
            'date' => request('date'),
            'type' => request('type'),
            'month' => request('month'),
            'payment' => request('payment'),
        ]);
        return redirect("/slip/$payment->id"); 
    } 
    
    public function slip ($id)
    {     
        $payment = Maintenance::findOrFail($id);

        return view("flat.slip",[
            'payment' => $payment,
        ]); 
    } 
}
