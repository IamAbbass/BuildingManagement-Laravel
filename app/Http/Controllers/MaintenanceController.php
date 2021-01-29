<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
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
        $maintenance = Maintenance::where('id',request('receipt_no'))->first();
        if($maintenance){
            return redirect("/slip/$maintenance->id"); 
        }else{
            session()->flash('danger','Receipt Number Not Found!');
            return back();
        }
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

    public function verify($id)
    {
        $maintenance  = Maintenance::where('id',$id)->where('head_id',2)->where('is_cancelled',false)->first();
        $verified = false;
        if($maintenance){
            $verified = true;
        }
        return view('flat.verify',[
            'verified' => $verified,
        ]);
        
    }

}