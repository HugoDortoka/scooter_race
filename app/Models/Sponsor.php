<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    use HasFactory;

    protected $fillable = [
        'CIF', 'name', 'logo', 'address', 'principal' , 'extra_cost' , 'active'
    ];
    
    public static function viewAllInsurers()
    {
        return self::all();
    }
    public static function insurerById($id)
    {
        return self::findOrFail($id);
    }

    public static  function principal(){
        $sponsorsPrincipal = Sponsor::where('principal', 1)->get();
        return $sponsorsPrincipal;
    }

}
