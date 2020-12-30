<?php

namespace App\Http\Controllers;

use App\Models\ExpenseHead;
use Illuminate\Http\Request;

class ExpenseHeadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $expense_heads = ExpenseHead::all();
        return view('expense_head.index',[
            'expense_heads' => $expense_heads,
        ]);
    }
    
    public function create()
    {
        return view('expense_head.create',);
    }
    
    public function store(Request $request)
    {
        ExpenseHead::create([
            'name' => request('name'),
            'created_by' => auth()->id()
        ]);

        session()->flash('success','Expense Head Created!');
        return redirect('/expensehead');
    }
    
    public function show(ExpenseHead $expenseHead)
    {
        //
    }
    
    public function edit($id)
    {
        $expense_head = ExpenseHead::findOrFail($id);
        return view('expense_head.edit',[
            'expense_head' => $expense_head,
        ]);
    }
    
    public function update($id)
    {
        $expense_head = ExpenseHead::findOrFail($id);
        $expense_head->update([
            'name' => request('name'),
            'updated_by' => auth()->id()
        ]);

        session()->flash('success','Expense Head Updated!');
        return redirect('/expensehead');
    }
    
    public function destroy(ExpenseHead $expenseHead)
    {
        //
    }
}
