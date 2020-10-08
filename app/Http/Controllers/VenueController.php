<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
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
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mapper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class VenueController extends Controller
{


    public function updateScool()
    {
        // gets Venues which don't have website set.
        $venues = Venue::select('town')->whereNull('telephone')->distinct()->limit(100)->get();

//        dd($venues);
        foreach ($venues as $venue) {

            $response = Http::get('https://api.opendata.education/rest/sif/requests/SchoolInfos?navigationPage=1&navigationPageSize=50', [
                'Town' => $venue->town,
            ]);

            if ($response->getBody()) {
                if($response->status() == 200) {
                    $xml_string = $response->getBody();
                    $xml = simplexml_load_string($xml_string);
                    $json = json_encode($xml);
                    $array = json_decode($json, TRUE);
                    //dd($array['SchoolInfo'][1]['SchoolPhoneNumber']['Number']);


                    if (array_key_exists('SchoolInfo',$array)) {
                        foreach ($array['SchoolInfo'] as $arr) {
                            //dd($arr);
                            //$schoolname = $arr['SchoolName'] ?? '';
                            $schoolstreet = $arr['SchoolAddress']['Street'] ?? '';
                            $schoolphone = $arr['SchoolPhoneNumber']['Number'] ?? '';
                            $schoolurl = $arr['SchoolURL'] ?? '';

                            $venue->where('address_1', 'LIKE', '%'.$schoolstreet.'%')
                                ->where('town', '=', $venue->town)
                                ->update([
                                    'telephone' => $schoolphone,
                                    'website' => $schoolurl
                                ]);
                        }
                    } else {
                        echo 'I got to the end!';
                    }
                }
            }
            // @todo - add some checks for successful response.
        }

        return view('venues.postcodes', compact(
            'venues'
        ));
    }

    public function postcodes()
    {
        $converted = [ "G41 5QF", "BD9 6ND", "G33 3LT", "KA7 2PG", "M9 2DD", "BPFO 7DL", "M22 8ZZ", "PO36 9LH", "TD11 3QQ",
            "NP9 5XL", "DA17 6JA", "BFPO 39", "IP7 7EU", "B42 2SU", "B11 2PZ", "B19 3RL", "BFPO 22", "GY6 8XY", "KT19 9BH",
            "L9 9JQ", "LU7 7UA", "LA8 9LS", "BL2 2AN", "SG13 8ED", "G21 4QU", "EH10 4LR", "SE16 4RB", "BN15 9QY", "BH1 3NL",
            "IM4 4TQ", "YO11 2TT", "TN6 1LY", "NN11 5YU", "TA8 4EQ", "WR11 5JH", "CB4 8SJ", "IM7 4BN", "HU13 0HR", "DL8 2DV",
            "BR6 9OU", "GU2 5BS", "BN2 5JF", "KA30 9DZ", "BS10 6NJ", "WN3 4JH", "CB9 7UA", "BFPO 35", "KY8 1HL", "E1 1JB",
            "CW12 3PQ", "BT16 0HS", "CB2 2QQ", "BT92 OPE", "SL1 7LZ", "GU5 9QG", "LU2 0HJ", "BT8 6HD", "GY1 1PU", "RG7 5WN",
            "SO41 5GU", "NW9 7DH", "JE3 1JQ", "BT94 5BE", "BT74 7HP", "BT79 7DJ", "BT39 OSD", "SY1 3NN", "OX8 6NE", "GL4 9BL",
            "MK40 3OA", "CF44 8SS", "", "OX8 1PL", "ME7 2DT", "BB5 2AW", "EX8 5DS", "WC2N 5BP", "BFPO 28", "WD1 8QD", "L17 6AX",
            "BT48 9SE", "PR8 3JB", "BFPO 57", "BL3 4HF", "IM8 1JB", "CO2 9DQ", "IP12 3AZ", "B11 3BZ", "FK10 2EQ", "NE66 1UN",
            "PE2 8YB", "CA9 3RG", "CA9 3UF", "NP44 2WN", "NP9 9QP", "BS37 7HT", "IP10 0HL", "OX25 2LN", "SE14 6QH", "GY1 2DF",
            "IM2 2BX", "ZE1 0JH", "IM7 4EZ", "SA71 1AT", "IM9 4LH", "L7 3EA", "SV21 7PW", "FY4 1JG", "BT9 6AQ", "RG8 8SW",
            "NE34 OPL", "BS7 9PE", "IM3 3LA", "LU6 1NH", "M46 9JP", "IM8 2PA", "UB1 1LS", "BFPO59", "KA7 1HX", "B16 8TR",
            "IM1 3DX", "IM2 2ST", "IM1 4BE", "IM2 5EE", "IM9 2LA", "IM7 5AH", "DD4 0NE", "CB2 5AH", "BT32 3EP", "S18 5TA",
            "G21 8AH", "SW25 1HT", "BT12 5FW", "IG11 9LP", "S70 2YW", "PO22 9BH", "S32 1XG", "BA2 2QL", "W12 0TT", "CB4 8ED",
            "RM16 6WE", "FK9 4RR", "B34 6BJ", "NE46 4LY", "JE2 4RJ", "SO42 7YD", "IV4 7DJ", "LA2 6AP", "IP7 6GD", "DL1 2AN",
            "GU11 1QJ", "LE4 0RW", "LE4 0FL", "LE4 1DT", "GU11 1YH", "BL3 4RX", "CR8 4DN", "AL4 0XB", "PE14 8RH", "N14 4AP",
            "TN23 4EY", "TN23 5DA", "DN35 8DS", "CB5 0DU", "WV10 0QR", "E14 9LZ", "BT94 5DZ", "SO16 0SX", "CV11 5HJ", "WA3 6FZ",
            "NG6 0NB", "N8 0LZ", "CB1 6DJ", "SE5 0HF", "YO30 6BS", "SY21 9TB", "M24", "ML3 6JS", "NP18 3BY", "BT41 4PU",
            "CB3 7NX", "B12 0TJ", "S32 1XR", "OX12 9DJ", "CM1 2BL", "EH6 4LX", "RH4 4DP", "GU2 5WW", "CV37 ORF", "BD3 0DU",
            "LS8 6HS", "NG5 2DB", "G51 2DF", "GY5 7PH" ];
        // gets Venues which don't have latitude set.
        // $venues = Venue::select('postcode')->whereNotIn('postcode', $converted)->whereNull('latitude')->whereNull('longitude')->distinct()->limit(2000)->get();
        $venues = Venue::select('postcode')->whereNull('latitude')->whereNull('longitude')->distinct()->limit(2000)->get();

        //dd($venues[0]);

        foreach ($venues as $venue) {

            $response = Http::post('https://api.postcodes.io/postcodes', ['postcodes' => [$venue->postcode]]);

            // @todo - add some checks for successful response.
            if($response->status() == 200){

                $results = $response->json()['result'];

                //dd($results[0]['result']);
                // updates venues which have matching postcode
                if($results[0]['result'] != '') {
                    $venue->where('postcode', $venue->postcode)
                        ->update([
                            'latitude' => $results[0]['result']['latitude'],
                            'longitude' => $results[0]['result']['longitude']
                        ]);
                }
            }
        }

        return view('venues.postcodes', compact(
            'venues'
        ));
    }

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
                Mapper::informationWindow($v->latitude, $v->longitude, '<a href="/venues/' . str_slug($v->town) . '/' . str_slug($v->school) . '/'. $v->id .'">' . $v->school . '</a>', ['icon' => ['url' => 'https://bnhere.co.uk/logo/secondary_map_marker.png', 'scale' => 60]]);
            }
        } else {
            foreach ($venueslist as $v) {
                Mapper::marker($v->latitude, $v->longitude);
                Mapper::informationWindow($v->latitude, $v->longitude, '<a href="/venues/' . str_slug($v->town) . '/' . str_slug($v->school) . '/'. $v->id .'">' . $v->school . '</a>', ['icon' => ['url' => 'https://bnhere.co.uk/logo/secondary_map_marker.png', 'scale' => 60]]);
            }
        }
        return view('venues.all');
//        return view('venues.all', compact(
//            'venues',
//            'venueslist',
//                'towns',
//                'checked'));
    }

    public function welcome() {
        $venues = Venue::where('is_live',1)->inRandomOrder()->paginate(20);
        $allvenues = Venue::where('is_live',1)->paginate(100);
        Mapper::map(53.4600308,-0.886945, [
            'zoom' => 7,
            'marker' => false,
            'cluster' => false
        ]);
        foreach ($allvenues as $p) {
            Mapper::marker($p->latitude, $p->longitude);
            Mapper::informationWindow($p->latitude, $p->longitude, '<a href="/venues/'.str_slug($p->town).'/'.str_slug($p->town).'/'.$p->id.'">'.$p->school.'</a>', ['icon' => ['url' => 'https://bnhere.co.uk/logo/primary_map_marker.png', 'scale' => 100]]);
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
            '.$row->school.', '.$row->town.'
            </label>
</div></li>';
        }
        $output .= '</ul>';
        return $output;
//        return response()->json($data);
    }

    public function searchVenues(Request $request) {
        $query = $request->get('query');
        $data = DB::table('venues')->where('school','LIKE','%'.$query.'%')->get();
//        Log::info('Venue Query Here: '.$query.'');
//        Log::info('Venue Data Here: '.$data.'');
        $output = '<ul class="dropdown-menu" style="padding:10px; display:block; position:relative; height: 300px; overflow-y: scroll;">';

        foreach ($data as $row){
            $output .= '<li>
                <div class="form-check">
  <input class="form-check-input" type="radio" name="selectedVenueID" id="'.$row->slug.'" value="'.$row->id.'">
  <label class="form-check-label" for="'.$row->slug.'">
            '.$row->school.', '.$row->town.'
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
                Mapper::informationWindow($v->latitude, $v->longitude, '<a href="/venues/' . str_slug($v->town) . '/' . str_slug($v->school) . '/'. $v->id .'">' . $v->school . '</a>', ['icon' => ['url' => 'https://bnhere.co.uk/logo/primary_map_marker.png', 'scale' => 100]]);
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
        Mapper::informationWindow($thevenue->latitude, $thevenue->longitude, '<a href="/venues/' . str_slug($thevenue->town) . '/' . str_slug($thevenue->school) . '/'. $thevenue->id .'">' . $thevenue->school . '</a>', ['icon' => ['url' => 'https://bnhere.co.uk/logo/primary_map_marker.png', 'scale' => 100]]);
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



//            $address = $v->school.'<br />'.$v->address_1.'<br />'.$v->address_2.'<br />'.$v->town.'<br />'.$v->county.'<br />'.$v->postcode.'<br />'.date('Y-m-d').'<br />';

            $pdf->Cell(150,8,"\n");
            $pdf->Cell(50, 40, $pdf->Image($qrtagin, $pdf->GetX(), $pdf->GetY(), 33.78), 0, 0, 'C' );
            $pdf->Cell(150,8,$v->school."\n");
            $pdf->Ln();
            $pdf->Cell(150,8,$v->school."\n");
            $pdf->Ln();
            $pdf->Cell(150,8,$v->address_1."\n");
            if($v->address_2){
            $pdf->Ln();
            $pdf->Cell(150,8,$v->address_2."\n");
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
            $txt = $v->school . ' is currently listed on https://www.bnhere.co.uk. A website directory of venues in Sussex (the BN district) helping these venues with the NHS Test and Trace system. We make it easy for your customers to submit their details privately upon arrival and with their consent.

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
            Storage::put('/public/letters/'.$town.'/'.$v->school.'.pdf', $pdf->Output('S'));
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
            $text = sprintf("%s\n%s%s\n%s\n%s\n%s", "$v->school", "$v->address_1", "$v->address_2", "$v->town", "$v->county", "$v->postcode");
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

    public function venueTaginstats($id, $date) {

    $selecteddate = $date;
    $tagins = Tagin::latest()->where('venue_id',$id)->where('created_at', 'like', '%' . $date . '%')->paginate(1000);
    $data = Tagin::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as taginDate'))->distinct()->where('venue_id',$id)->orderBy('created_at', 'DESC')->get();


        $thevenue = Venue::findOrFail($id);

        return view('venues.tagins', compact(
            'tagins','thevenue', 'data', 'selecteddate'));
    }

}
