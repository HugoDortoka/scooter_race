<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    protected $fillable = [
        'competitor_id', 'subscription_date', 'subscription_finish', 'annual_fee', 'paid', 'discount'
    ];

    public static function repeat($membershipId){
        $repeat = Membership::where('competitor_id', $membershipId)->get();
        return $repeat;
    }

    public static function discount($id){
        $membership = Membership::where('competitor_id', $id)->first();
        return $membership;
    }
}
