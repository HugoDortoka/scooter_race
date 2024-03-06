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

    public function create()
    {
        return view('admin.createInsurer');
    }

    public function store(Request $request)
    {
        // Valida y guarda los datos de la nueva aseguradora
    }

    public function edit(Insurer $insurers)
    {
        return view('admin.editInsurer', compact('insurers'));
    }

    public function update(Request $request, Insurer $insurers)
    {
        // Valida y actualiza los datos de la aseguradora
    }

    public function destroy(Insurer $insurers)
    {
        // Desactiva la aseguradora (en lugar de borrarla completamente)
    }
}
