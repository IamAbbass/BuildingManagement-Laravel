<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExpenseHead;
use App\Building;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($expensehead_id)
    {
        $building=Building::all();
        $expensehead=ExpenseHead::all();
        $expense=Expense::where('expense_head_id','=',$expensehead_id)->where('building_id','=',Auth()->User()->building_id)->get();
       return view('Expense.All_Expense',['expense'=>$expense,'expensehead'=>$expensehead,'building'=>$building,'expensehead_id'=>$expensehead_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($expensehead_id)
    {

        return view('Expense.Add_Expense',['expensehead_id'=>$expensehead_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request ,$expensehead_id)
    {
        $expense_data=array(
            'name'=>$request->name,
            'amount'=>$request->amount,
            'description'=>$request->description,
            'expense_head_id'=>$expensehead_id,
            'user_id'=>Auth()->User()->id,
            'building_id'=>Auth()->User()->building_id
        );
       Expense::create($expense_data);
       return redirect('/expensehead'.'/'.$expensehead_id.'/expense');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit($expensehead_id,$expense_id)
    {
        $expense=Expense::findOrFail($expense_id);
    
        if ($expense->expense_head_id==$expensehead_id && $expense->building_id==Auth()->User()->building_id) {
            return view('Expense.Update_Expense',['expense'=>$expense,'expensehead_id'=>$expensehead_id,'expense_id'=>$expense_id]);
        } else {
            return "wait";
        }
        
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$expensehead,$expense)
    {
        $expense_data=array(
            'name'=>$request->name,
            'amount'=>$request->amount,
            'description'=>$request->description
        );
       Expense::whereId($expense)->update($expense_data);
       return redirect('/expensehead'.'/'.$expensehead.'/expense');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy($expensehead_id,$expense_id)
    {
        Expense::destroy($expense_id);
        return redirect('/expensehead'.'/'.$expensehead_id.'/expense');
    }
}
