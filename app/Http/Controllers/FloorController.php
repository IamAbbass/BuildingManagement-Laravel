<?php

namespace App\Http\Controllers;

use App\Floor;
use App\Block;
use App\Building;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FloorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
         $block=Block::all();
         $builidng=Building::all();
         $floor=Floor::where('building_id','=',Auth()->User()->building_id)->where('block_id','=',$id) ->get();
         return view('Floor.All_Floor',['floor'=>$floor,'building'=>$builidng,'block'=>$block,'id'=>$id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        
        return view('Floor.Add_Floor',['id'=>$id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $floor=array(
            'name'=>$request->name,
            'description'=>$request->description,
            'block_id'=>$id,
            'building_id'=>Auth()->User()->building_id
        );
      Floor::create($floor);
      return redirect('/block'. '/'.$id.'/floor');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function show(Floor $floor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function edit($block_id ,$floor_id)
    {
     $floor=Floor::findOrFail($floor_id);       
     return view('Floor.Update_Floor',['floor'=>$floor,'block'=>$block_id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$block,$floor)
    {
        
       
      $floor_data=array(
          'name'=>$request->name,
          'description'=>$request->description,
      );
      Floor::whereId($floor)->update($floor_data);
      return redirect('/block'. '/'.$block.'/floor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Floor  $floor
     * @return \Illuminate\Http\Response
     */
    public function destroy($block,$floor)
    {
        
       
       Floor::destroy($floor);
       return redirect()->back();
    }
}
