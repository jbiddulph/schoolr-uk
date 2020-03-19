<?php

namespace App\Http\Controllers;

use App\Property;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function saveProperty($id) {
        $propertyID = Property::find($id);
        $propertyID->favourites()->attach(auth()->user()->id);
        return redirect()->back();
    }
    public function unsaveProperty($id) {
        $propertyID = Property::find($id);
        $propertyID->favourites()->detach(auth()->user()->id);
        return redirect()->back();
    }
}
