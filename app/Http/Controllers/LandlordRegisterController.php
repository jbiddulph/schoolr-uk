<?php

namespace App\Http\Controllers;

use App\User;
use App\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LandlordRegisterController extends Controller
{
    public function landlordRegister() {

        $venue = Venue::findOrFail(request('selectedVenueID'));

        $user =  User::create([
            'name' => $venue->venuename,
            'venue_id' => $venue->id,
            'email' => request('email'),
            'user_type' => request('user_type'),
            'password' => Hash::make(request('password')),
        ]);


        $venue->user_id = $user->id;
        $venue->email = $user->email;
        $venue->save();

        return redirect()->to('login');
    }
    public function registerClaim() {
        $venue = Venue::findOrFail(request('venue_id'));
        $venue_id = $venue->id;
        $venue_name = $venue->venuename;

        return view('register-claim', compact(
            'venue_id',
            'venue_name'));

    }
}
