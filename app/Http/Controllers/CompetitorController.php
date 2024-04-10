<?php

namespace App\Http\Controllers;
use App\Models\Competitor;
use App\Models\Membership;
use App\Models\Sponsor;
use App\Models\Registration;

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
        $sponsorsPrincipal = Sponsor::where('principal', 1)->get();
        return view('competitors', compact('sponsorsPrincipal'));
    }
 
    public function profile(){
        if (!Session::has('user')) {
            return Redirect::route('user.login');
        }
        $user = Session::get('user');
        $id = $user->id;
        $membership = Membership::where('competitor_id', '=', $id)->first();
        $sponsorsPrincipal = Sponsor::where('principal', 1)->get();
        $myRegistrations = Registration::myRegisters($user->id);
        return view('profile', compact('user', 'membership', 'sponsorsPrincipal', 'myRegistrations'));
    }

    public function dropOut2($idCourse){
        $user = Session::get('user');        
        Registration::where('course_id', $idCourse)
                    ->where('competitor_id', $user->id)
                    ->delete();
        return redirect()->route('user.profile');
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

        $exist = Competitor::where('DNI', '=', $dni)
                   ->whereNull('password')
                   ->first();

        $exist2 = Competitor::where('DNI', '=', $dni)->first();

        if ($exist === null) {
            if ($exist2 !== null) {
                return Redirect::route('user.login')->with('alert', 'The competitor already exist');
            } else {
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
            }
        } else {
            Competitor::updateOrCreate(
                ['DNI' => $dni],
                [
                    'name' => $name,
                    'surname' => $surname,
                    'address' => $address,
                    'date_of_birth' => $birth,
                    'PRO' => $PRO_OPEN,
                    'federation_number' => $federation,
                    'password' => bcrypt($password),
                ]
            );
        }
        return Redirect::route('user.login');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('user.home');
    }
}
