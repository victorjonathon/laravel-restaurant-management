<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Food;
use Illuminate\Support\Facades\File;

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

    public function foodmenu(){
        $fooditems = Food::all();
        return view('admin/foodmenu', compact('fooditems'));
    }

    public function addfoodform(){
        return view('admin/addfood');
    }

    public function addfooditem(Request $request){
        $fooditem = new Food;
        $imagename = '';
        $image = $request->image;
        if($image->getClientOriginalName() != ''){
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $image->move('foodimages', $imagename);
        }
        
        $fooditem->title = $request->title;
        $fooditem->price = $request->price;
        $fooditem->description = $request->description;
        $fooditem->image = $imagename;
       
        $fooditem->save();
        return redirect()->action('App\Http\Controllers\AdminController@foodmenu')->with('success', 'New food item added successfully!');
    }

    public function deletefood($id){
        $fooditem = Food::find($id);
        
        $imagepath = public_path('foodimages/'.$fooditem->image);
        if(File::exists($imagepath)) {
            File::delete($imagepath);
        }
        
        $fooditem->delete();
        return redirect()->back()->with('success', 'Record deleted successfully');   
    }

    public function updatefoodview($id){
        $fooditem = Food::find($id);
        return view('admin/updatefood', compact('fooditem'));
    }

    public function updatefooditem(Request $request, $id){
        $fooditem = Food::find($id);
        
        $imagename = '';
        $image = $request->image;
        if($image->getClientOriginalName() != ''){
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $image->move('foodimages', $imagename);

            //delete old image
            $imagepath = public_path('foodimages/'.$fooditem->image);
            if(File::exists($imagepath)) {
                File::delete($imagepath);
            }
        }
        
        $fooditem->title = $request->title;
        $fooditem->price = $request->price;
        $fooditem->description = $request->description;
        $fooditem->image = $imagename;
       
        $fooditem->save();
        return redirect()->action('App\Http\Controllers\AdminController@foodmenu')->with('success', 'Food item updated successfully!');
    }
}
