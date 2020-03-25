<?php

namespace App\Http\Controllers;

use App\User;
use App\Profile;
use Illuminate\Http\Request;

class AdministrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index() {
        $users = User::with('profile')->where('user_type', '!=', 'company')->orderby('created_at', 'DESC')->paginate(50);
        $companies = User::with('profile')->where('user_type', '=', 'company')->orderby('created_at', 'DESC')->paginate(50);
        return view('administration', compact('users', 'companies'));
    }
}
