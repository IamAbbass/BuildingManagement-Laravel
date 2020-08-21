<?php

namespace App\Http\Controllers;

use App\ExpenseHead;
use App\Building;
use Illuminate\Http\Request;

class ExpenseHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $expensehead=Expensehead::where('building_id','=',Auth()->User()->building_id)->get();
        $building=Building::findOrFail(Auth()->User()->building_id);
        return view('ExpenseHead.All_ExpenseHead',['expensehead'=>$expensehead,'building'=>$building]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $building=Building::findOrFail(Auth()->User()->building_id);
        return view('ExpenseHead.Add_ExpenseHead' ,['building'=>$building]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $expensehead_name=$request->name;
       $expensehead=array(
           'name'=>$request->name,
           'description'=>$request->description,
           'building_id'=>Auth()->User()->building_id
       );
       ExpenseHead::create($expensehead);
       return redirect('/expensehead')->with('addexpensehead',$expensehead_name.' added Seccessfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ExpenseHead  $expenseHead
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseHead $expenseHead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ExpenseHead  $expenseHead
     * @return \Illuminate\Http\Response
     */
    public function edit( $expenseHead)
    {
        //  return Auth()->User()->building_id;
        $expensehead=ExpenseHead::findOrFail($expenseHead);
            // return view('ExpenseHead.Update_ExpenseHead',['expensehead'=>$expensehead]);
        if ($expensehead->building_id!=Auth()->User()->building_id) {
          return "its not yours ";
        } else {
            
            return view('ExpenseHead.Update_ExpenseHead',['expensehead'=>$expensehead]);
        }
        // return $expensehead->building_id;
        

       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExpenseHead  $expenseHead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $expensehead_id)
    {
        $old_expensehead_name=ExpenseHead::findOrFail($expensehead_id);
        $new_expensehead_name=$request->name;
        $expensehead_data=array(
            'name'=>$request->name,
            'description'=>$request->description
        );
        ExpenseHead::whereId($expensehead_id)->update($expensehead_data);
        return redirect('/expensehead')->with('updateexpensehead',$old_expensehead_name->name.' Updated to '.$new_expensehead_name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExpenseHead  $expenseHead
     * @return \Illuminate\Http\Response
     */
    public function destroy($expenseHead)
    {
        $expensehead_name=ExpenseHead::findOrFail($expenseHead);
        ExpenseHead::destroy($expenseHead);
        return redirect('/expensehead')->with('deleteexpensehead',$expensehead_name->name.' Deleted');
    }
}
