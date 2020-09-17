<?php

namespace App\Http\Controllers;

use App\Company;
use App\Event;
use App\Http\Requests\TaginPostRequest;
use App\Http\Requests\VenuePostRequest;
use App\Property;
use App\Tagin;
use App\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mapper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\PDF_Label;


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
                Mapper::informationWindow($v->latitude, $v->longitude, '<a href="/venues/' . str_slug($v->town) . '/' . str_slug($v->venuename) . '/'. $v->id .'">' . $v->venuename . '</a>', ['icon' => ['url' => 'https://bnhere.co.uk/logo/secondary_map_marker.png', 'scale' => 60]]);
            }
        } else {
            foreach ($venueslist as $v) {
                Mapper::marker($v->latitude, $v->longitude);
                Mapper::informationWindow($v->latitude, $v->longitude, '<a href="/venues/' . str_slug($v->town) . '/' . str_slug($v->venuename) . '/'. $v->id .'">' . $v->venuename . '</a>', ['icon' => ['url' => 'https://bnhere.co.uk/logo/secondary_map_marker.png', 'scale' => 60]]);
            }
        }

        return view('venues.all', compact(
            'venues',
            'venueslist',
                'towns',
                'checked'));
    }

    public function welcome() {
        $venues = Venue::where('is_live',1)->inRandomOrder()->paginate(8);
        $allvenues = Venue::paginate(38);
        Mapper::map(50.8319292,-0.3155225, [
            'zoom' => 12,
            'marker' => false,
            'cluster' => false
        ]);
        foreach ($allvenues as $p) {
            Mapper::marker($p->latitude, $p->longitude);
            Mapper::informationWindow($p->latitude, $p->longitude, '<a href="/venues/'.str_slug($p->town).'/'.str_slug($p->town).'/'.$p->id.'">'.$p->venuename.'</a>', ['icon' => ['url' => 'https://bnhere.co.uk/logo/primary_map_marker.png', 'scale' => 100]]);
        }
//        Mapper::marker($properties->latitude, $properties->longitude);

//        if (Auth::check()) {
//            $loggedin = true;
//        } else {
//            $loggedin = false;
//        }
        return view('welcome', compact('venues', 'allvenues'));
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
        $events = Event::latest()->where("venue_id", "=", "$id")->get();

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
        'thevenue',
        'events'));
    }

    public function venueTagin($id) {

        $thevenue = Venue::findOrFail($id);
        $venue = $thevenue->name;
        return view('venues.tagin', compact(
            'id',
            'thevenue',
        'venue'));
    }

    public function tagin(TaginPostRequest $request) {

        Tagin::create([
            'venue_id'=>request('venue_id'),
            'phone_number'=>request('phone_number'),
            'email_address'=>request('email_address'),
            'reason_visit'=>request('reason_visit'),
            'marketing'=>request('marketing')
        ]);

        //LOGGING
        //Log::info('Phone number: '.request('phone_number').'');

        return redirect()->back()->with('message','Tagged in successfully!');
    }

    public function pdf($town){

        $venueslist = Venue::latest()->where('is_live',1)->where('town', $town)->paginate(52);
        foreach ($venueslist as $v) {

            //create pdf document
            $pdf = app('Fpdf');
            $pdf->AddPage();
            $pdf->SetFont('Arial','B',14);

            $qrtagin = "qrcodes/".$v->town."/customers/tagin-".$v->id.".png";
            $qrvenue = "qrcodes/".$v->town."/venues/qrcode-".$v->id.".png";



//            $address = $v->venuename.'<br />'.$v->address.'<br />'.$v->address2.'<br />'.$v->town.'<br />'.$v->county.'<br />'.$v->postcode.'<br />'.date('Y-m-d').'<br />';

            $pdf->Cell(150,8,"\n");
            $pdf->Cell(50, 40, $pdf->Image($qrtagin, $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'C' );
            $pdf->Cell(150,8,$v->venuename."\n");
            $pdf->Ln();
            $pdf->Cell(150,8,$v->venuename."\n");
            $pdf->Ln();
            $pdf->Cell(150,8,$v->address."\n");
            if($v->address2 != ''){
            $pdf->Ln();
            $pdf->Cell(150,8,$v->address2."\n");
            }
            $pdf->Ln();
            $pdf->Cell(150,8,$v->town."\n");
            $pdf->Ln();
            $pdf->Cell(150,8,$v->county."\n");
            $pdf->Ln();
            $pdf->Cell(150,8,date("F j, Y")."\n");


//            $pdf->Cell( 160, 10, $pdf->Image($qrvenue, $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'R', false );
//            $pdf->Ln();
//            $pdf->Cell(160,8,'Venue QR-Code'."\n", 0, 0, 'R', false);


//            $pdf->Ln();
//            $pdf->Cell(160,20,'Tagin QR-Code'."\n", 1, 1, 'R', false);


            $pdf->SetFont('Arial','',12);
            // set some text for example
            $txt = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. In sed imperdiet lectus. Phasellus quis velit velit, non condimentum quam. Sed neque urna, ultrices ac volutpat vel, laoreet vitae augue. Sed vel velit erat. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras eget velit nulla, eu sagittis elit. Nunc ac arcu est, in lobortis tellus. Praesent condimentum rhoncus sodales. In hac habitasse platea dictumst. Proin porta eros pharetra enim tincidunt dignissim nec vel dolor. Cras sapien elit, ornare ac dignissim eu, ultricies ac eros. Maecenas augue magna, ultrices a congue in, mollis eu nulla. Nunc venenatis massa at est eleifend faucibus. Vivamus sed risus lectus, nec interdum nunc.

Fusce et felis vitae diam lobortis sollicitudin. Aenean tincidunt accumsan nisi, id vehicula quam laoreet elementum. Phasellus egestas interdum erat, et viverra ipsum ultricies ac. Praesent sagittis augue at augue volutpat eleifend. Cras nec orci neque. Mauris bibendum posuere blandit. Donec feugiat mollis dui sit amet pellentesque. Sed a enim justo. Donec tincidunt, nisl eget elementum aliquam, odio ipsum ultrices quam, eu porttitor ligula urna at lorem. Donec varius, eros et convallis laoreet, ligula tellus consequat felis, ut ornare metus tellus sodales velit. Duis sed diam ante. Ut rutrum malesuada massa, vitae consectetur ipsum rhoncus sed. Suspendisse potenti. Pellentesque a congue massa.';

// print a blox of text using multicell()
            $pdf->setX(20);
            $pdf->setY(80);
//            $pdf->MultiCell(184, 6, $txt."\n",0,0,'L');
            $pdf->MultiCell(184, 6, $txt, 0, 'L', 0, 0, '', '', false);

            //save file
            Storage::put('/public/letters/'.$town.'/'.$v->venuename.'.pdf', $pdf->Output('S'));
        }

        return view('venues.pdf', compact(
            'pdf'));
    }

    public function addressLabels($town) {
        $pdf = new PDF_Label('L7163');

        $pdf->AddPage();
        $venueslist = Venue::latest()->where('is_live',1)->where('town', $town)->paginate(1000);

        // Print labels
        foreach ($venueslist as $v) {
            $text = sprintf("%s\n%s%s\n%s\n%s\n%s", "$v->venuename", "$v->address", "$v->address2", "$v->town", "$v->county", "$v->postcode");
            $pdf->Add_Label($text);
        }

        Storage::put('/public/labels/'.$town.'/addresses.pdf', $pdf->Output('S'));
        return view('venues.addresses', compact(
            'pdf'));
    }

    public function venueEdit($id) {
        $venue = Venue::findOrFail($id);
        return view('venues.edit', compact('venue'));
    }
    public function venueUpdate(Request $request, $id) {
        $venue = Venue::findOrFail($id);
        $venue->update($request->all());
        return redirect()->back()->with('message','Venue successfully updated!');
    }

}
