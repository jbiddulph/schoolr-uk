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

    /**
     * @param Request $request
     * @return VenueResource
     */
    public function store(Request $request) {
        $request->validate([
           'school'=>'required',
           'slug'=>'required',
           'byb_type'=>'required',
           'address_1'=>'required',
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

    public function update(Venue $venue, Request $request): VenueResource {

        //update our venue
        $venue->update($request->all());

        return new VenueResource($venue);
    }

    /**
     * @param Venue $venue
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Venue $venue) {
        $venue->delete();

        return response()->json();
    }
}
