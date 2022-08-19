<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\QueryFilters\Admin;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if(!$data) {
            return response()->fail(400, 'Try Again !');
        }

        $user = User::where('email', $request->email)->first();
        // print_r($data);
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->fail(404, 'These credentials do not match our records.');
        }
        $token = $user->createToken('my-app-token')->plainTextToken;
        $response = [
            'user' => $user,
            'token' => $token
        ];
        return response($response, 201);
    }


    public  function register(Request $request)
    {

        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'is_admin' => ['boolean'],
        ]);

        if (!$data) {
            return response()->fail(400, 'Try Again !');
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'is_admin' => $request->is_admin ?? 0,
        ]);
        $token = $user->createToken('my-app-token')->plainTextToken;

        if($user && $token){

            $user->topics()->attach([2, 3]); // attach([1, 2])

            $response = [
                'user' => $user,
                'token' => $token
            ];
            return response()->success($response);
        }
    }



    public function logout(Request $request)
    {

        if ($request->user()) {
            $request->user()->tokens()->delete();
        }
        return response()->success(200, 'user logged out');
    }




    public function pipeline(){


        $pipelines = app(Pipeline::class)
            ->send(User::query())
            ->through([
                Admin::class
                ])
            ->thenReturn();
        $users = $pipelines->get();
        return view('users-pipeline', compact('users'));


        // $users = User::query();
        // if(request()->has('isAdmin')){
        //     $users->where('is_admin', request('isAdmin'))->get();
        // }
        // $users = $users->get();
        // return view('users-pipeline', compact('users'));
    }
}
