<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountHead extends Model
{
    use HasFactory;
    protected $guarded = [];
    

    public function creator(){
        return $this->hasOne('\App\Models\User','id','created_by');
    }

    public function updater(){
        return $this->hasOne('\App\Models\User','id','updated_by');
    }

    public function payments(){
        return $this->hasMany('\App\Models\Maintenance','head_id','id');
    }

}
