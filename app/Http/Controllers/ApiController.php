<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\Expense;

class ApiController extends Controller
{   

    public function expense(){
        return Expense::all();  
    }

}
