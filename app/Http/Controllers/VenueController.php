<?php

namespace App\Http\Controllers;

use App\Property;
use App\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mapper;
use Illuminate\Support\Facades\DB;


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

        $venueslist = Venue::latest()->where('is_live',1)->paginate(52);
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
                Mapper::informationWindow($v->latitude, $v->longitude, '<a href="/venues/' . str_slug($v->town) . '/' . str_slug($v->venuename) . '/'. $v->id .'">' . $v->venuename . '</a>', ['icon' => ['url' => 'https://bnhere.co.uk/logo/primary_map_marker.png', 'scale' => 100]]);
            }
        } else {
            foreach ($venueslist as $v) {
                Mapper::marker($v->latitude, $v->longitude);
                Mapper::informationWindow($v->latitude, $v->longitude, '<a href="/venues/' . str_slug($v->town) . '/' . str_slug($v->venuename) . '/'. $v->id .'">' . $v->venuename . '</a>', ['icon' => ['url' => 'https://bnhere.co.uk/logo/primary_map_marker.png', 'scale' => 100]]);
            }
        }

        return view('venues.all', compact(
            'venues',
            'venueslist',
                'towns',
                'checked'));
    }

    public function searchVenueTowns(Request $request) {
        $query = $request->get('query');
        $data = DB::table('venues')->where('town','LIKE','%'.$query.'%')->get();
//        Log::info('Venue Query Here: '.$query.'');
//        Log::info('Venue Data Here: '.$data.'');
        $output = '<ul class="dropdown-menu" style="padding:10px; display:block; position:relative; height: 300px; overflow-y: scroll;">';

        foreach ($data as $row){
            $output .= '<li>
                <div class="form-check">
  <input class="form-check-input" type="radio" name="selectedVenueID" id="'.$row->slug.'" value="'.$row->id.'">
  <label class="form-check-label" for="'.$row->slug.'">
            '.$row->venuename.', '.$row->town.'
            </label>
</div></li>';
        }
        $output .= '</ul>';
        return $output;
//        return response()->json($data);
    }

    public function searchVenues(Request $request) {
        $query = $request->get('query');
        $data = DB::table('venues')->where('venuename','LIKE','%'.$query.'%')->get();
//        Log::info('Venue Query Here: '.$query.'');
//        Log::info('Venue Data Here: '.$data.'');
        $output = '<ul class="dropdown-menu" style="padding:10px; display:block; position:relative; height: 300px; overflow-y: scroll;">';

        foreach ($data as $row){
            $output .= '<li>
                <div class="form-check">
  <input class="form-check-input" type="radio" name="selectedVenueID" id="'.$row->slug.'" value="'.$row->id.'">
  <label class="form-check-label" for="'.$row->slug.'">
            '.$row->venuename.', '.$row->town.'
            </label>
</div></li>';
        }
        $output .= '</ul>';
        return $output;
    }

    public function town(Request $request, $town) {

        $venueslist = Venue::latest()->where('is_live',1)->where('town', $town)->paginate(52);
        $venues = Venue::get();
        $towns = Venue::select('town')->distinct()->get();

        if($town == 'brighton'){
            $town = 'Brighton Sussex';
        } elseif($town == 'Brighton') {
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
                Mapper::informationWindow($v->latitude, $v->longitude, '<a href="/venues/' . str_slug($v->town) . '/' . str_slug($v->venuename) . '/'. $v->id .'">' . $v->venuename . '</a>', ['icon' => ['url' => 'https://bnhere.co.uk/logo/primary_map_marker.png', 'scale' => 100]]);
            }

        return view('venues.town', compact(
            'venues',
            'venueslist',
            'towns'));
    }

    public function venue($town, $venue, $id) {
        $towns = Venue::select('town')->distinct()->get();
        $thevenue = Venue::findOrFail($id);
        Mapper::map($thevenue->latitude,$thevenue->longitude, [
            'zoom' => 16,
            'marker' => true,
            'cluster' => false
        ]);
        Mapper::informationWindow($thevenue->latitude, $thevenue->longitude, '<a href="/venues/' . str_slug($thevenue->town) . '/' . str_slug($thevenue->venuename) . '/'. $thevenue->id .'">' . $thevenue->venuename . '</a>', ['icon' => ['url' => 'https://bnhere.co.uk/logo/primary_map_marker.png', 'scale' => 100]]);
        return view('venues.venue', compact(
            'towns',
            'town',
            'venue',
        'id',
        'thevenue'));
    }

}
