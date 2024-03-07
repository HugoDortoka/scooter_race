<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use Illuminate\Http\Request;

class SponsorController extends Controller
{
    public function index()
    {
        $sponsors = Sponsor::all();
        return view('admin.sponsors', compact('sponsors'));
    }
    public function show($id)
    {
        $sponsor = Sponsor::insurerById($id);
        return view('admin.sponsorShow', compact('sponsor'));
    }
    public function showAdd()
    {
        return view('admin.sponsorAdd');
    }
    public function add(Request $request)
    {
        $principal = isset($_POST['principal']) && $_POST['principal'] == 'ON' ? true : false;

        $sponsor = new Sponsor();
        $sponsor->CIF = $request->input('cif');
        $sponsor->name = $request->input('name');
        $logo = $request->file('logo');
        $logoExtension = $logo->getClientOriginalExtension();
        $logoName = time() . '_' . $request->input('name') . '.' . $logoExtension;
        $logo->move(public_path('img/sponsors'), $logoName);
        $logoPath = 'img/sponsors/' . $logoName;
        $sponsor->logo = $logoPath;
        $sponsor->address = $request->input('address');
        
        $principal = $request->has('principal');
        $sponsor->principal = $principal;
        $sponsor->extra_cost = $request->input('extra_cost');
        $sponsor->save();
        $sponsors = Sponsor::all();
        return view('admin.sponsors', compact('sponsors'));
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
        $sponsors = Sponsor::all();
        return view('admin.sponsors', compact('sponsors'));
    }

    public function change($id){
        $sponsor = Sponsor::findOrFail($id);
        $sponsor->active = !$sponsor->active;
        $sponsor->save();
        $sponsors = Sponsor::all();
        return view('admin.sponsors', compact('sponsors'));
    }
}
