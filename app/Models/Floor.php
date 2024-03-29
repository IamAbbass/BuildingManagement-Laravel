<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function block(){
        return $this->hasOne('\App\Models\Block','id','block_id');
    }
}
