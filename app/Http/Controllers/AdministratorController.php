<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }
    
    public function home()
    {
        return view('admin.home');
    }

}
