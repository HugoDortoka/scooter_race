<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Competitor;
use App\Models\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

// para los pdf
use Barryvdh\DomPDF\Facade\Pdf;

// para el QR
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class RegistrationController extends Controller
{
    public function showParticipants($courseId){

        $participants = Registration::where('course_id', $courseId)->get();

        // Obtener los IDs de los competidores de los registros
        $competitorIds = $participants->pluck('competitor_id')->toArray();

        // Obtener los competidores correspondientes a los IDs obtenidos
        $competitors = Competitor::whereIn('id', $competitorIds)->get();
        $course = Course::insurerById($courseId);


        return view('admin.viewParticipants', compact('participants', 'competitors', 'course'));
        
    }

    public function pdf($courseId){
        
        $participants = Registration::where('course_id', $courseId)->get();

        // Obtener los IDs de los competidores de los registros
        $competitorIds = $participants->pluck('competitor_id')->toArray();

        // Obtener los competidores correspondientes a los IDs obtenidos
        $competitors = Competitor::whereIn('id', $competitorIds)->get();

    
        $pdf = Pdf::loadView('admin.pdfParticipants', compact('participants', 'competitors'));
        return $pdf->stream();
    }
    
    public function pdfIndividual($courseId, $competitorId){
        // Obtener los participantes para el curso y el competidor específico
        $participants = Registration::where('course_id', $courseId)
                                    ->where('competitor_id', $competitorId)
                                    ->get();
    
        // Obtener los datos del competidor correspondiente al ID proporcionado
        $competitor = Competitor::find($competitorId);
    
        // Cargar la vista PDF y pasar los datos del participante y del competidor
        $pdf = Pdf::loadView('admin.pdfParticipant', compact('participants', 'competitor'));
    
        // Devolver el PDF como stream
        return $pdf->stream();
    }
    
    public function showQR($competitorId)
    {
        // Número del dorsal
        $dorsalNumber = $competitorId;
    
        // Crear un objeto QrCode
        $qrCode = new QrCode($dorsalNumber);
        $qrCode->setSize(400); // Tamaño del código QR (en este caso, 400x400 píxeles)
    
        // Renderizar el código QR en un objeto PngResult
        $pngWriter = new PngWriter();
        $qrCodeResult = $pngWriter->write($qrCode);
    
        // Obtener el URI de datos de la imagen PNG
        $dataUri = $qrCodeResult->getDataUri();
    
        return view('admin.qr', ['qrCodeImage' => $dataUri]);
    }
}
