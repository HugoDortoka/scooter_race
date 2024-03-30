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
}
