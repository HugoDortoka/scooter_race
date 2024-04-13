<?php

namespace App\Http\Controllers;
use App\Models\Competitor;
use App\Models\Membership;
use App\Models\Sponsor;
use App\Models\Registration;
use App\Models\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $topGeneral = Competitor::topGeneral();
        $topMale = Competitor::topMale();
        $topFemale = Competitor::topFemale();
        $topMaster20 = Competitor::topMaster20();
        $topMaster30 = Competitor::topMaster30();
        $topMaster40 = Competitor::topMaster40();

        return view('competitors', compact('sponsorsPrincipal', 'topGeneral', 'topMale', 'topFemale', 'topMaster20', 'topMaster30', 'topMaster40'));
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

    public function competitorsPDFGeneral(){
        $competitors = Competitor::topGeneral();
        
        $pdf = Pdf::loadView('user.pdfCompetitors', compact('competitors'));
        $fileName = 'competitors.pdf';
        return $pdf->download($fileName);
    }

    public function competitorsPDFMale(){
        $competitors = Competitor::topMale();
    
        $pdf = Pdf::loadView('user.pdfCompetitors', compact('competitors'));
        $fileName = 'competitors.pdf';
        return $pdf->download($fileName);
    }

    public function competitorsPDFFemale(){
        $competitors = Competitor::topFemale();
    
        $pdf = Pdf::loadView('user.pdfCompetitors', compact('competitors'));
        $fileName = 'competitors.pdf';
        return $pdf->download($fileName);
    }

    public function competitorsPDF20(){
        $competitors = Competitor::topMaster20();
    
        $pdf = Pdf::loadView('user.pdfCompetitors', compact('competitors'));
        $fileName = 'competitors.pdf';
        return $pdf->download($fileName);
    }

    public function competitorsPDF30(){
        $competitors = Competitor::topMaster30();
    
        $pdf = Pdf::loadView('user.pdfCompetitors', compact('competitors'));
        $fileName = 'competitors.pdf';
        return $pdf->download($fileName);
    }

    public function competitorsPDF40(){
        $competitors = Competitor::topMaster40();
    
        $pdf = Pdf::loadView('user.pdfCompetitors', compact('competitors'));
        $fileName = 'competitors.pdf';
        return $pdf->download($fileName);
    }

    public function points($idCourse){
        $participants = Registration::participants($idCourse);
        $max_points = 1000;
        foreach ($participants as $participant) {
            if ($max_points > 0) {
                Competitor::updatePoints($participant->competitor_id, $max_points);
                $max_points -= 100;
            }
        }
        Course::updatePointed($idCourse);
        return Redirect::route('admin.showParticipants', ['courseId' => $idCourse]);
    }
}
