<?php

namespace App\Http\Controllers;

use App\Company;
use App\Profile;
use App\PropertyPhotos;
use Auth;
use Illuminate\Http\Request;
use App\Property;
use Validator;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\PropertyPostRequest;
use Mapper;

class PropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('company', ['except'=>array('index','show','interest','allProperties')]);
    }

    public function index() {
        $properties = Property::latest()->limit(10)->where('is_live',1)->get();
        Mapper::map(50.8319292,-0.3155225, ['zoom' => 12, 'marker' => true]);
        foreach ($properties as $p) {
            Mapper::marker($p->latitude, $p->longitude);
        }
//        Mapper::marker($properties->latitude, $properties->longitude);
        $companies = Company::get()->random(4);
        if (Auth::check()) {
            $loggedin = true;
        } else {
            $loggedin = false;
        }
        return view('welcome', compact('properties','companies', 'loggedin'));
    }

    public function myProperty() {
        $properties = Property::where('user_id',auth()->user()->id)->get();
        return view('properties.myproperty', compact('properties'));
    }

    public function edit($id) {
        $property = Property::findOrFail($id);
        return view('properties.edit', compact('property'));
    }

    public function update(Request $request, $id) {
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

    public function show($id,Property $property) {
        Mapper::map($property->latitude,$property->longitude);
        if (Auth::check()) {
            $loggedin = true;
        } else {
            $loggedin = false;
        }
        return view('properties.show',compact('property', 'loggedin'));
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

        return redirect()->back()->with('message','Property added successfully!');
    }

    public function interest(Request $request, $id) {
        $propertyid = Property::findOrFail($id);
        $propertyid->users()->attach(Auth::user()->id);
        return redirect()->back()->with('message','Interest was sent!');
    }

    public function applicant() {
        $applicants = Property::has('users')->where('user_id', auth()->user()->id)->get();
        return view('properties.applicants', compact('applicants'));
    }

    public function allProperties() {
        Mapper::map(50.8319292,-0.3155225, ['zoom' => 12, 'marker' => false]);
        if (Auth::check()) {
            $loggedin = true;
        } else {
            $loggedin = false;
        }
        $properties = Property::latest()->where('is_live',1)->paginate(10);
        return view('properties.allproperties', compact('properties','loggedin'));
    }
    public function toggleLive(Request $request) {
        $property = Property::find($request->id);
        $property->is_live = $request->is_live;
        $property->save();
        return redirect()->back();
    }
}
