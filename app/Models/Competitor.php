<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Competitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'DNI', 'name', 'surname', 'address', 'date_of_birth', 'PRO', 'federation_number', 'password'
    ];

    // Verify login
    public static function authenticate($dni, $password)
    {
        $user = self::where('DNI', $dni)->first();

        if ($user && password_verify($password, $user->password)) {
            return $user;
        }

        return null;
    }

    public static function checkDNI($dni) {
        $competitor = Competitor::where('dni', $dni)->first();
        return $competitor;
    }

    public static function topGeneral(){
        $competitors = Competitor::orderByDesc('points')->limit(5)->get();
        return $competitors;
    }

    public static function topMale(){
        $competitors = Competitor::where('sex', 'm')
        ->orderByDesc('points')
        ->limit(5)
        ->get();
        return $competitors;
    }

    public static function topFemale(){
        $competitors = Competitor::where('sex', 'f')
        ->orderByDesc('points')
        ->limit(5)
        ->get();
        return $competitors;
    }

    public static function topMaster20(){
        $competitors = Competitor::whereBetween('date_of_birth', [Carbon::now()->subYears(29), Carbon::now()->subYears(20)])
        ->orderByDesc('points')
        ->limit(5)
        ->get();
        return $competitors;
    }

    public static function topMaster30(){
        $competitors = Competitor::whereBetween('date_of_birth', [Carbon::now()->subYears(39), Carbon::now()->subYears(30)])
        ->orderByDesc('points')
        ->limit(5)
        ->get();
        return $competitors;
    }

    public static  function topMaster40(){
        $competitors = Competitor::whereBetween('date_of_birth', [Carbon::now()->subYears(49), Carbon::now()->subYears(40)])
        ->orderByDesc('points')
        ->limit(5)
        ->get();
        return $competitors;
    }
}
