<?php

namespace App\Http\Controllers;

use App\User;
use App\Venue;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('subscribe');
    }

    public function payment()
    {
        $availablePlans = [
            'price_1HTPqPB9HABsmFZYYSALtKrp'=>"Monthly - £5.00",
            'price_1HTQB9B9HABsmFZYy4mQYXWF'=>"Ever 3 months - £15.00"
        ];
        $user = auth()->user();
        $data = [
            'intent' => $user->createSetupIntent(),
            'plans' => $availablePlans
        ];
        return view('subscribe')->with($data);
    }

    public function subscribe(Request $request)
    {
        $user = auth()->user();
        $venueid = $user->venue_id;
        $paymentMethod = $request->payment_method;
        $planId = $request->plan;
        $user->newSubscription('main', $planId)->create($paymentMethod);
//        $venueid = Venue::where('user_id',$userid)->get();

//        return redirect()->intended('/home')->getTargetUrl();
//        return response([
//
//            'success_url'=>redirect()->intended('/venue/'.$venueid.'/edit')->getTargetUrl(),
//            'message'=>'success'
//        ]);
        return response([
            'success' => redirect()->intended('/venue/'.$venueid.'/edit')->getTargetUrl(),
            'message' => 'success'
        ]);
    }

//    public function store()
//    {
//        return true;
//    }

}
