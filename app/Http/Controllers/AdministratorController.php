<?php

namespace App\Http\Controllers;
use App\Models\Administrator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
            Session::put('admin', 'admin');
            return redirect()->route('admin.home');
        } else {
            return back()->with('error', 'Email or password are incorrect');
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('admin.login');
    }

    public function home()
    {
        return view('admin.home');
    }

}
