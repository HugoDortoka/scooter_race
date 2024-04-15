<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'elevation', 'map_image', 'max_participants', 'distance_km', 'date', 'time', 'location', 'promotion_poster', 'sponsorship_cost', 'registration_price', 'active'
    ];
    
    public static function viewAllCourses()
    {
        return self::all();
    }
    public static function insurerById($id)
    {
        return self::findOrFail($id);
    }

    public static  function updatePointed($idCourse){
        Course::where('id', $idCourse)
                ->update(['pointed' => 1]);
    }

    public static  function recentCourses(){
        $recents = Course::where('active', 1)
                ->orderBy('date', 'desc')
                ->orderBy('time', 'asc')
                ->get();
        return $recents;
    }

    public static  function difficultCourses(){
        $difficulties = Course::where('active', 1)
                ->orderBy('elevation', 'desc')
                ->take(3)
                ->get();
        return $difficulties;
    }
}
