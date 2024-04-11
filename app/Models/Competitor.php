<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
