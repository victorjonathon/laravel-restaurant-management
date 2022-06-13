<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Food;

class HomeController extends Controller
{
    //
    public function index(){
        $fooditems = Food::all();
        return view('home/index', compact('fooditems'));
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
