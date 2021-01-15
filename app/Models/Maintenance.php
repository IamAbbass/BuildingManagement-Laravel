<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function creator(){
        return $this->hasOne('\App\Models\User','id','created_by');
    }

    public function updater(){
        return $this->hasOne('\App\Models\User','id','updated_by');
    } 

    public function flat(){
        return $this->hasOne('\App\Models\Flat','id','flat_id');
    } 

    public function contractor(){
        return $this->hasOne('\App\Models\Contractor','id','contractor_id');
    } 

    public function account(){
        return $this->hasOne('\App\Models\AccountHead','id','head_id');
    } 
}
