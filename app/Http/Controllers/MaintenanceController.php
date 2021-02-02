<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->except(['verify']);
    }

    public function index()
    {
        //
    }

    public function search ()
    {     
        return view("maintenance.search"); 
    }

    public function search_process ()
    {
        $maintenance = Maintenance::where('id',request('receipt_no'))->where('is_cancelled',false)->first();
        

        if($maintenance){
            if($maintenance->contractor_id){
                return redirect("/contractor/slip/$maintenance->id"); 
            }else{
                return redirect("/slip/$maintenance->id"); 
            }            
        }else{
            session()->flash('danger','Receipt Number Not Found!');
            return back();
        }
    }

    public function cancel($id)
    {
        $maintenance    = Maintenance::findOrFail($id);
        $maintenance->update([            
            'is_cancelled' => true,
            'updated_by' => auth()->id(),
        ]);

        if($maintenance->head_id == 1){ //monthly
            $month = strtoupper(date("M-Y"));

            $already_paid   = Maintenance::
            where('flat_id',$maintenance->flat_id) //flat
            ->where('month',$month) //this month
            ->where('is_cancelled',false) //not cancelled
            ->where('head_id',1)->count(); //monthly head

            if($already_paid == 0){
                //generate balance
                Maintenance::create([
                    'head_id' => 1,
                    'flat_id' => $maintenance->flat_id,
                    'amount' => 10000,
                    'discount' => 0,
                    'method' => 'cash',
                    'date' => "",
                    'type' => 'partial',
                    'month' => $month,
                    'payment' => 0,
                ]);
            }            
        }

        session()->flash('success','Maintenance Cancelled!');
        return back();
    }

    public function verify($id)
    {
        $maintenance  = Maintenance::where('id',$id)
        ->where('head_id',1)
        ->where('is_cancelled',false)
        ->first();

        $verified = false;
        if($maintenance){
            $verified = true;
        }
        return view('flat.verify',[
            'verified' => $verified,
        ]);
        
    }

}