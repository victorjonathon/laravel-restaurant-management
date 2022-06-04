<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index(){
        return view('home/index');
    }

    public function redirects(){
        $userType = Auth::user()->usertype;

        if($userType == 0){ // User
            return view('home/index');
        }else{ // Admin
            return view('admin/adminhome');
        }

    }
}
