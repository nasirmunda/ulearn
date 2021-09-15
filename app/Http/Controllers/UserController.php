<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {  

        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|max:10',
            'role' => 'required',
            'password' => 'required|string|min:8|confirmed',
            'avatar' => 'required',
        ]);

        return User::create([
           'first_name' => $request['name'],
           'last_name' => $request['last_name'],
           'email' => $request['email'],
           'phone' => $request['phone'],
           'role' => $request['role'],
           'password' => \Hash::make($request['password']),
           'avatar' => $request['avatar'],
        ]);
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {   
        $this->validate($request, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|max:10',
            'role' => 'required',
            'password' => 'required|string|min:8|confirmed',
            'avatar' => 'required',
        ]);

        $user = User::findOrFail($id);

        $user->update($request->all());
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json([
         'message' => 'User deleted successfully'
        ]);
    }
}
