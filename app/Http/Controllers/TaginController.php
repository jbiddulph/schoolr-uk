<?php

namespace App\Http\Controllers;

use App\Tagin;
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
        $result = \DB::table('tagins')
            ->where('venue_id','=','1149079')
            ->orderBy('id', 'ASC')
            ->get();
        return response()->json($result);
    }
}
