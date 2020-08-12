<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    protected $fillable = [
        'name','description','user_id','building_id'
    ];
}
