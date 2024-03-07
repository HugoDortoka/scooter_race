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
        $sponsor->logo = $request->input('logo');
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

        $sponsor->update([
            
            'CIF' => $request->input('cif'),
            'name' => $request->input('name'),
            'logo' => $request->input('logo'),
            'address' => $request->input('address'),
            'principal' => $request->has('principal'),

            'extra_cost' => $request->input('extra_cost')
        ]);
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
