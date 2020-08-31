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
        $user =  User::create([
            'name' => request('cname'),
            'email' => request('email'),
            'user_type' => request('user_type'),
            'password' => Hash::make(request('password')),
        ]);

        $venue = Venue::findOrFail(request('selectedVenueID'));
        $venue->user_id = $user->id;
        $venue->save();

        return redirect()->to('login');
    }
}
