<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Photo;
use App\Models\Registration;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

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
        return view('admin.courseShow', compact('course'));
    }
    public function showAdd()
    {
        if (Session::get('admin') !== 'admin') {
            return Redirect::route('admin.login');
        }
        return view('admin.courseAdd');
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

        return view('races', compact('recents', 'difficulties'));
    }
    
    public function allraces(){
        $courses = Course::where('active', 1)->get();
        return view('user.all_races', compact('courses'));
    }


    public function home(){
        $courses = Course::take(8)->get();
        return view('index', compact('courses'));
    }

    public function infoRace($id)
    {

        try {
            // Buscar fotos por el ID del curso
            $photos = Photo::where('course_id', $id)->get();
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $photos = null; // O cualquier otro valor por defecto que desees asignar
        }
        $user = Session::get('user');
        $course = Course::insurerById($id);
        $registration = Registration::where('course_id', $id)->get();
        return view('user.infoRace', compact('course', 'photos', 'user', 'registration'));
    }

    
    public function register($id){
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
 
    
            $registration->save(); // Guardar el registro en la base de datos
    
            try {
                // Buscar fotos por el ID del curso
                $photos = Photo::where('course_id', $id)->get();
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                $photos = null; // O cualquier otro valor por defecto que desees asignar
            }
            
            $course = Course::insurerById($id);
            $registration = Registration::where('course_id', $id)->get();
            return view('user.infoRace', compact('course', 'photos', 'user', 'registration'));
        }
        else {
            return "El usuario no está autenticado"; // Puedes manejar el caso donde el usuario no está autenticado
        }
        
    }
}
