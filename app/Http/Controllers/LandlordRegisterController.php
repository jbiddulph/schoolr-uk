<?php

namespace App\Http\Controllers;

use App\Event;
use App\User;
use App\Venue;
use Mapper;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LandlordRegisterController extends Controller
{
    public function landlordRegister() {

        $venue = Venue::findOrFail(request('selectedVenueID'));

        $user =  User::create([
            'name' => $venue->school,
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
        $venue_name = $venue->school;

        return view('register-claim', compact(
            'venue_id',
            'venue_name'));

    }

    public function viewVenue(Request $request) {
        $venueid = Auth::user()->venue_id;
        $thevenue = Venue::findOrFail($venueid);
        $towns = Venue::select('town')->distinct()->get();
        $events = Event::latest()->where("venue_id", "=", "$venueid")->get();


        Mapper::map($thevenue->latitude,$thevenue->longitude, [
            'zoom' => 16,
            'marker' => true,
            'cluster' => false
        ]);
        Mapper::informationWindow($thevenue->latitude, $thevenue->longitude, '<a href="/venues/' . str_slug($thevenue->town) . '/' . str_slug($thevenue->school) . '/'. $thevenue->id .'">' . $thevenue->school . '</a>', ['icon' => ['url' => 'https://bnhere.co.uk/logo/primary_map_marker.png', 'scale' => 100]]);
        $venues = Venue::get();
        $venueslist = Venue::latest()->where('is_live',1)->paginate(52);

        return view('venues.venue', compact(
            'venues', 'venueslist', 'thevenue','towns', 'events'));

    }
}
