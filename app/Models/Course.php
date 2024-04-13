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
}
