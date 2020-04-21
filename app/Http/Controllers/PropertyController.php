<?php

namespace App\Http\Controllers;

use App\Company;
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
        $properties = Property::latest()->limit(8)->where('is_live',1)->get();
        Mapper::map(50.8319292,-0.3155225, [
            'zoom' => 12,
            'marker' => false,
            'cluster' => false
        ]);
        foreach ($properties as $p) {
            Mapper::marker($p->latitude, $p->longitude);
            Mapper::informationWindow($p->latitude, $p->longitude, '<a href="properties/'.$p->id.'/'.$p->slug.'">'.$p->propname.'</a>', ['icon' => ['url' => 'https://bnhere.co.uk/logo/primary_map_marker.png', 'scale' => 100]]);
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
        Mapper::map($property->latitude,$property->longitude, ['icon' => ['url' => 'https://bnhere.co.uk/logo/primary_map_marker.png', 'scale' => 100]]);
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
    public function uploadImage(Request $request)
    {
        if($request->hasFile('upload')) {
            //get filename with extension
            $filenamewithextension = $request->file('upload')->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

            //get file extension
            $extension = $request->file('upload')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $filename.'_'.time().'.'.$extension;

            //Upload File
            $request->file('upload')->storeAs('public/uploads', $filenametostore);

            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/uploads/'.$filenametostore);
            $msg = 'Image successfully uploaded';
            $re = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            // Render HTML output
            @header('Content-type: text/html; charset=utf-8');
            echo $re;
        }
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

    public function allProperties(Request $request) {
        $propname = request('propname');
        $minbeds = request('bedroom');
        $proptype_id = request('proptype_id');
        $category_id = request('category_id');
        $town = request('town');
        if (Auth::check()) {
            $loggedin = true;
        } else {
            $loggedin = false;
        }

        if($propname||$minbeds||$proptype_id||$category_id||$town) {
            $properties = Property::where('propname', 'like', "%{$propname}%")
                ->where(static function ($query) use ($proptype_id, $minbeds, $category_id, $town) {
                    $query->where('proptype_id', '=', $proptype_id)
                        ->orWhere('bedroom', '=', $minbeds)
                        ->orWhere('category_id', '=', $category_id)
                        ->orWhere('town', '=', $town);
                })->paginate(20);
            Mapper::map(50.8319292,-0.3155225, [
                'zoom' => 12,
                'marker' => false,
                'cluster' => false
            ]);

            foreach ($properties as $p) {
                Mapper::marker($p->latitude, $p->longitude);
                Mapper::informationWindow($p->latitude, $p->longitude, '<a href="properties/'.$p->id.'/'.$p->slug.'">'.$p->propname.'</a>', ['icon' => ['url' => 'https://bnhere.co.uk/logo/primary_map_marker.png', 'scale' => 100]]);
            }
            return view('properties.allproperties', compact('properties','loggedin'));
        } else {
            $properties = Property::latest()->where('is_live',1)->paginate(20);
            Mapper::map(50.8319292,-0.3155225, [
                'zoom' => 12,
                'marker' => false,
                'cluster' => false
            ]);

            foreach ($properties as $p) {
                Mapper::marker($p->latitude, $p->longitude);
                Mapper::informationWindow($p->latitude, $p->longitude, '<a href="properties/'.$p->id.'/'.$p->slug.'">'.$p->propname.'</a>', ['icon' => ['url' => 'https://bnhere.co.uk/logo/primary_map_marker.png', 'scale' => 100]]);
            }
            return view('properties.allproperties', compact('properties','loggedin'));
        }

    }
    public function toggleLive(Request $request) {
        $property = Property::find($request->id);
        $property->is_live = $request->is_live;
        $property->save();
        return redirect()->back();
    }

}
