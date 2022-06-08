<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    //
    public function user(){
        $users = User::all();
        return view('admin/user', compact('users'));
    }

    public function deleteuser($id){
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('success', 'Record deleted successfully');   
    }
}
