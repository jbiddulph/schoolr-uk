<?php

namespace App\Http\Controllers;


use App\Http\Resources\VenueResource;
use App\Http\Resources\VenueResourceCollection;
use App\Venue;
use Illuminate\Http\Request;

class VenueAPIController extends Controller
{

    /**
     * @return VenueResourceCollection
     */
    public function index(): VenueResourceCollection {
        return new VenueResourceCollection(Venue::paginate());
    }

    /**
     * @param Venue $venue
     * @return VenueResource
     */
    public function show(Venue $venue): VenueResource {
        return new VenueResource($venue);
    }

    public function store(Request $request) {
        $request->validate([
           'venuename'=>'required',
           'slug'=>'required',
           'venuetype'=>'required',
           'address'=>'required',
           'town'=>'required',
           'county'=>'required',
           'postcode'=>'required',
           'latitude'=>'required',
           'longitude'=>'required',
            'telephone'=>'required'
        ]);

        $venue = Venue::create($request->all());

        return new VenueResource($venue);
    }
}
