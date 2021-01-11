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
    
    public function edit($flat,$vehicle)
    {
        $vehicle    = Vehicle::findOrFail($vehicle);
        $flat       = Flat::findOrFail($flat);
        return view('vehicle.edit',[
            'vehicle' => $vehicle,
            'flat' => $flat,
        ]);
    }
    
    public function update($flat,$vehicle)
    {
        $vehicle    = Vehicle::findOrFail($vehicle);
        $flat       = Flat::findOrFail($flat);
        
        $vehicle->update([
            'make'          => request('make'),
            'model'         => request('model'),
            'color'         => request('color'),
            'number'        => request('number'),
            'updated_by'    => auth()->id()
        ]);

        session()->flash('success','Vehicle Saved!');
        return redirect("/flat/".$flat->id."/vehicle");
    }

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
