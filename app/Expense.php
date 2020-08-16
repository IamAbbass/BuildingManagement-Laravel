<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable=[
        'name','amount','expense_head_id','description','user_id','building_id'
    ];
}
