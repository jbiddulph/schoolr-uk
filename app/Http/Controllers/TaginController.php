<?php

namespace App\Http\Controllers;

use App\Tagin;
use App\Venue;
use Illuminate\Http\Request;

class TaginController extends Controller
{
    public function index()
    {
        return view('tagins.index');
    }

    /**
     * Fetch the particular company details
     * @return json response
     */
    public function chart()
    {
        $result = Venue::groupBy('town')
            ->selectRaw('count(*) as total, town')
            ->get();
        return response()->json($result);
    }
}
