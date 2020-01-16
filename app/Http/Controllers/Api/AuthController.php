<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request){
        $data = $request->validate([
           'name'=>'required|max:55',
            'email'=>'email|required|unique:users',
            'password'=>'required|confirmed',
            'role'=>''
        ]);

        $data['password'] = bcrypt($request->password);
        $data['role'] = '1';
        User::create($data);

        return $this->login($request);
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if(!auth()->attempt($loginData)) {
            return response(['message'=>'Invalid credentials']);
        }
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
    }
}
