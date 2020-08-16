<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    protected $fillable = ['flat_no','name','cnic','phone','status','description','block_id','floor_id','building_id'];
}
