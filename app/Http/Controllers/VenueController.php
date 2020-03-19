<?php

namespace App\Http\Controllers;

use App\Property;
use App\Venue;
use Illuminate\Http\Request;
use Mapper;

class VenueController extends Controller
{
    public function index(Request $request) {

        $mapswitch = request('mapswitch');

            if($mapswitch == 'on') {
                $cluster = true;
                $checked = 'checked';
            } else {
                $cluster = false;
                $checked = '';
            }

        $venueslist = Venue::latest()->where('is_live',1)->paginate(50);
        $venues = Venue::get();
        $towns = Venue::select('town')->distinct()->get();

        Mapper::map(50.8319292,-0.3155225, [
            'zoom' => 12,
            'marker' => false,
            'cluster' => $cluster
        ]);
        if($mapswitch == 'on') {
            foreach ($venues as $v) {
                Mapper::marker($v->latitude, $v->longitude);
                Mapper::informationWindow($v->latitude, $v->longitude, '<a href="venue/' . $v->id . '/' . $v->slug . '">' . $v->venuename . '</a>', ['icon' => ['url' => 'http://moveme.test/logo/primary_map_marker.png', 'scale' => 100]]);
            }
        } else {
            foreach ($venueslist as $v) {
                Mapper::marker($v->latitude, $v->longitude);
                Mapper::informationWindow($v->latitude, $v->longitude, '<a href="venue/' . $v->id . '/' . $v->slug . '">' . $v->venuename . '</a>', ['icon' => ['url' => 'http://moveme.test/logo/primary_map_marker.png', 'scale' => 100]]);
            }
        }

        return view('venues.all', compact(
            'venues',
            'venueslist',
                'towns',
                'checked'));
    }

    public function town(Request $request, $town) {

        $venueslist = Venue::latest()->where('is_live',1)->where('town', $town)->paginate(50);
        $venues = Venue::get();
        $towns = Venue::select('town')->distinct()->get();

        if($town == 'Brighton'){
            $town = 'Brighton Sussex';
        }
        if($town == 'Peacehaven'){
            $town = 'Peacehaven Sussex';
        }
        Mapper::location($town);
        Mapper::location($town)->map([
            'zoom' => 14,
            'center' => true,
            'marker' => false,
            'cluster' => false,
            'type' => 'ROADMAP']);

            foreach ($venueslist as $v) {
                Mapper::marker($v->latitude, $v->longitude);
                Mapper::informationWindow($v->latitude, $v->longitude, '<a href="venue/' . $v->id . '/' . $v->slug . '">' . $v->venuename . '</a>', ['icon' => ['url' => 'http://moveme.test/logo/primary_map_marker.png', 'scale' => 100]]);
            }

        return view('venues.town', compact(
            'venues',
            'venueslist',
            'towns'));
    }

}
