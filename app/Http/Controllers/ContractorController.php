<?php

namespace App\Http\Controllers;

use App\Models\Contractor;
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
}
