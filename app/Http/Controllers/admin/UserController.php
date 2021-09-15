<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use File;


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
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|max:10',
            'role' => 'required',
            'password' => 'required|string|min:8',
            //|confirmed
            //'avatar' => 'string',
        ]);

        if($request->avatar){   
            $path = storage_path('img/profile/');

            /* Check if the directory already exists. */
            if(!File::isDirectory($path)){
                /* Directory does not exist, so lets create it. */
                File::makeDirectory($path, 0755, true, true);
            }
                $avatar = time().'.' . explode('/', explode(':', substr($request->avatar, 0, strpos($request->avatar, ';')))[1])[1];
                \Image::make($request->avatar)->save(public_path('img/profile/').$avatar);
                $request->merge(['avatar' => $avatar]);
        }        
        
        return User::create([
           'first_name' => $request['first_name'],
           'last_name' => $request['last_name'],
           'email' => $request['email'],
           'phone' => $request['phone'],
           'role' => $request['role'],
           'password' => \Hash::make($request['password']),
           'avatar' => $avatar,
           //"https://i.picsum.photos/id/1023/200/200.jpg?hmac=MtNMS39i8o8sE6PiXNwABDxNtK4niBxaZWoX5KY3cyg",//$request['avatar'],
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
            'email' => 'required|string|email|max:255|unique:users,email,'.$request->id,
            //unique:users
            'phone' => 'required|max:10',
            'role' => 'required',
            //'password' => 'required|string|min:8',
            // |confirmed
            //'avatar' => 'required',
        ]);

        $user = User::find($id);

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
