<?php

namespace App\Http\Controllers;

use App\Models\AccountHead;
use Illuminate\Http\Request;

class AccountHeadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $account_heads = AccountHead::all();
        return view('account_head.index',[
            'account_heads' => $account_heads,
        ]);
    }
    
    public function create()
    {
        return view('account_head.create',);
    }
    
    public function store(Request $request)
    {
        AccountHead::create([
            'name' => request('name'),
            'default_amount' => request('default_amount'),
            'created_by' => auth()->id()
        ]);

        session()->flash('success','Account Head Created!');
        return redirect('/accounthead');
    }
    
    public function show(ExpenseHead $expenseHead)
    {
        //
    }
    
    public function edit($id)
    {
        $account_head = AccountHead::findOrFail($id);
        return view('account_head.edit',[
            'account_head' => $account_head,
        ]);
    }
    
    public function update($id)
    {
        $expense_head = AccountHead::findOrFail($id);
        $expense_head->update([
            'name' => request('name'),
            'default_amount' => request('default_amount'),
            'updated_by' => auth()->id()
        ]);

        session()->flash('success','Account Head Updated!');
        return redirect('/accounthead');
    }
    
    public function destroy(ExpenseHead $expenseHead)
    {
        //
    }
}
