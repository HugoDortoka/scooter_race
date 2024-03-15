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
        $carpeta_server = 'img/photos_courses/';
        $photo_urls = json_decode($request->input('photo_urls'));

        // Guardar las URLs de las imágenes en la base de datos
        foreach ($photo_urls as $url) {
            $photo = new Photo();
            $photo->course_id = $course_id;
            $nombreArchivo = basename($url);
            $nombreFinal = $carpeta_server . $nombreArchivo;
            $photo->photo_url = $nombreFinal;
            $photo->save();
            rename($carpeta_origen . $nombreArchivo, $carpeta_destino . $nombreArchivo);
        }
        $archivos = glob($carpeta_origen . '*');
        foreach ($archivos as $archivo) {
            $file_info = finfo_open(FILEINFO_MIME_TYPE);
            $mime_type = finfo_file($file_info, $archivo);
            finfo_close($file_info);
            if (strpos($mime_type, 'image') !== false) {
                unlink($archivo);
            }
        }
        // Redirigir a donde sea necesario después de guardar las imágenes
        return Redirect::route('admin.home');
    }
}
