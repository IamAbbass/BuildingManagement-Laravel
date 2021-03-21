<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Block;
use \App\Models\Flat;
use \App\Models\ExpenseHead;


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
        $flat = Flat::where('name',$id)->first();
        if($flat){
          return [
            'flat'      => $flat,
            'vehicles'  => $flat->vehicles,
            'payments'  => $flat->payments,
            'success'   => true,
          ];
        }else{
          return [
            'flat'      => [],
            'vehicles'  => [],
            'payments'  => [],
            'success'   => false,
          ];
        }        
    }

    //Expense Head Summary
    public function expense_head(){
      // $month = request('month');
      $expense_heads = ExpenseHead::all();
      $return = array();
      foreach($expense_heads as $key => $expense_head){
        $return[$key]['id']     = $expense_head->id;       
        $return[$key]['name']   = $expense_head->name;       
        $return[$key]['total']  = $expense_head->expense->sum('amount');
        // ->where('date', 'LIKE', '%2021%')->get;
      }
      return $return;      
    }

    public function expense_head_details($id){
      
      $expense_head = ExpenseHead::findOrFail($id);
      return $expense_head;

      $return = array();
      foreach($expense_heads as $key => $expense_head){
        $return[$key]['id']     = $expense_head->id;       
        $return[$key]['name']   = $expense_head->name;       
        $return[$key]['total']  = $expense_head->expense->sum('amount');
        // ->where('date', 'LIKE', '%2021%')->get;
      }
      return $return;      
    }

    


}
