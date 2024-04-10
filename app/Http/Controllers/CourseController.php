<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Sponsor;
use App\Models\Photo;
use App\Models\Registration;
use App\Models\Insurer;
use App\Models\Competitor;
use App\Models\Courses_sponsor;
use App\Models\Courses_insurer;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;

class CourseController extends Controller
{
    //ADMIN
    public function index()
    {
        if (Session::get('admin') !== 'admin') {
            return Redirect::route('admin.login');
        }
        $courses = Course::all();
        return view('admin.home', compact('courses'));
    }
    public function show($id)
    {
        if (Session::get('admin') !== 'admin') {
            return Redirect::route('admin.login');
        }
        $course = Course::insurerById($id);
        $sponsors = Sponsor::all();
        $insurers = Insurer::all();
        $sponsorsId = Courses_sponsor::where('course_id', $id)->pluck('sponsor_id');
        $sponsorsCourse = Sponsor::whereIn('id', $sponsorsId)->get();
        $insurersId = Courses_insurer::where('course_id', $id)->pluck('insurer_id');
        $insurersCourse = Insurer::whereIn('id', $insurersId)->get();
        return view('admin.courseShow', compact('course', 'sponsors', 'insurers', 'sponsorsCourse', 'insurersCourse'));
    }
    public function showAdd()
    {
        if (Session::get('admin') !== 'admin') {
            return Redirect::route('admin.login');
        }
        $sponsors = Sponsor::all();
        $insurers = Insurer::all();
        return view('admin.courseAdd', compact('sponsors', 'insurers'));
    }
    public function add(Request $request)
    {
        $course = new Course();
        $course->name = $request->input('name');
        $course->description = $request->input('description');
        $course->elevation = $request->input('elevation');
        $mapImage = $request->file('map_image');
        $mapImageExtension = $mapImage->getClientOriginalExtension();
        $mapImageName = time() . '_' . $request->input('name') . '.' . $mapImageExtension;
        $mapImage->move(public_path('img/map_images'), $mapImageName);
        $mapImagePath = 'img/map_images/' . $mapImageName;
        $course->map_image = $mapImagePath;
        $course->max_participants = $request->input('max_participants');
        $course->distance_km = $request->input('distance_km');
        $course->date = $request->input('date');
        $course->time = $request->input('time');
        $course->location = $request->input('location');
        $promotionPoster = $request->file('promotion_poster');
        $promotionPosterExtension = $promotionPoster->getClientOriginalExtension();
        $promotionPosterName = time() . '_' . $request->input('name') . '.' . $promotionPosterExtension;
        $promotionPoster->move(public_path('img/promotion_posters'), $promotionPosterName);
        $promotionPosterPath = 'img/promotion_posters/' . $promotionPosterName;
        $course->promotion_poster = $promotionPosterPath;
        $course->sponsorship_cost = $request->input('sponsorship_cost');
        $course->registration_price = $request->input('registration_price');
        $course->save();

        $courseId = $course->id;

        if (!empty($request->input('sponsors', []))) {
            $sponsorsSelected = $request->input('sponsors', []);
            foreach ($sponsorsSelected as $sponsorId) {
                $courseSponsor = new Courses_sponsor();
                $courseSponsor->course_id = $courseId;
                $courseSponsor->sponsor_id = $sponsorId;
                $courseSponsor->save();
            }
        }

        if (!empty($request->input('insurers', []))) {
            $insurersSelected = $request->input('insurers', []);
            foreach ($insurersSelected as $insurerId) {
                $courseInsurer = new Courses_insurer();
                $courseInsurer->course_id = $courseId;
                $courseInsurer->insurer_id = $insurerId;
                $courseInsurer->save();
            }
        }
        return Redirect::route('admin.home');
    }
    

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $dataToUpdate = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'elevation' => $request->input('elevation'),
            'max_participants' => $request->input('max_participants'),
            'distance_km' => $request->input('distance_km'),
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'location' => $request->input('location'),
            'sponsorship_cost' => $request->input('sponsorship_cost'),
            'registration_price' => $request->input('registration_price')
        ];

        if ($request->hasFile('map_image')) {
            unlink(public_path($course->map_image));
            $map_image = $request->file('map_image');
            $map_imageExtension = $map_image->getClientOriginalExtension();
            $map_imageName = time() . '_' . $request->input('name') . '.' . $map_imageExtension;
            $map_image->move(public_path('img/map_images'), $map_imageName);
            $map_imagePath = 'img/map_images/' . $map_imageName;
            $dataToUpdate['map_image'] = $map_imagePath;
        }

        if ($request->hasFile('promotion_poster')) {
            unlink(public_path($course->promotion_poster));
            $promotion_poster = $request->file('promotion_poster');
            $promotion_posterExtension = $promotion_poster->getClientOriginalExtension();
            $promotion_posterName = time() . '_' . $request->input('name') . '.' . $promotion_posterExtension;
            $promotion_poster->move(public_path('img/promotion_posters'), $promotion_posterName);
            $promotion_posterPath = 'img/promotion_posters/' . $promotion_posterName;
            $dataToUpdate['promotion_poster'] = $promotion_posterPath;
        }

        $course->update($dataToUpdate);

        $courseId = $course->id;
        $sponsorsSelected = $request->input('sponsors', []);
        $oldSponsorsIds = Courses_sponsor::where('course_id', $courseId)->pluck('sponsor_id')->toArray();
        $insurersSelected = $request->input('insurers', []);
        $oldInsurersIds = Courses_insurer::where('course_id', $courseId)->pluck('insurer_id')->toArray();

        // Insertar nuevos sponsors seleccionados
        foreach ($sponsorsSelected as $sponsorId) {
            if (!in_array($sponsorId, $oldSponsorsIds)) {
                // Insertar solo si el sponsor no estaba asociado antes
                $courseSponsor = new Courses_sponsor();
                $courseSponsor->course_id = $courseId;
                $courseSponsor->sponsor_id = $sponsorId;
                $courseSponsor->save();
            }
        }

        // Eliminar sponsors deseleccionados
        foreach ($oldSponsorsIds as $oldSponsorId) {
            if (!in_array($oldSponsorId, $sponsorsSelected)) {
                // Eliminar solo si el sponsor estaba asociado antes
                Courses_sponsor::where('course_id', $courseId)
                     ->where('sponsor_id', $oldSponsorId)
                     ->delete();
            }
        }

        // Insertar nuevos insurers seleccionados
        foreach ($insurersSelected as $insurerId) {
            if (!in_array($insurerId, $oldInsurersIds)) {
                // Insertar solo si el sponsor no estaba asociado antes
                $courseInsurer = new Courses_insurer();
                $courseInsurer->course_id = $courseId;
                $courseInsurer->insurer_id = $insurerId;
                $courseInsurer->save();
            }
        }

        // Eliminar insurers deseleccionados
        foreach ($oldInsurersIds as $oldInsurerId) {
            if (!in_array($oldInsurerId, $insurersSelected)) {
                // Eliminar solo si el sponsor estaba asociado antes
                Courses_insurer::where('course_id', $courseId)
                     ->where('insurer_id', $oldInsurerId)
                     ->delete();
            }
        }
        return Redirect::route('admin.home');
    }

    public function change($id){
        $course = Course::findOrFail($id);
        $course->active = !$course->active;
        $course->save();
        return Redirect::route('admin.home');
    }

    public function search(Request $request){
        $query = $request->input('query');
        $courses = Course::where('name', 'like', "%$query%")->get();
        return view('admin.search_courses', compact('courses'));
    }

    public function uploadPhotos($id){
        if (Session::get('admin') !== 'admin') {
            return Redirect::route('admin.login');
        }
        $course = Course::findOrFail($id);
        return view('admin.courseUploadPhotos', compact('course'));
    }

    public function saveUploadPhotosTemporarily(Request $request){
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Construir el nombre de archivo único
            $imageName = time() . '_' . $image->getClientOriginalName();

            // Mover el archivo a la carpeta deseada
            $image->move(public_path('img/photos_temporarily'), $imageName);

            // Devolver la ruta de la imagen almacenada para su posterior uso si es necesario
            return response()->json(['path' => 'img/photos_temporarily/' . $imageName], 200);
        } else {
            // Si no se proporciona ningún archivo, devolver un error
            return response()->json(['message' => 'No se proporcionó ninguna imagen'], 400);
        }
    }
    //USER
    public function races(){
        $recents = Course::where('active', 1)
                ->orderBy('date', 'desc')
                ->orderBy('time', 'asc')
                ->get();

        $difficulties = Course::where('active', 1)
                ->orderBy('elevation', 'desc')
                ->take(3)
                ->get();

        $sponsorsPrincipal = Sponsor::where('principal', 1)->get();
        return view('races', compact('recents', 'difficulties', 'sponsorsPrincipal'));
    }
    
    public function allraces(){
        $courses = Course::where('active', 1)->get();
        $sponsorsPrincipal = Sponsor::where('principal', 1)->get();
        return view('user.all_races', compact('courses', 'sponsorsPrincipal'));
    }


    public function home(){
        $now = Carbon::now();

        $courses = Course::where('active', 1)
            ->whereDate('date', '>=', $now->toDateString())
            ->orderBy('date', 'asc')
            ->orderBy('time', 'asc')
            ->take(8)
            ->get();
        $sponsorsPrincipal = Sponsor::where('principal', 1)->get();
        if (Session::has('user')) {
            $user = Session::get('user');
            $myRegistrations = Registration::myRegisters($user->id);
            return view('index', compact('courses', 'sponsorsPrincipal', 'myRegistrations', 'user'));    
        }
        else{
            $user = null;
            return view('index', compact('courses', 'sponsorsPrincipal', 'user'));    
        }
        
    }
    public function puzzle(){
        return view('user.puzzle');
    }

    public function infoRace($id)
    {

        try {
            // Buscar fotos por el ID del curso
            $photos = Photo::where('course_id', $id)->get();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $photos = null; // O cualquier otro valor por defecto que desees asignar
        }
        $course = Course::insurerById($id);
        $registration = Registration::where('course_id', $id)->get();
        $registrationCount = Registration::where('course_id', $id)->count();

        $insurers_id = Courses_insurer::where('course_id', $id)->pluck('insurer_id');
        $insurers = Insurer::whereIn('id', $insurers_id)->get();

        $sponsorsPrincipal = Sponsor::where('principal', 1)->get();

        $sponsorsId = Courses_sponsor::where('course_id', $id)->pluck('sponsor_id');
        $sponsorsCourse = Sponsor::whereIn('id', $sponsorsId)->get();


        if (Session::has('user')) {
            $user = Session::get('user');
           
            return view('user.infoRace', compact('course', 'photos', 'user', 'registration','insurers', 'sponsorsPrincipal', 'sponsorsCourse', 'registrationCount'));
        }else {
            $user = null;
            return view('user.infoRace', compact('course', 'photos', 'user', 'registration','insurers', 'sponsorsPrincipal', 'sponsorsCourse', 'registrationCount'));
        }
       
    }

    
    public function register(Request $request, $id){
        if (Session::has('user')) {
            $user = Session::get('user');
            $insurerId = $request->input('insurerId');
            //Generar dorsal
            $dorsalNumber = mt_rand(1000, 9999); // Generar un número aleatorio de 4 dígitos
    
            // Verificar si el número de dorsal generado ya existe en el mismo curso
            $existingDorsal = Registration::where('course_id', $id)
                                            ->where('dorsal_number', $dorsalNumber)
                                            ->exists();
        
            // Si el número de dorsal generado ya existe para el mismo curso, generamos uno nuevo hasta que obtengamos uno único
            while ($existingDorsal) {
                $dorsalNumber = mt_rand(1000, 9999); // Generar un nuevo número aleatorio de 4 dígitos
                $existingDorsal = Registration::where('course_id', $id)
                                                ->where('dorsal_number', $dorsalNumber)
                                                ->exists();
            }
            // Crear una nueva instancia de Registration
            $registration = new Registration();
            $registration->competitor_id = $user->id; // Asignar el ID del usuario como competitor_id
            $registration->course_id = $id; // Asignar el ID del curso proporcionado como course_id
            $registration->insurer_id = $insurerId; 
            $registration->dorsal_number = $dorsalNumber; // Suponiendo que tienes una función para generar un dorsal único
 
    
            $registration->save(); // Guardar el registro en la base de datos
    
            try {
                // Buscar fotos por el ID del curso
                $photos = Photo::where('course_id', $id)->get();
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                $photos = null; // O cualquier otro valor por defecto que desees asignar
            }
            
            $course = Course::insurerById($id);
            $registration = Registration::where('course_id', $id)->get();
            $registrationCount = Registration::where('course_id', $id)->count();
            
            $insurers_id = Courses_insurer::where('course_id', $id)->pluck('insurer_id');
            $insurers = Insurer::whereIn('id', $insurers_id)->get();
            
            $sponsorsPrincipal = Sponsor::where('principal', 1)->get();
            $sponsorsId = Courses_sponsor::where('course_id', $id)->pluck('sponsor_id');
            $sponsorsCourse = Sponsor::whereIn('id', $sponsorsId)->get();
            $insurerPrice = Insurer::where('id', $insurerId)->first();
            $price = $course->registration_price + $insurerPrice->price_per_course;
            $pdfPath = public_path('pdf/Inscription.pdf');
            if (Session::has('user')) {
                $user = Session::get('user');          
                $pdf = Pdf::loadView('user.pdfInscription', compact('course', 'price'));
                $pdf->save($pdfPath);
                return view('user.infoRace', compact('course', 'photos', 'user', 'registration','insurers', 'sponsorsPrincipal', 'sponsorsCourse', 'registrationCount', 'pdfPath'));
            }else {
                $user = null;
                $pdf = Pdf::loadView('user.pdfInscription', compact('course', 'price'));
                $pdf->save($pdfPath);
                return view('user.infoRace', compact('course', 'photos', 'user', 'registration','insurers', 'sponsorsPrincipal', 'sponsorsCourse', 'registrationCount', 'pdfPath'));
            }
        }
        else {
            return "El usuario no está autenticado"; // Puedes manejar el caso donde el usuario no está autenticado
        }
        
    }
    public function register2($id){
        if (Session::has('user')) {
            $user = Session::get('user');
            //Generar dorsal
            $dorsalNumber = mt_rand(1000, 9999); // Generar un número aleatorio de 4 dígitos
    
            // Verificar si el número de dorsal generado ya existe en el mismo curso
            $existingDorsal = Registration::where('course_id', $id)
                                            ->where('dorsal_number', $dorsalNumber)
                                            ->exists();
        
            // Si el número de dorsal generado ya existe para el mismo curso, generamos uno nuevo hasta que obtengamos uno único
            while ($existingDorsal) {
                $dorsalNumber = mt_rand(1000, 9999); // Generar un nuevo número aleatorio de 4 dígitos
                $existingDorsal = Registration::where('course_id', $id)
                                                ->where('dorsal_number', $dorsalNumber)
                                                ->exists();
            }
            // Crear una nueva instancia de Registration
            $registration = new Registration();
            $registration->competitor_id = $user->id; // Asignar el ID del usuario como competitor_id
            $registration->course_id = $id; // Asignar el ID del curso proporcionado como course_id
            $registration->dorsal_number = $dorsalNumber; // Suponiendo que tienes una función para generar un dorsal único
            $registration->save();

            $course = Course::insurerById($id);
            try {
                // Buscar fotos por el ID del curso
                $photos = Photo::where('course_id', $id)->get();
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                $photos = null; // O cualquier otro valor por defecto que desees asignar
            }
           
            // try{
            //     $registration->save(); // Guardar el registro en la base de datos
            // } catch (\Exception $e) {
            //     $registration = Registration::where('course_id', $id)->get();
            //     return Redirect::route('user.infoRace', compact('course', 'photos', 'user', 'registration'));
            // }
            $insurers = Insurer::all();
            $registration = Registration::where('course_id', $id)->get();
            $registrationCount = Registration::where('course_id', $id)->count();

            $sponsorsPrincipal = Sponsor::where('principal', 1)->get();
            
            $sponsorsId = Courses_sponsor::where('course_id', $id)->pluck('sponsor_id');
            $sponsorsCourse = Sponsor::whereIn('id', $sponsorsId)->get();
            $price = $course->registration_price;
            $pdfPath = public_path('pdf/Inscription.pdf');
            if (Session::has('user')) {
                $user = Session::get('user'); 
                $pdf = Pdf::loadView('user.pdfInscription', compact('course', 'price'));
                $pdf->save($pdfPath);          
                return view('user.infoRace', compact('course', 'photos', 'user', 'registration','insurers', 'sponsorsPrincipal', 'sponsorsCourse', 'registrationCount', 'pdfPath'));
            }else {
                $user = null;
                $pdf = Pdf::loadView('user.pdfInscription', compact('course', 'price'));
                $pdf->save($pdfPath);
                return view('user.infoRace', compact('course', 'photos', 'user', 'registration','insurers', 'sponsorsPrincipal', 'sponsorsCourse', 'registrationCount', 'pdfPath'));
            }
        }
        else {
            return "El usuario no está autenticado"; // Puedes manejar el caso donde el usuario no está autenticado
        }
        
    }
      
    public function register3(Request $request, $id){
        
        $dni = $request->input('dni');
        $name = $request->input('name');
        $surname = $request->input('surname');
        $address = $request->input('address');
        $birth = $request->input('birth');
        $PRO_OPEN = $request->input('PRO_OPEN');
        if($PRO_OPEN == "OPEN"){
            $PRO_OPEN = false;
        }else{
            $PRO_OPEN = true;
        }
        if ($request->has('federation')){
            $federation = $request->input('federation');
        }else{
            $federation = null;
        }
        $password = null;

        Competitor::create([
            'DNI' => $dni,
            'name' => $name,
            'surname' => $surname,
            'address' => $address,
            'date_of_birth' => $birth,
            'PRO' => $PRO_OPEN,
            'federation_number' => $federation,
            'password' => $password,
        ]);

        $competitor = Competitor::where('dni', $dni)->first();
        $insurerId = $request->input('insurerId');
            //Generar dorsal
            $dorsalNumber = mt_rand(1000, 9999); // Generar un número aleatorio de 4 dígitos
    
            // Verificar si el número de dorsal generado ya existe en el mismo curso
            $existingDorsal = Registration::where('course_id', $id)
                                            ->where('dorsal_number', $dorsalNumber)
                                            ->exists();
        
            // Si el número de dorsal generado ya existe para el mismo curso, generamos uno nuevo hasta que obtengamos uno único
            while ($existingDorsal) {
                $dorsalNumber = mt_rand(1000, 9999); // Generar un nuevo número aleatorio de 4 dígitos
                $existingDorsal = Registration::where('course_id', $id)
                                                ->where('dorsal_number', $dorsalNumber)
                                                ->exists();
            }
            // Crear una nueva instancia de Registration
            $registration = new Registration();
            $registration->competitor_id = $competitor->id; // Asignar el ID del usuario como competitor_id
            $registration->course_id = $id; // Asignar el ID del curso proporcionado como course_id
            $registration->insurer_id = $insurerId; 
            $registration->dorsal_number = $dorsalNumber; // Suponiendo que tienes una función para generar un dorsal único
 
    
            $registration->save(); // Guardar el registro en la base de datos
    
            try {
                // Buscar fotos por el ID del curso
                $photos = Photo::where('course_id', $id)->get();
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                $photos = null; // O cualquier otro valor por defecto que desees asignar
            }
            
            $course = Course::insurerById($id);
            $registration = Registration::where('course_id', $id)->get();
            $registrationCount = Registration::where('course_id', $id)->count();

            $insurers_id = Courses_insurer::where('course_id', $id)->pluck('insurer_id');
            $insurers = Insurer::whereIn('id', $insurers_id)->get();
            $user = null;
            $sponsorsPrincipal = Sponsor::where('principal', 1)->get();
            
            $sponsorsId = Courses_sponsor::where('course_id', $id)->pluck('sponsor_id');
            $sponsorsCourse = Sponsor::whereIn('id', $sponsorsId)->get();
            $insurerPrice = Insurer::where('id', $insurerId)->first();
            $price = $course->registration_price + $insurerPrice->price_per_course;
            $pdfPath = public_path('pdf/Inscription.pdf');
            $pdf = Pdf::loadView('user.pdfInscription', compact('course', 'price'));
            $pdf->save($pdfPath);
            return view('user.infoRace', compact('course', 'photos', 'user', 'registration','insurers', 'sponsorsPrincipal', 'sponsorsCourse', 'registrationCount', 'pdfPath'));

    }
    public function dropOut($idCourse){
        $user = Session::get('user');        
        Registration::where('course_id', $idCourse)
                    ->where('competitor_id', $user->id)
                    ->delete();
        return redirect()->route('user.home');
    }

}
