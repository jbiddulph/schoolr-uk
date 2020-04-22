<?php

namespace App\Http\Controllers;

use App\Company;
use App\Event;
use App\Http\Requests\PropertyPostRequest;
use App\Http\Requests\VenuePostRequest;
use App\Http\Requests\EventPostRequest;
use App\Property;
use App\PropertyPhotos;
use App\User;
use App\Profile;
use App\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AdministrationController extends Controller
{
//    public function __construct()
//    {
//        $this->middleware('admin');
//    }

    public function index() {
        return view('administration.dashboard');
    }
    public function property() {
        $properties = Property::all();
        return view('administration.adminproperty', compact('properties'));
    }
    public function venue() {
        $venues = Venue::paginate(52);
        return view('administration.adminvenue', compact('venues'));
    }
    public function event() {
        $events = Event::paginate(52);
        return view('administration.adminevent', compact('events'));
    }
    public function eventCreate() {
        return view('events.create');
    }
    public function eventStore(EventPostRequest $request) {
        $eventphoto = $request->file('eventPhoto')->store('public/events/photos');
        Event::create([
            'venue_id'=>request('venue_id'),
            'eventName'=>request('eventName'),
            'slug'=>str_slug(request('eventName')),
            'eventPhoto'=>$eventphoto,
            'eventDate'=>request('eventDate'),
            'eventTimeStart'=>request('eventTimeStart'),
            'eventTimeEnd'=>request('eventTimeEnd'),
            'eventType'=>request('eventType'),
            'eventCost'=>request('eventCost')
        ]);

        return redirect()->back()->with('message','Event added successfully!');
    }
    public function eventEdit($id) {
        $event = Event::findOrFail($id);
        return view('events.edit', compact('event'));
    }
    public function eventUpdate(Request $request, $id) {
        $event = Event::findOrFail($id);

        if ($request->file('eventPhoto') != ''){
            $eventphoto = $request->file('eventPhoto')->store('public/events/photos');
            $event->update([
                'eventPhoto'=>$eventphoto,
            ]);
        }

        $event->update([
            'venue_id'=>request('venue_id'),
            'eventName'=>request('eventName'),
            'slug'=>str_slug(request('eventName')),
            'eventDate'=>request('eventDate'),
            'eventTimeStart'=>request('eventTimeStart'),
            'eventTimeEnd'=>request('eventTimeEnd'),
            'eventType'=>request('eventType'),
            'eventCost'=>request('eventCost')
        ]);
        return redirect()->back()->with('message','Event successfully updated!');
    }
    public function eventuploadsedit($id) {
        $event = Event::findOrFail($id);
        return view('events.uploads-edit', compact('event'));
    }
    public function eventImageUpdate(Request $request, $id) {

        $event = Venue::findOrFail($id);
        $eventphoto = $request->file('eventPhoto')->store('public/events/photos');

        $event->update([
            'eventPhoto'=>$eventphoto,
        ]);
        return redirect()->back()->with('message','Event image updated!');
    }
    public function venueCreate() {
        return view('venues.create');
    }
    public function venueStore(VenuePostRequest $request) {

        $venuephoto = $request->file('photo')->store('public/venues/photos');

        Venue::create([
            'venuename'=>request('venuename'),
            'slug'=>str_slug(request('venuename')),
            'venuetype'=>request('venuetype'),
            'address'=>request('address'),
            'photo'=>$venuephoto,
            'address2'=>request('address2'),
            'town'=>request('town'),
            'county'=>request('county'),
            'postcode'=>request('postcode'),
            'postalsearch'=>request('postalsearch'),
            'telephone'=>request('telephone'),
            'latitude'=>request('latitude'),
            'longitude'=>request('longitude'),
            'website'=>request('website')
        ]);

        //LOGGING
        Log::info('Venue Name: '.request('venuename').'');

        return redirect()->back()->with('message','Venue added successfully!');
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
    public function venueuploadsedit($id) {
        $venue = Venue::findOrFail($id);
        return view('venues.uploads-edit', compact('venue'));
    }
    public function venueImageUpdate(Request $request, $id) {

        $venue = Venue::findOrFail($id);
        Log::info('This Venue: '.$venue.'');
        $venuephoto = $request->file('photo')->store('public/venues/photos');

        $venue->update([
            'photo'=>$venuephoto,
        ]);
        return redirect()->back()->with('message','Venue image updated!');
    }
    public function propertyCreate() {
        return view('properties.create');
    }
    public function propertyStore(PropertyPostRequest $request) {
        dd($request->all());
        $user_id = $request->user_id;
        $company = Company::where('user_id',$user_id)->first();
        $company_id = $company->id;

        $propertyphoto = $request->file('propimage')->store('public/property/photos');
        $floorplan = $request->file('floorplan')->store('public/property/brochure');
        $brochure = $request->file('brochure')->store('public/property/floorplan');

        $requestedtown = request('town');
        if($requestedtown == ''){
            $requestedtown = request('othertown');
        }

        Property::create([
            'user_id'=>$user_id,
            'company_id'=>$company_id,
            'propname'=>request('propname'),
            'slug'=>str_slug(request('propname')),
            'propcost'=>request('propcost'),
            'proptype_id'=>request('proptype_id'),
            'propimage'=>$propertyphoto,
            'bedroom'=>request('bedroom'),
            'bathroom'=>request('bathroom'),
            'kitchen'=>request('kitchen'),
            'garage'=>request('garage'),
            'reception'=>request('reception'),
            'conservatory'=>request('conservatory'),
            'outbuilding'=>request('outbuilding'),
            'address'=>request('address'),
            'town'=>$requestedtown,
            'county'=>request('county'),
            'postcode'=>request('postcode'),
            'latitude'=>request('latitude'),
            'longitude'=>request('longitude'),
            'short_summary'=>request('short_summary'),
            'summary'=>request('summary'),
            'description'=>request('description'),
            'floorplan'=>$floorplan,
            'brochure'=>$brochure,
            'last_date'=>request('last_date'),
            'category_id'=>request('category_id'),
            'is_featured'=>request('is_featured'),
            'is_live'=>request('is_live')
        ]);

        //LOGGING
        Log::info('Property Name: '.request('propname').'');

        return redirect()->back()->with('message','Property added successfully!');
    }
    public function addphotos($id, Property $property) {
        $propertyPhotos = PropertyPhotos::where('property_id', '=', $id)
            ->get();
        $params = array_merge(['propertyId' => $id, 'photos' => $propertyPhotos], compact('property'));
        return view('properties.addphotos', $params);
    }
    public function propertyPhoto(Request $request) {
        $rules = array(
//            'file' => 'required'
        );
        $error = Validator::make($request->all(), $rules);
        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }
        $user_id = auth()->user()->id;
        $propertyphoto = $request->file('property_photo')->store('public/property/photos');

        PropertyPhotos::create([
            'user_id'=>$user_id,
            'property_id'=>request('property_id'),
            'photo_title'=>request('photo_title'),
            'photo'=>$propertyphoto
        ]);
        return redirect()->back()->with('message','Photo Added to property!');
    }
    public function propertyEdit($id) {
        $property = Property::findOrFail($id);
        return view('properties.edit', compact('property'));
    }
    public function propertyUpdate(Request $request, $id) {
        $property = Property::findOrFail($id);
        $property->update($request->all());
        return redirect()->back()->with('message','Property successfully updated!');
    }

    public function propuploadsedit($id) {
        $property = Property::findOrFail($id);
        return view('properties.uploads-edit', compact('property'));
    }

    public function propImageUpdate(Request $request, $id) {

        $property = Property::findOrFail($id);
        Log::info('This Property: '.$property.'');
        $propertyphoto = $request->file('propimage')->store('public/property/photos');

        $property->update([
            'propimage'=>$propertyphoto,
        ]);
        return redirect()->back()->with('message','Property image updated!');
    }

    public function togglePropertyLive(Request $request) {
        $property = Property::find($request->id);
        $property->is_live = $request->is_live;
        $property->save();
        return redirect()->back();
    }
    public function toggleVenueLive(Request $request) {
        $Venue = Venue::find($request->id);
        $Venue->is_live = $request->is_live;
        $Venue->save();
        return redirect()->back();
    }

}
