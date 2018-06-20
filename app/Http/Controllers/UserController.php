<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Userdata;
use App\User;

class UserController extends Controller
{
	//function for login view
	public function login(){
		return view('auth/login');
	}
	// function for all users available
	public function showUsers()
	{
		$user = DB::table('users')->get();
		return view('welcome')->with('users', $user);
	}
	// function for selected user profile
	public function userProfile($name)
	{
		$data['user'] = $name;

		$id = User::where('name', '=', $name)->first();

		$data['records'] = Userdata::where('user_id', '=', $id->id)->get();

		$data['user_id'] = $id->id;

		 return view('profile', $data);
	}
	// function to save data against user 
	public function saveData(Request $request)
	{
		$userdata = new Userdata();
        $data = $this->validate($request, [
            'description'=>'required',
            'file'=> 'required',
            'user_id'=> 'required'
        ]);
       
        $userdata->userData($data);

        return redirect()->route('home')->with('success',"User comment has been added");
	}  
}
