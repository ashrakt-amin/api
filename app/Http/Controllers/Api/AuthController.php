<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        $user =['email'=>$request->email , 'password'=>$request->password];
        if(auth()->attempt($user)){
        return response()->json(['data'=> ['user' => $user,'token' => $request->user()->createToken('api_token')->plainTextToken],'status'=> true ,'message'=>'success']);
           }else{
            return response()->json(['data'=> [],'status'=> false ,'message'=>'error']);

           }
 
    }

    public function logout(Request $request){
        $user =auth()->user();
        if($user->tokens()->delete()){
        return response()->json(['data'=> [],'status'=> true ,'message'=>'logout'],200);
           }else{
            return response()->json(['data'=> [],'status'=> false ,'message'=>'error'],422);

           }
 
    }
}
