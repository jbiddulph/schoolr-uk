<?php

namespace App\Http\Controllers;

use App\Profile;
use App\PropertyPhotos;
use Illuminate\Http\Request;
use App\Property;
use Illuminate\Support\Facades\Log;

class PropertyController extends Controller
{
    //
    public function index() {
        $properties = Property::all();
//        $propertyPhotos = PropertyPhotos::where('property_id', '=', $properties->id)
//            ->get();
        return view('welcome', compact('properties'));
    }

    public function show($id,Property $property) {
        return view('properties.show',compact('property'));
    }

    public function addphotos($id, Property $property) {
        $propertyPhotos = PropertyPhotos::where('property_id', '=', $id)
            ->get();
        $params = array_merge(['propertyId' => $id, 'photos' => $propertyPhotos], compact('property'));
        return view('properties.addphotos', $params);
    }

    public function propertyphoto(Request $request) {
        $user_id = auth()->user()->id;
            $propertyphoto = $request->file('property_photo')->store('public/property/photos');
        Log::info('property photo location: '.$propertyphoto);
        PropertyPhotos::create([
            'user_id'=>$user_id,
            'property_id'=>request('property_id'),
            'photo'=>$propertyphoto
        ]);
        return redirect()->back()->with('message','Photo Added to property!');
    }
}
