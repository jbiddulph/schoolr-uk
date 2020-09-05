<?php

namespace App\Http\Controllers;

use App\User;
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
            'price_1HNvjiB9HABsmFZYGdYz4Muy'=>"Monthly - £10.00",
            'plan_H5l5lbmw0nviEe'=>"Yearly - £110.00 Save £10"
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
        $paymentMethod = $request->payment_method;
        $planId = $request->plan;
        $user->newSubscription('main', $planId)->create($paymentMethod);

        return response([
            'success_url'=>redirect()->intended('/property/create')->getTargetUrl(),
            'message'=>'success'
        ]);
    }

//    public function store()
//    {
//        return true;
//    }

}
