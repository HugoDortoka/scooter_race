<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use App\Models\Competitor;
use App\Models\Course;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use Carbon\Carbon;

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
    
    public function showQR($courseId, $competitorId)
    {
        $dorsalUrl = "http://127.0.0.1:8000/finishTime/" . Registration::dorsalQr($courseId, $competitorId) . "/" . $courseId;
        $dorsalNumber = Registration::dorsalQr($courseId, $competitorId);
        // Crear un objeto QrCode
        $qrCode = new QrCode($dorsalUrl);
        $qrCode->setSize(400); 
    
        $pngWriter = new PngWriter();
        $qrCodeResult = $pngWriter->write($qrCode);
    
        $dataUri = $qrCodeResult->getDataUri();

        // Cargar la vista PDF y pasar los datos del participante y del competidor
        $pdf = Pdf::loadView('admin.qr', ['qrCodeImage' => $dataUri, 'dorsalNumber' => $dorsalNumber, 'courseId' => $courseId]);
    
        // Devolver el PDF como stream
        return $pdf->stream();
    }
    public function finishTime($dorsalNumber, $courseId)
    {
        // Find the registration with the given dorsal number and course ID
        $registration = Registration::where('dorsal_number', $dorsalNumber)
                                    ->where('course_id', $courseId)
                                    ->first();

        // If registration found, update Finish_Time with current time
        if ($registration) {
            $registration->update(['Finish_Time' => Carbon::now()]);
        }

        //return redirect()->back()->with('success', 'Finish time updated successfully');
        return view('admin.finishTime');
    }

    public function showQRs($courseId)
    {
        $competitors = Registration::where('course_id', $courseId)->get();

        $qrCodesData = [];
        foreach ($competitors as $competitor) {

            $dorsalUrl = "http://127.0.0.1:8000/finishTime/" . $competitor->dorsal_number . "/" . $courseId;

            $qrCode = new QrCode($dorsalUrl);
            $qrCode->setSize(400); // Tamaño del código QR (en este caso, 400x400 píxeles)
            
            $pngWriter = new PngWriter();
            $qrCodeResult = $pngWriter->write($qrCode);
            
            $dataUri = $qrCodeResult->getDataUri();
            
            $qrCodesData[] = [
                'qrCodeImage' => $dataUri,
                'dorsalNumber' => $competitor->dorsal_number,
                'courseId' => $courseId
            ];
        }

        // Cargar la vista PDF y pasar los datos del participante y del competidor
        $pdf = Pdf::loadView('admin.qrs', ['qrCodesData' => $qrCodesData]);
    
        // Devolver el PDF como stream
        return $pdf->stream();
    }

}
       
    

