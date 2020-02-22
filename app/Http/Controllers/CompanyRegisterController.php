<?php

namespace App\Http\Controllers;

use App\User;
use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CompanyRegisterController extends Controller
{
    public function companyRegister() {
        $user =  User::create([
            'name' => request('cname'),
            'email' => request('email'),
            'user_type' => request('user_type'),
            'password' => Hash::make(request('password')),
        ]);

        Company::create([
            'user_id'=>$user->id,
            'cname'=>request('cname'),
            'slug'=>str_slug(request('cname')),
        ]);
        return redirect()->to('login');
    }
}
