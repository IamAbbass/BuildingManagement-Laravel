<?php

namespace App\Http\Controllers;

use App\Maintainance;
use App\Block;
use App\Floor;
use App\Flat;
use App\Building;
use Illuminate\Http\Request;

class MaintainanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $block=Block::all();
        $floor=Floor::all();
        $flat=Flat::all();
        $building=Building::all();
        $maintenance=Maintainance::where('user_id','=',Auth()->User()->id)->get();
        return view('Maintenance.All_maintenance',['maintenance'=>$maintenance,'block'=>$block,'floor'=>$floor,'flat'=>$flat,'building'=>$building]); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFloorList(Request $request)
        {
            $floors = Floor::where("block_id",$request->block_id)->get();
            
            return response()->json($floors);
        }

        public function getFlatList(Request $request)
        {
            $flats = Flat::where("floor_id",$request->floor_id)->get();

            return response()->json($flats);
        }
    public function create()
    {
        $block=Block::where('building_id','=',Auth()->User()->building_id)->get();
        return view('Maintenance.Add_Maintenance',['block'=>$block]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

   


    public function store(Request $request)
    {
        $maintainance_data=array(
            'block_id'=>$request->block_id,
            'floor_id'=>$request->floor_id,
            'flat_id'=>$request->flat_id,
            'building_id'=>Auth()->User()->building_id,
            'amount'=>$request->amount,
            'description'=>$request->description,
            'user_id'=>Auth()->User()->id
        );
        
        Maintainance::create($maintainance_data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Maintainance  $maintainance
     * @return \Illuminate\Http\Response
     */
    public function show(Maintainance $maintainance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Maintainance  $maintainance
     * @return \Illuminate\Http\Response
     */
    public function edit(Maintainance $maintainance)
    {
        $get_flat=Flat::findOrFail($maintainance->flat_id);
        $get_floor=Floor::findOrFail($maintainance->floor_id);
        $get_block=Block::findOrFail($maintainance->block_id);
        $block=Block::where('building_id','=',Auth()->User()->building_id)->get();
     //  $update_maintainance=Maintainance::where('id','=',$maintainance->id)->where('user_id','=',Auth()->User()->id)->get();
        $update_maintainance=Maintainance::findOrFail($maintainance->id);
        return view('Maintenance.Update_maintenance',['update_maintainance'=>$update_maintainance,'block'=>$block,'get_block'=>$get_block
                                                    ,  'get_floor'=>$get_floor,'get_flat'=>$get_flat]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Maintainance  $maintainance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Maintainance $maintainance)
    {
        $maintainance_data=array(
            'block_id'=>$request->block_id,
            'floor_id'=>$request->floor_id,
            'flat_id'=>$request->flat_id,
            'amount'=>$request->amount,
            'description'=>$request->description
        );
      
        Maintainance::whereId($maintainance->id)->update($maintainance_data);
        return redirect('/maintainance');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Maintainance  $maintainance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Maintainance $maintainance)
    {
        Maintainance::destroy($maintainance->id);
        return redirect()->back();
    }
}
