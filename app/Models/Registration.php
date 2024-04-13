<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'dorsal_number',
        'competitor_id',
        'course_id',
        'insurer_id',
        'Finish_Time', // Add Finish_Time to the fillable array
    ];

    public static function myRegisters($idUser){
        // Fetch registrations associated with the provided user ID
        $registrations = Registration::where('competitor_id', $idUser)->get();
    
        // Extract course IDs from registrations
        $courseIds = $registrations->pluck('course_id')->unique()->toArray();
    
        // Fetch courses corresponding to the extracted course IDs
        $courses = Course::whereIn('id', $courseIds)->get();
    
        return $courses;
    }
    public static function dorsalQr($courseId, $competitorId){
        $dorsal = Registration::where('competitor_id', $competitorId)
                               ->where('course_id', $courseId)
                               ->pluck('dorsal_number')
                               ->first();
    
        return $dorsal;
    }
    
    public static function repeat($competitor_id, $course_id){
        $repeat = Registration::where('competitor_id', $competitor_id)
                           ->where('course_id', $course_id)
                           ->get();
        return $repeat;
    }

    public static function participants($course_id){
        $participants = Registration::where('course_id', $course_id)
                                ->orderBy('Finish_Time')
                                ->get();
        return $participants;
    }
}
