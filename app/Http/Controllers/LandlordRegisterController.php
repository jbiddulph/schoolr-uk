<?php

namespace App\Http\Controllers;

use App\User;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LandlordRegisterController extends Controller
{
    public function landlordRegister() {
        dd(request('user_type'));
//        $user =  User::create([
//            'name' => request('cname'),
//            'email' => request('email'),
//            'user_type' => request('user_type'),
//            'password' => Hash::make(request('password')),
//        ]);
//
//        Company::create([
//            'user_id'=>$user->id,
//            'cname'=>request('cname'),
//            'slug'=>str_slug(request('cname')),
//        ]);
//        return redirect()->to('login');
    }
}
