<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Userdata;
use App\User;

class UserController extends Controller
{

	public $public_folder = "uploads";

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
       $this->validate($request, [
            'description'=>'required',
            'file'=> 'required|mimes:png,jpg,jpeg',
            'user_id'=> 'required'
        ]);

        $img = $request->file;

        $imgName = $img->getClientOriginalName();

        $img->move(public_path($this->public_folder), $imgName);
       
        $data =  [
        	'description' => $request['description'],
        	'file'		=>	$imgName,
        	'user_id'	=>	$request['user_id']
        ];

        $userdata->userData($data);

        return redirect()->route('home')->with('success',"User comment has been added");
	}
	// function to delete Data against User
	public function deleteData($id)
	{
		$userid = $id;
		$user = Userdata::where('id', $id)->delete();
		return redirect()->route('home')->with('success',"Deleted Successfully");
	}


	public function saveImage(Request $req)
	{
		dd($req);
	}


	public function delImg(Request $req)
	{
		$id = $req->key;

		$user = Userdata::find($id);

		if($user->delete())
		{
			return response()->json(["status" => "200"]);
		}
	}
}
