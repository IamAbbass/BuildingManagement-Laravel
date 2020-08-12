<?php

namespace App\Http\Controllers;

use App\Block;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $block=Block::where('building_id','=',Auth::User()->building_id)->paginate(2);
         return view('Block.All_Block',['block'=>$block]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
         return view('Block.Add_Block');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        
        $block_data=array(

            'name'=>$request->name,
            'description'=>$request->description,
            'user_id'=>Auth()->User()->id,
            'building_id'=>Auth()->User()->building_id
        );
        Block::create($block_data);
        return redirect('/block');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function show(Block $block)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function edit(Block $block)
    {
        if ($block->building_id!=Auth::User()->building_id) {
            return "its not your block";
        } else {
            return view('Block.Update_Block',['block'=>$block]);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Block $block)
    {
        $block_data=array(
            'name'=>$request->name,
            'description'=>$request->description
        );
        Block::whereId($block->id)->update($block_data);
        return redirect('/block');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Block  $block
     * @return \Illuminate\Http\Response
     */
    public function destroy(Block $block)
    {
        Block::destroy($block->id);
        return redirect('/block');
    }
}
