<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function creator(){
        return $this->hasOne('\App\Models\User','id','created_by');
    }

    public function updater(){
        return $this->hasOne('\App\Models\User','id','updated_by');
    }  
}
