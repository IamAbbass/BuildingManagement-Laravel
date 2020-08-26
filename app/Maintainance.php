<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintainance extends Model
{
    //
   protected $fillable=[
       'block_id','floor_id','flat_id','building_id','user_id','amount','description'
   ];
}
