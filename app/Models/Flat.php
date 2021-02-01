<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function block(){
        return $this->hasOne('\App\Models\Block','id','block_id');
    }

    public function last_payment(){
        return $this->hasOne('\App\Models\Maintenance','flat_id','id')->where('is_cancelled',false)->orderBy('id', 'desc');
    }

    public function payments(){
        return $this->hasMany('\App\Models\Maintenance','flat_id','id');
    }

    public function vehicles(){
        return $this->hasMany('\App\Models\Vehicle','flat_id','id');
    }

    public function isDefaulter(){
        return $this->hasMany('\App\Models\Maintenance','flat_id','id')
        ->where('is_cancelled',false)
        ->where('month',strtoupper(date('M-Y')))
        ->where('head_id',1);
    }
}
