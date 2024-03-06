<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insurer extends Model
{
    use HasFactory;
    protected $fillable = [
        'CIF', 'name', 'address', 'price_per_course', 'active'
    ];
    
    public static function viewAllInsurers()
    {
        return self::all();
    }
    public static function insurerById($id)
    {
        return self::findOrFail($id);
    }

}
