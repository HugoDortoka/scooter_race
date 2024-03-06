<?php

namespace App\Http\Controllers;
use App\Models\Administrator;

use Illuminate\Http\Request;

class AdministratorController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function checkLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $administrator = Administrator::authenticate($email, $password);

        if ($administrator) {
            return redirect()->route('admin.home');
        } else {
            return back()->with('error', 'Email or password are incorrect');
        }
    }
    
    public function home()
    {
        return view('admin.home');
    }

}
