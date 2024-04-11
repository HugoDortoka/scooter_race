<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'CIF', 'name', 'logo', 'address'
    ];

    public static function ourCompany(){
        $company = Company::where('name', 'Scooter Leveling')->first();
        return $company;
    }
}
