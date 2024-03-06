<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    use HasFactory;

    protected $table = 'administrators';

    // Verify login
    public static function authenticate($email, $password)
    {
        $administrator = self::where('email', $email)->first();

        if ($administrator && password_verify($password, $administrator->password)) {
            return $administrator;
        }

        return null;
    }
}
