<?php

namespace App\Http\Controllers;

use App\Company;
use App\Profile;
use App\PropertyPhotos;
use Illuminate\Http\Request;
use App\Property;
use Validator;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\PropertyPostRequest;

class PropertyController extends Controller
{
    //
    public function index() {
        $properties = Property::all();
//        $propertyPhotos = PropertyPhotos::where('property_id', '=', $properties->id)
//            ->get();
        return view('welcome', compact('properties'));
    }

    public function myProperty() {
        $properties = Property::where('user_id',auth()->user()->id)->get();
        return view('properties.myproperty', compact('properties'));
    }

    public function edit($id) {
        $property = Property::findOrFail($id);
        return view('properties.edit', compact('property'));
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

    public function create() {
        return view('properties.create');
    }

    public function store(PropertyPostRequest $request) {

        $user_id = auth()->user()->id;
        $company = Company::where('user_id',$user_id)->first();
        $company_id = $company->id;

        $propertyphoto = $request->file('propimage')->store('public/property/photos');
        $floorplan = $request->file('floorplan')->store('public/property/brochure');
        $brochure = $request->file('brochure')->store('public/property/floorplan');

        Property::create([
            'user_id'=>$user_id,
            'company_id'=>$company_id,
            'propname'=>request('propname'),
            'slug'=>str_slug(request('propname')),
            'propcost'=>request('propcost'),
            'proptype'=>request('proptype'),
            'propimage'=>$propertyphoto,
            'bedroom'=>request('bedroom'),
            'bathroom'=>request('bathroom'),
            'kitchen'=>request('kitchen'),
            'garage'=>request('garage'),
            'reception'=>request('reception'),
            'conservatory'=>request('conservatory'),
            'outbuilding'=>request('outbuilding'),
            'address'=>request('address'),
            'town'=>request('town'),
            'county'=>request('county'),
            'postcode'=>request('postcode'),
            'latitude'=>request('latitude'),
            'longitude'=>request('longitude'),
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
        Log::info('$user_id: '.$user_id);
        Log::info('$company_id: '.$company_id);

        return redirect()->back()->with('message','Property added successfully!');
    }
}
