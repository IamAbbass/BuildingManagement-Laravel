<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    // start profile code

    public function edit($id)
    {
        $profile=User::findOrFail($id);
        return view('UserProfile.Profile',['profile'=>$profile]);
    }

    public function update(REQUEST $request,$id)
    {

        if (empty($request->input('password'))) {

            $updateProfile=User::find($id);
            $updateProfile->name=$request->input('name');
            $updateProfile->email=$request->input('email');
            $updateProfile->password=$request->input('oldpassword');
            $updateProfile->save();

        } else {
          
            $updateProfile=User::find($id);
            $updateProfile->name=$request->input('name');
            $updateProfile->email=$request->input('email');
            $updateProfile->password=Hash::make($request->input('password'));
            $updateProfile->save();

        }
        
        // $form_data=array(
        //     'name'=>$request->name,
        //     'email'=>$request->email,
        //     'password'=>$request->password,
        //     );
        //     $user=User::update($form_data)->whereId($id);
            return redirect('/');
    }


}
