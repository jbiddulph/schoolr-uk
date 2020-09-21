<?php

namespace App\Http\Controllers;

use App\Company;
use App\Event;
use App\Http\Controllers\PDF_Label;
use App\Http\Requests\TaginPostRequest;
use App\Http\Requests\VenuePostRequest;
use App\Http\Resources\VenueResource;
use App\Http\Resources\VenueResourceCollection;
use App\Property;
use App\Tagin;
use App\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mapper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class VenueController extends Controller
{
    /**
     * @param Venue $venue
     * @return VenueResource
     */
    public function show(Venue $venue): VenueResourceCollection {
        return new VenueResource($venue);
    }

    public function getVenue(Venue $venue)
    {
        return $venue;
    }

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
            if($v->address2){
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
            $txt = $v->venuename . ' is currently listed on https://www.bnhere.co.uk. A website directory of venues in Sussex (the BN district) helping these venues with the NHS Test and Trace system. We make it easy for your customers to submit their details privately upon arrival and with their consent.

        For customer with NFC enabled smart phones, NFC tags (included) can be tapped allowing the customer to easily fill out their details for test and trace. Scanning the QR code of your venue with the a smart phones camera will also allow yoru customer to enter their details.

        And for just 5 pounds per month, you can claim your venue on https://bnhere.co.uk, edit your venue details, view visitor/customer statistics, add additional photos of your venue and add future events.

        Have fun and stay safe with a safe distance whilst socialising.



        BNHERE.CO.UK - Local Track & Trace.';

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


    public function qrcodeLabels($town) {
        $pdf = new PDF_Label('L7163');

        $pdf->AddPage();
        $venueslist = Venue::latest()->where('is_live',1)->where('town', $town)->paginate(1000);

        // Print labels
        foreach ($venueslist as $v) {
            $qrtagin = "qrcodes/".$v->town."/customers/tagin-".$v->id.".png";
            $qrcode = sprintf("%s\n", $pdf->Cell(50, 40, $pdf->Image($qrtagin, $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'C' ));
            $pdf->Add_Label($qrcode);
        }

        Storage::put('/public/labels/'.$town.'/qrcodes.pdf', $pdf->Output('S'));
        return view('venues.addresses', compact(
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

    public function venueTaginstats($id) {
        $tagins = Tagin::findOrFail($id);
        dd($tagins);
//        return view('venues.tagins', compact(
//            'tagins'));
    }

}
