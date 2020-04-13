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
            'plan_H51QeHJSAUaNlG'=>"Monthly",
            'plan_H51QjMhW6EtCaO'=>"Yearly"
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

        return response(['status'=>'success']);
    }

//    public function store()
//    {
//        return true;
//    }

}
