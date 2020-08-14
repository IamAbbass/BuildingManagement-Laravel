<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    protected $fillable=[
        'name','description','block_id','building_id',
    ];
}
