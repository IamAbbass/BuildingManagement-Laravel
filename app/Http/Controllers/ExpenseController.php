<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

use \App\Models\ExpenseHead;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $expenses       = Expense::all();        
        return view('expense.index',[
            'expenses' => $expenses,
        ]);
    }
    
    public function create()
    {        
        $expense_heads   = ExpenseHead::all();
        return view('expense.create',[
            'expense_heads' => $expense_heads
        ]);
    }
    
    public function store(Request $request)
    {
        Expense::create([
            'head_id'       => request('head_id'),
            'name'          => request('name'),
            'description'   => request('description'),
            'date'          => request('date'),
            'amount'        => request('amount'),
            'exp_type'      => request('exp_type'),      
            'created_by'    => auth()->id()
        ]);

        session()->flash('success','Expense Created!');
        return redirect('/expense');
    }
    
    public function show(Expense $expense)
    {
        //
    }
    
    public function edit($id)
    {
        $expense = Expense::findOrFail($id);
        $expense_heads   = ExpenseHead::all();
        return view('expense.edit',[
            'expense' => $expense,
            'expense_heads' => $expense_heads
        ]);
    }
    
    public function update($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->update([
            'head_id'       => request('head_id'),
            'name'          => request('name'),
            'description'   => request('description'),
            'date'          => request('date'),
            'amount'        => request('amount'),
            'exp_type'      => request('exp_type'),      
            'updated_by'    => auth()->id()
        ]);

        session()->flash('success','Expense Updated!');
        return redirect('/expense');
    }

    public function slip($id)
    {
        $expense = Expense::findOrFail($id);
        return view('expense.slip',[
            'expense' => $expense,
        ]);
    }
    
    public function destroy(Expense $expense)
    {
        //
    }
}
