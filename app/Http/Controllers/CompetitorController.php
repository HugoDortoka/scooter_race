<?php

namespace App\Http\Controllers;
use App\Models\Competitor;
use App\Models\Membership;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class CompetitorController extends Controller
{
    //ADMIN
    public function index()
    {
        if (Session::get('admin') !== 'admin') {
            return Redirect::route('admin.login');
        }
        $competitors = Competitor::all();
        return view('admin.competitors', compact('competitors'));
    }
    public function search(Request $request){
        $query = $request->input('query');
        $competitors = Competitor::where('name', 'like', "%$query%")->get();
        return view('admin.search_competitors', compact('competitors'));
    }
    //USER
    public function competitors(){


        return view('competitors');
    }
 
    public function profile(){
        if (!Session::has('user')) {
            return Redirect::route('user.login');
        }
        $user = Session::get('user');
        $id = $user->id;
        $membership = Membership::where('competitor_id', '=', $id)->first();
        return view('profile', compact('user', 'membership'));
    }

    public function login(){
        return view('user.login');
    }

    public function checkLogin(Request $request){
        $dni = $request->input('dni');
        $password = $request->input('password');

        $user = Competitor::authenticate($dni, $password);

        if ($user) {
            Session::put('user', $user);
            return Redirect::route('user.home');
        } else {
            return back()->with('error', 'Email or password are incorrect');
        }
    }

    public function registration(){
        return view('user.registration');
    }

    public function insertRegistration(Request $request){
        $dni = $request->input('dni');
        $name = $request->input('name');
        $surname = $request->input('surname');
        $address = $request->input('address');
        $birth = $request->input('birth');
        $PRO_OPEN = $request->input('PRO_OPEN');
        if($PRO_OPEN == "OPEN"){
            $PRO_OPEN = false;
        }else{
            $PRO_OPEN = true;
        }
        if ($request->has('federation')){
            $federation = $request->input('federation');
        }else{
            $federation = null;
        }
        $password = $request->input('password');

        Competitor::create([
            'DNI' => $dni,
            'name' => $name,
            'surname' => $surname,
            'address' => $address,
            'date_of_birth' => $birth,
            'PRO' => $PRO_OPEN,
            'federation_number' => $federation,
            'password' => bcrypt($password),
        ]);
        return Redirect::route('user.login');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('user.home');
    }
}
