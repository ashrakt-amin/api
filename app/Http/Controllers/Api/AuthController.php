<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = ['email' => $request->email, 'password' => $request->password];
        if (auth()->attempt($user)) {
            return response()->json(['data' => ['user' => $user, 'token' => $request->user()->createToken('api_token')->plainTextToken], 'status' => true, 'message' => 'success']);
        } else {
            return response()->json(['data' => [], 'status' => false, 'message' => 'error']);
        }
    }

    public function logout(Request $request)
    {
        $user = auth()->user();
        if ($user->tokens()->delete()) {
            return response()->json(['data' => [], 'status' => true, 'message' => 'logout'], 200);
        } else {
            return response()->json(['data' => [], 'status' => false, 'message' => 'error'], 422);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::create([
            'name'     => $request['name'],
            'email'    => $request['email'],
            'password' => bcrypt($request['password']),
        ]);

        $token =  $user->createToken('Auth')->plainTextToken;
        return  response()->json(['data' =>[
            'token'           => $token,
            'id'              => $user->id,
            'name'            => $user->name,
            'email'           => $user->email,

        ]], 200);
    }
}
