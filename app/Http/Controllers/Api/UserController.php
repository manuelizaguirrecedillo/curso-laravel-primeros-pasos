<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class UserController extends Controller
{
    
    public function login(Request $request)
    {
       $credentials= [
        'email' => $request->email,
        'password' => $request->password

       ];

       if(Auth::attempt($credentials)){

        $token = Auth::user()->createToken('myapptoken')->plainTextToken;
        session()->put('token', $token);

        return response()->json([
            'isLoggedin' => true,
            'user' => auth()->user(),
            'token' => $token,
         ]);
        
       }
       return response()->json("INVALIDO",422);
    }

   public function logout(){
    [$id,$token] =explode('|', request('token'));
    if(Auth::user())
    //cerrar la sesion de todos los dispoitivios
   // Auth::user()->tokens()->delete();
    //elimiinar una sesion por el 
       Auth::user()->tokens()->where('id',$id)->delete();
       else
        PersonalAccessToken::where('id',$id)->delete();






    session()->flush();

    return response()->json("ok");

   }

   public function checkToken()
   {
    try{

    [$id,$token] =explode('|', request('token'));
    $tokenHash = hash('sha256',$token);
    
    $tokenModel = PersonalAccessToken::where('token',$tokenHash)->first();
    
    if($tokenModel){
        Auth::login($tokenModel->tokenable);
        return response()->json([
            'isLoggedin' => true,
            'user' => auth()->user(),
            'token' => $token,
         ]);
    }

   }
     catch (\Throwable $th){

    }

    return response()->json("USUARIO INVALIDO",422);
}
}
