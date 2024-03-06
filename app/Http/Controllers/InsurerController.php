<?php

namespace App\Http\Controllers;

use App\Models\Insurer;
use Illuminate\Http\Request;

class InsurerController extends Controller
{
    public function index()
    {
        $insurers = Insurer::all();
        return view('admin.insurers', compact('insurers'));
    }
    public function show($id)
    {
        $insurer = Insurer::insurerById($id);
        return view('admin.insurerShow', compact('insurer'));
    }
    public function showAdd()
    {
        return view('admin.insurerAdd');
    }
    public function add(Request $request)
    {
        $insurer = new Insurer();
        $insurer->CIF = $request->input('cif');
        $insurer->name = $request->input('name');
        $insurer->address = $request->input('address');
        $insurer->price_per_course = $request->input('price');
        $insurer->save();
        $insurers = Insurer::all();
        return view('admin.insurers', compact('insurers'));
    }
    

    public function update(Request $request, $id)
    {
        $insurer = Insurer::findOrFail($id);
        $insurer->update([
            'CIF' => $request->input('cif'),
            'name' => $request->input('name'),
            'address' => $request->input('address'),
            'price_per_course' => $request->input('price')
        ]);
        $insurers = Insurer::all();
        return view('admin.insurers', compact('insurers'));
    }

    public function change($id){
        $insurer = Insurer::findOrFail($id);
        $insurer->active = !$insurer->active;
        $insurer->save();
        $insurers = Insurer::all();
        return view('admin.insurers', compact('insurers'));
    }
}
