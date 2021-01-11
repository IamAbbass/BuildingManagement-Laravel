<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('profile.index',['user' => $user]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);

        if($request->name || $request->email){            
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();
            $request->session()->flash('success', 'Your Profile has been updated!');
            return redirect('/profile');        
        } else if($request->old_password || $request->new_password || $request->confirm_new_password){
           
            $request->validate([
                'old_password' => 'required'
            ]);
            if(password_verify($request->old_password,Auth::user()->password)){

                if($request->new_password || $request->confirm_new_password){
                    if($request->new_password === $request->confirm_new_password){
                        $user->password = Hash::make($request->new_password);
                    }else{
                        $request->session()->flash('error', 'New password and Confirm password NOT matched');
                        return redirect()->back();
                    }
                }

                $user->save();
                $request->session()->flash('success', 'Your Password has been updated!');
                return redirect('/profile');

            }else{
                $request->session()->flash('error', 'Old Password is incorrect');
                return redirect()->back();
            }

        }
    }

 
}
