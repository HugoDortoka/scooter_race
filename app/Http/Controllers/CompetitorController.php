<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompetitorController extends Controller
{
    
    //USER
    public function competitors(){


        return view('competitors');
    }
 
    public function profile(){


        return view('profile');
    }
}
