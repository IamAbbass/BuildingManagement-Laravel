<?php

namespace App\Http\Controllers;

use App\Flat;
use App\Building;
use App\Floor;
use App\Block;

use Illuminate\Http\Request;

class FlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($block_id,$floor_id)
    {
      $building=Building::all();
      $block=Block::all();
      $floor=Floor::all();
      $flat=Flat::where('block_id','=',$block_id)->where('floor_id','=',$floor_id)->get();
      return view('Flat.All_Flat',['flat'=>$flat,'building'=>$building,'block'=>$block,'floor'=>$floor,'block_id'=>$block_id,'floor_id'=>$floor_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($block_id,$floor_id)
    {
        return view('Flat.Add_Flat',['block_id'=>$block_id,'floor_id'=>$floor_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$block_id,$floor_id)
    {
     
        $flat_data=array
        (
            'flat_no'=>$request->flat_no,
            'name'=>$request->name,
            'cnic'=>$request->cnic,
            'phone'=>$request->phone,
            'status'=>$request->status,
            'description'=>$request->description,
            'floor_id'=>$floor_id,
            'block_id'=>$block_id,
            'building_id'=>Auth()->User()->building_id
        );
        Flat::create($flat_data);
        return redirect('/block'.'/'.$block_id.'/floor'.'/'.$floor_id.'/flat');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function edit($block_id,$floor_id,$flat_id)
    {
        $flat=Flat::findOrFail($flat_id);
        return view('Flat.Update_Flat',['flat'=>$flat,'block_id'=>$block_id,'floor_id'=>$floor_id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$block,$floor,$flat)
    {
        $flat_data=array
        (
            'flat_no'=>$request->flat_no,
            'name'=>$request->name,
            'cnic'=>$request->cnic,
            'phone'=>$request->phone,
            'status'=>$request->status,
            'description'=>$request->description
           
        );
        Flat::whereId($flat)->update($flat_data);
        return redirect('/block'.'/'.$block.'/floor'.'/'.$floor.'/flat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Flat  $flat
     * @return \Illuminate\Http\Response
     */
    public function destroy($block,$floor,$flat)
    {
        Flat::destroy($flat);
        return redirect()->back();
    }
}
