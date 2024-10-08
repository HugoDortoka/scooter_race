<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use App\Models\Courses_sponsor;
use App\Models\Course;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Barryvdh\DomPDF\Facade\Pdf;

class SponsorController extends Controller
{
    public function index()
    {
        if (Session::get('admin') !== 'admin') {
            return Redirect::route('admin.login');
        }
        $sponsors = Sponsor::all();
        return view('admin.sponsors', compact('sponsors'));
    }
    public function show($id)
    {
        if (Session::get('admin') !== 'admin') {
            return Redirect::route('admin.login');
        }
        $sponsor = Sponsor::insurerById($id);
        return view('admin.sponsorShow', compact('sponsor'));
    }
    public function showAdd()
    {
        if (Session::get('admin') !== 'admin') {
            return Redirect::route('admin.login');
        }
        return view('admin.sponsorAdd');
    }
    public function add(Request $request)
    {
        $principal = isset($_POST['principal']) && $_POST['principal'] == 'ON' ? true : false;

        $sponsor = new Sponsor();
        $sponsor->CIF = $request->input('cif');
        $sponsor->name = $request->input('name');
        $sponsor->address = $request->input('address');
        $principal = $request->has('principal');
        $sponsor->principal = $principal;
        $sponsor->extra_cost = $request->input('extra_cost');
        $repeat = Sponsor::where('CIF', $sponsor->CIF)->get();
        if ($repeat->count() > 0) {
            // The sponsor is already on the BBDD
        }else{
            $logo = $request->file('logo');
            $logoExtension = $logo->getClientOriginalExtension();
            $logoName = time() . '_' . $request->input('name') . '.' . $logoExtension;
            $logo->move(public_path('img/sponsors'), $logoName);
            $logoPath = 'img/sponsors/' . $logoName;
            $sponsor->logo = $logoPath;
            $sponsor->save();
        }
        return Redirect::route('admin.sponsors');
    }
    

    public function update(Request $request, $id)
    {
        $sponsor = Sponsor::findOrFail($id);
        $principal = isset($_POST['principal']) && $_POST['principal'] == 'ON' ? true : false;

        $dataToUpdate = [
            'CIF' => $request->input('cif'),
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'principal' => $request->has('principal'),
            'extra_cost' => $request->input('extra_cost')
        ];
        
        if ($request->hasFile('logo')) {
            unlink(public_path($sponsor->logo));
            $logo = $request->file('logo');
            $logoExtension = $logo->getClientOriginalExtension();
            $logoName = time() . '_' . $request->input('name') . '.' . $logoExtension;
            $logo->move(public_path('img/sponsors'), $logoName);
            $logoPath = 'img/sponsors/' . $logoName;
            $dataToUpdate['logo'] = $logoPath;
        }

        $sponsor->update($dataToUpdate);
        return Redirect::route('admin.sponsors');
    }

    public function change($id){
        $sponsor = Sponsor::findOrFail($id);
        $sponsor->active = !$sponsor->active;
        $sponsor->save();
        return Redirect::route('admin.sponsors');
    }

    public function search(Request $request){
        $query = $request->input('query');
        $sponsors = Sponsor::where('name', 'like', "%$query%")->get();
        return view('admin.search_sponsors', compact('sponsors'));
    }

    public function printInvoice($id){
        $coursesCost = 0;
        $sponsor = Sponsor::findOrFail($id);
        $courseSponsors = Courses_sponsor::where('sponsor_id', $id)->get();
        foreach ($courseSponsors as $courseSponsor) {
            $course = Course::find($courseSponsor->course_id);
            $coursesCost += $course->sponsorship_cost;
        }
        if($sponsor->extra_cost !== null){
            $coursesCost += $sponsor->extra_cost;
        }
        $company = Company::ourCompany();
        $pdf = Pdf::loadView('admin.pdfInvoice', compact('sponsor', 'coursesCost', 'company'));
        return $pdf->stream();
    }
}
