<?php

namespace App\Http\Controllers;

use App\Property;
use App\User;
use App\Profile;
use App\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
    public function venueEdit($id) {
        $venue = Venue::findOrFail($id);
        return view('venues.edit', compact('venue'));
    }
    public function venueUpdate(Request $request, $id) {
        $venue = Venue::findOrFail($id);
        $venue->update($request->all());
        return redirect()->back()->with('message','Venue successfully updated!');
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
