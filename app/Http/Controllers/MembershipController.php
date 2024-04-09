<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class MembershipController extends Controller
{
    //USER
    public function new($id)
    {
        $membership = new Membership();
        $membership->competitor_id = $id;
        $membership->subscription_date = date('Y-m-d');
        $membership->subscription_finish = date('Y-m-d', strtotime('+1 year'));
        $membership->annual_fee = 200;
        $membership->paid = 1;
        $membership->discount = 20;
        $membership->save();
        return Redirect::route('user.profile');
    }
}
