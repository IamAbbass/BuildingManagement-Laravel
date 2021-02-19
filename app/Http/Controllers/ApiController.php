<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Block;
use \App\Models\Flat;

use Auth;

class ApiController extends Controller
{
    
    public function signin(Request $data) {

        $userdata = array(
            'email'     => $data['email'] ,
            'password'  => $data['password']
        );

        if (Auth::attempt($userdata)){

          $user = User::where('email',$data['email'])->first();

          if($user){
            if($user->api_token == null){
                $user->update([
                    'api_token' => hash('sha256', Str::random(60)),
                ]);
            }
            return[
                'success'   => true,
                'title'     => 'Login Success',
                'message'   => 'You are successfully logged in!',
                'api_token' => $user->api_token,
            ];
          }else{
            return[
                'success' => false,
                'title'   => 'Login Failed',
                'message' => 'Only waiters can login, please contact the administrator',
            ];
          }
        }else{
          return[
            'success' => false,
            'title'   => 'Login Failed',
            'message' => 'Invalid email or password!',
          ];
        }
    }

    //show all blocks
    public function block(){
        return Block::all();  
    }

    //show all flats from that block
    public function flats($id){
        return Flat::where('block_id',$id)->get();
    }

    //show single flat details
    public function flat_details($id){
        return Flat::where('name',$id)->get();  
    }

}
