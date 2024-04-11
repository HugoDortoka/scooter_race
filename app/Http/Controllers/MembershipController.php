<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\Competitor;
use App\Models\Sponsor;
use App\Models\Registration;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;

class MembershipController extends Controller
{
    //USER
    public function new($id)
    {
        $membership = new Membership();
        $membership->competitor_id = $id;
        $membership->subscription_date = date('Y-m-d');
        $membership->subscription_finish = date('Y-m-d', strtotime('+1 year'));
        $membership->annual_fee = 200;
        $membership->paid = 1;
        $membership->discount = 20;
        $repeat = Membership::repeat($membership->competitor_id);
        if ($repeat->count() > 0) {
            // The membership is already on the BBDD
        }else{
            $membership->save();
            $competitor = Competitor::where('id', '=', $id)->first();
            $company = Company::ourCompany();
            $pdfPath = public_path('pdf/Inscription.pdf');
            $pdf = Pdf::loadView('user.pdfMembership', compact('competitor', 'membership', 'company'));
            $pdf->save($pdfPath);
        }
        $user = Session::get('user');
        $id = $user->id;
        $membership = Membership::where('competitor_id', '=', $id)->first();
        $sponsorsPrincipal = Sponsor::where('principal', 1)->get();
        $myRegistrations = Registration::myRegisters($user->id);
        if (isset($pdfPath)) {
            return view('profile', compact('user', 'membership', 'sponsorsPrincipal', 'myRegistrations', 'pdfPath'));
        } else {
            return view('profile', compact('user', 'membership', 'sponsorsPrincipal', 'myRegistrations'));
        } 
    }
}
