<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;
    protected $fillable = [
        'course_id', 'photo_url'
    ];
    
    public static function viewAllPhotos()
    {
        return self::all();
    }
    public static function insurerById($id)
    {
        return self::findOrFail($id);
    }
}
