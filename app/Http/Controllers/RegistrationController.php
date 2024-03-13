<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Competitor;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
class RegistrationController extends Controller
{
    public function showParticipants($courseId){

        $participants = Registration::where('course_id', $courseId)->get();

        // Obtener los IDs de los competidores de los registros
        $competitorIds = $participants->pluck('competitor_id')->toArray();

        // Obtener los competidores correspondientes a los IDs obtenidos
        $competitors = Competitor::whereIn('id', $competitorIds)->get();


        return view('admin.viewParticipants', compact('participants', 'competitors'));

    }
}
