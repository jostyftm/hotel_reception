<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{

	public function all()
	{
		$users = User::role('user')->orderBy('id', 'desc')->get();

		return response()->json($users);
	}

    public function index()
    {
    	return View('users.index');
    }

    public function search(Request $request)
    {
    	$users = User::where('identification_number', 'like', "%{$request->identification}%")->get();

    	return response()->json($users);
    }

    public function show(User $user)
    {
    	return response()->json($user);
    }

    public function store(Request $request)
    {
        $user = new User($request->all());
        $user->username = $request->identification_number;
        $user->password = bcrypt($request->identification_number);
        $user->save();

        $user->assignRole('user');

        return response()->json($user);
    }
}
