<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Flat;

use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index($id)
    {
        $vehicles   = Vehicle::where('flat_id',$id)->get();
        $flat       = Flat::findOrFail($id);

        return view('vehicle.index',[
            'vehicles' => $vehicles,
            'flat' => $flat,
        ]);
    }
    
    public function create($id)
    {        
        $flat       = Flat::findOrFail($id);
        return view('vehicle.create',[
            'flat' => $flat
        ]);
    }
    
    public function store($id)
    {
        Vehicle::create([
            'make'          => request('make'),
            'model'         => request('model'),
            'color'         => request('color'),
            'number'        => request('number'),
            'flat_id'       => $id,            
            'created_by'    => auth()->id()
        ]);

        session()->flash('success','Vehicle Saved!');
        return redirect("/flat/".$id."/vehicle");
        
    }
    
    // public function show(Expense $expense)
    // {
    //     //
    // }
    
    // public function edit($id)
    // {
    //     $expense = Vehicle::findOrFail($id);
    //     $expense_heads   = ExpenseHead::all();
    //     return view('vehicle.edit',[
    //         'expense' => $expense,
    //         'expense_heads' => $expense_heads
    //     ]);
    // }
    
    // public function update($id)
    // {
    //     $expense = Vehicle::findOrFail($id);
    //     $expense->update([
    //         'head_id'       => request('head_id'),
    //         'name'          => request('name'),
    //         'description'   => request('description'),
    //         'date'          => request('date'),
    //         'amount'        => request('amount'),            
    //         'updated_by'    => auth()->id()
    //     ]);

    //     session()->flash('success','Expense Updated!');
    //     return redirect('/expense');
    // }

    // public function slip($id)
    // {
    //     $expense = Vehicle::findOrFail($id);
    //     return view('vehicle.slip',[
    //         'expense' => $expense,
    //     ]);
    // }
    
    // public function destroy(Expense $expense)
    // {
    //     //
    // }
}
