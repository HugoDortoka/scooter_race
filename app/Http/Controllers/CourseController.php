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
use App\Models\Company;
use App\Models\Membership;

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
        $course->max_participants = $request->input('max_participants');
        $course->distance_km = $request->input('distance_km');
        $course->date = $request->input('date');
        $course->time = $request->input('time');
        $course->location = $request->input('location');
        $course->sponsorship_cost = $request->input('sponsorship_cost');
        $course->registration_price = $request->input('registration_price');
        $repeat = Course::where('name', $course->name)->get();
        if ($repeat->count() > 0) {
            // The course is already on the BBDD
        }else{
            $mapImage = $request->file('map_image');
            $mapImageExtension = $mapImage->getClientOriginalExtension();
            $mapImageName = time() . '_' . $request->input('name') . '.' . $mapImageExtension;
            $mapImage->move(public_path('img/map_images'), $mapImageName);
            $mapImagePath = 'img/map_images/' . $mapImageName;
            $course->map_image = $mapImagePath;
            $promotionPoster = $request->file('promotion_poster');
            $promotionPosterExtension = $promotionPoster->getClientOriginalExtension();
            $promotionPosterName = time() . '_' . $request->input('name') . '.' . $promotionPosterExtension;
            $promotionPoster->move(public_path('img/promotion_posters'), $promotionPosterName);
            $promotionPosterPath = 'img/promotion_posters/' . $promotionPosterName;
            $course->promotion_poster = $promotionPosterPath;
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
        $recents = Course::recentCourses();

        $difficulties = Course::difficultCourses();

        $sponsorsPrincipal = Sponsor::principal();
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

    public function win(){
        $user = Session::get('user');
        Competitor::where('id', $user->id)
            ->update(['discount' => 1]);
        $user2 = Competitor::findOrFail($user->id);
        Session::put('user', $user2);
        return Redirect::route('user.home');
    }
    public function lose(){
        $user = Session::get('user');
        Competitor::where('id', $user->id)
            ->update(['discount' => 2]);
        $user2 = Competitor::findOrFail($user->id);
        Session::put('user', $user2);
        return Redirect::route('user.home');
        
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
            $membership = Membership::discount($user->id);
            return view('user.infoRace', compact('course', 'photos', 'user', 'registration','insurers', 'sponsorsPrincipal', 'sponsorsCourse', 'registrationCount', 'membership'));
        }else {
            $user = null;
            return view('user.infoRace', compact('course', 'photos', 'user', 'registration','insurers', 'sponsorsPrincipal', 'sponsorsCourse', 'registrationCount'));
        }
       
    }

    
    public function register(Request $request, $id){
        if (Session::has('user')) {
            $user = Session::get('user');
            Competitor::where('id', $user->id) ->update(['discount' => 2]);
            $user2 = Competitor::findOrFail($user->id);
            Session::put('user', $user2);
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
            $register = new Registration();
            $register->competitor_id = $user->id; // Asignar el ID del usuario como competitor_id
            $register->course_id = $id; // Asignar el ID del curso proporcionado como course_id
            $register->insurer_id = $insurerId; 
            $register->dorsal_number = $dorsalNumber; // Suponiendo que tienes una función para generar un dorsal único
            $repeat = Registration::repeat($register->competitor_id, $register->course_id);
            $course = Course::insurerById($id);
            $insurerPrice = Insurer::where('id', $insurerId)->first();
            $price = $course->registration_price + $insurerPrice->price_per_course;
            if ($repeat->count() > 0) {
                // The registration is already on the BBDD
            }else{
                $register->save(); // Guardar el registro en la base de datos
                $company = Company::ourCompany();
                $pdfPath = public_path('pdf/Inscription.pdf');
                $pdf = Pdf::loadView('user.pdfInscription', compact('course', 'price', 'company'));
                $pdf->save($pdfPath);
            }
            try {
                // Buscar fotos por el ID del curso
                $photos = Photo::where('course_id', $id)->get();
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                $photos = null; // O cualquier otro valor por defecto que desees asignar
            }
            
            $registration = Registration::where('course_id', $id)->get();
            $registrationCount = Registration::where('course_id', $id)->count();
            
            $insurers_id = Courses_insurer::where('course_id', $id)->pluck('insurer_id');
            $insurers = Insurer::whereIn('id', $insurers_id)->get();
            
            $sponsorsPrincipal = Sponsor::where('principal', 1)->get();
            $sponsorsId = Courses_sponsor::where('course_id', $id)->pluck('sponsor_id');
            $sponsorsCourse = Sponsor::whereIn('id', $sponsorsId)->get();
            
            if (isset($pdfPath)) {
                if (Session::has('user')) {
                    $user = Session::get('user');          
                    return view('user.infoRace', compact('course', 'photos', 'user', 'registration','insurers', 'sponsorsPrincipal', 'sponsorsCourse', 'registrationCount', 'pdfPath'));
                }else {
                    $user = null;
                    return view('user.infoRace', compact('course', 'photos', 'user', 'registration','insurers', 'sponsorsPrincipal', 'sponsorsCourse', 'registrationCount', 'pdfPath'));
                }
            }else{
                if (Session::has('user')) {
                    $user = Session::get('user');          
                    return view('user.infoRace', compact('course', 'photos', 'user', 'registration','insurers', 'sponsorsPrincipal', 'sponsorsCourse', 'registrationCount'));
                }else {
                    $user = null;
                    return view('user.infoRace', compact('course', 'photos', 'user', 'registration','insurers', 'sponsorsPrincipal', 'sponsorsCourse', 'registrationCount'));
                }
            }
        }
        else {
            return "El usuario no está autenticado"; // Puedes manejar el caso donde el usuario no está autenticado
        }
        
    }
    public function register2($id){
        if (Session::has('user')) {
            $user = Session::get('user');
            Competitor::where('id', $user->id) ->update(['discount' => 2]);
            $user2 = Competitor::findOrFail($user->id);
            Session::put('user', $user2);
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
            $register = new Registration();
            $register->competitor_id = $user->id; // Asignar el ID del usuario como competitor_id
            $register->course_id = $id; // Asignar el ID del curso proporcionado como course_id
            $register->dorsal_number = $dorsalNumber; // Suponiendo que tienes una función para generar un dorsal único
            $repeat = Registration::repeat($register->competitor_id, $register->course_id);
            $course = Course::insurerById($id);
            $price = $course->registration_price;
            if ($repeat->count() > 0) {
                // The registration is already on the BBDD
            }else{
                $register->save(); // Guardar el registro en la base de datos
                $company = Company::ourCompany();
                $pdfPath = public_path('pdf/Inscription.pdf');
                $pdf = Pdf::loadView('user.pdfInscription', compact('course', 'price', 'company'));
                $pdf->save($pdfPath);
            }
            try {
                // Buscar fotos por el ID del curso
                $photos = Photo::where('course_id', $id)->get();
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                $photos = null; // O cualquier otro valor por defecto que desees asignar
            }
           
            // try{
            //     $register->save(); // Guardar el registro en la base de datos
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
            
            if (isset($pdfPath)) {
                if (Session::has('user')) {
                    $user = Session::get('user');         
                    return view('user.infoRace', compact('course', 'photos', 'user', 'registration','insurers', 'sponsorsPrincipal', 'sponsorsCourse', 'registrationCount', 'pdfPath'));
                }else {
                    $user = null;
                    return view('user.infoRace', compact('course', 'photos', 'user', 'registration','insurers', 'sponsorsPrincipal', 'sponsorsCourse', 'registrationCount', 'pdfPath'));
                }
            }else{
                if (Session::has('user')) {
                    $user = Session::get('user');         
                    return view('user.infoRace', compact('course', 'photos', 'user', 'registration','insurers', 'sponsorsPrincipal', 'sponsorsCourse', 'registrationCount'));
                }else {
                    $user = null;
                    return view('user.infoRace', compact('course', 'photos', 'user', 'registration','insurers', 'sponsorsPrincipal', 'sponsorsCourse', 'registrationCount'));
                }
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
        $repeat = Competitor::checkDNI($dni);
        if ($repeat !== null) {
            // The competitor is already on the BBDD
        }else{
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
        }

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
        $register = new Registration();
        $register->competitor_id = $competitor->id; // Asignar el ID del usuario como competitor_id
        $register->course_id = $id; // Asignar el ID del curso proporcionado como course_id
        $register->insurer_id = $insurerId; 
        $register->dorsal_number = $dorsalNumber; // Suponiendo que tienes una función para generar un dorsal único
        $repeat = Registration::repeat($register->competitor_id, $register->course_id);
        $course = Course::insurerById($id);
        $insurerPrice = Insurer::where('id', $insurerId)->first();
        $price = $course->registration_price + $insurerPrice->price_per_course;
        if ($repeat->count() > 0) {
            // The registration is already on the BBDD
        }else{
            $register->save();
            $company = Company::ourCompany();
            $pdfPath = public_path('pdf/Inscription.pdf');
            $pdf = Pdf::loadView('user.pdfInscription', compact('course', 'price', 'company'));
            $pdf->save($pdfPath);
        }
        try {
            // Buscar fotos por el ID del curso
            $photos = Photo::where('course_id', $id)->get();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $photos = null; // O cualquier otro valor por defecto que desees asignar
        }
        
        $registration = Registration::where('course_id', $id)->get();
        $registrationCount = Registration::where('course_id', $id)->count();

        $insurers_id = Courses_insurer::where('course_id', $id)->pluck('insurer_id');
        $insurers = Insurer::whereIn('id', $insurers_id)->get();
        $user = null;
        $sponsorsPrincipal = Sponsor::where('principal', 1)->get();
        
        $sponsorsId = Courses_sponsor::where('course_id', $id)->pluck('sponsor_id');
        $sponsorsCourse = Sponsor::whereIn('id', $sponsorsId)->get();
        
        if (isset($pdfPath)){
            return view('user.infoRace', compact('course', 'photos', 'user', 'registration','insurers', 'sponsorsPrincipal', 'sponsorsCourse', 'registrationCount', 'pdfPath'));
        }else{
            return view('user.infoRace', compact('course', 'photos', 'user', 'registration','insurers', 'sponsorsPrincipal', 'sponsorsCourse', 'registrationCount'));
        }    
    }

    public function dropOut($idCourse){
        $user = Session::get('user');        
        Registration::where('course_id', $idCourse)
                    ->where('competitor_id', $user->id)
                    ->delete();
        return redirect()->route('user.home');
    }

}
