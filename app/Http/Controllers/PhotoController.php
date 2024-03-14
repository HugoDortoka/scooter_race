<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PhotoController extends Controller
{
    public function addUploadPhotos(Request $request, $course_id){
        $carpeta_origen = public_path('img/photos_temporarily/');
        $carpeta_destino = public_path('img/photos_courses/');
        $photo_urls = json_decode($request->input('photo_urls'));

        // Guardar las URLs de las imágenes en la base de datos
        foreach ($photo_urls as $url) {
            $photo = new Photo();
            $photo->course_id = $course_id;
            $nombreArchivo = basename($url);
            $nombreFinal = $carpeta_destino . $nombreArchivo;
            $photo->photo_url = $nombreFinal;
            $photo->save();
            rename($carpeta_origen . $nombreArchivo, $carpeta_destino . $nombreArchivo);
        }
        $archivos = glob($carpeta_origen . '*');
        foreach ($archivos as $archivo) {
            if (exif_imagetype($archivo)) {
                unlink($archivo);
            }
        }
        // Redirigir a donde sea necesario después de guardar las imágenes
        return Redirect::route('admin.home');
    }
}
