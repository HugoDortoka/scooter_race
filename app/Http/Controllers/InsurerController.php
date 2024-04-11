<?php

namespace App\Http\Controllers;

use App\Models\Insurer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class InsurerController extends Controller
{
    public function index()
    {
        if (Session::get('admin') !== 'admin') {
            return Redirect::route('admin.login');
        }
        $insurers = Insurer::all();
        return view('admin.insurers', compact('insurers'));
    }
    public function show($id)
    {
        if (Session::get('admin') !== 'admin') {
            return Redirect::route('admin.login');
        }
        $insurer = Insurer::insurerById($id);
        return view('admin.insurerShow', compact('insurer'));
    }
    public function showAdd()
    {
        if (Session::get('admin') !== 'admin') {
            return Redirect::route('admin.login');
        }
        return view('admin.insurerAdd');
    }
    public function add(Request $request)
    {
        $insurer = new Insurer();
        $insurer->CIF = $request->input('cif');
        $insurer->name = $request->input('name');
        $insurer->address = $request->input('address');
        $insurer->price_per_course = $request->input('price');
        $repeat = Insurer::where('CIF', $insurer->CIF)->get();
        if ($repeat->count() > 0) {
            // The insurer is already on the BBDD
        }else{
            $insurer->save();
        }
        return Redirect::route('admin.insurers');
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
        return Redirect::route('admin.insurers');
    }

    public function change($id){
        $insurer = Insurer::findOrFail($id);
        $insurer->active = !$insurer->active;
        $insurer->save();
        return Redirect::route('admin.insurers');
    }

    public function search(Request $request){
        $query = $request->input('query');
        $insurers = Insurer::where('name', 'like', "%$query%")->get();
        return view('admin.search_insurers', compact('insurers'));
    }
}
