<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Registration extends Model
{
    use HasFactory;

    public static function myRegisters($idUser){
        // Fetch registrations associated with the provided user ID
        $registrations = Registration::where('competitor_id', $idUser)->get();
    
        // Extract course IDs from registrations
        $courseIds = $registrations->pluck('course_id')->unique()->toArray();
    
        // Fetch courses corresponding to the extracted course IDs
        $courses = Course::whereIn('id', $courseIds)->get();
    
        return $courses;
    }
    

}
