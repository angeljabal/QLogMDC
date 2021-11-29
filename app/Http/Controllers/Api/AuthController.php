<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'lname' => ['required', 'string', 'max:255'],
            'fname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'type'  => ['required'],
            'brgy'   => ['required', 'string', 'max:255'],
            'city_town'   => ['required', 'string', 'max:255'],
            'province'   => ['required', 'string', 'max:255'],
            'phone_number'    => ['required', 'string', 'max:12']
        ]);

        $user = User::create([
            'name' => $request->fname . " " . $request->lname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type'  => $request->type
        ]);

        $user->profile()->create([
            'address' => $request->brgy. ', ' . $request->city_town . ', ' . $request->province,
            'phone_number' => $request->phone_number
        ]);
        $user->assignRole('user');
        Auth::login($user);
        
        return response()->json(
            ['message'   =>  'Registration Success'], 202);
    }

    public function login(Request $request){
        $creds = $request->only('email', 'password');

        if(!$token = auth()->attempt($creds)){
            return response()->json(
                ['error' =>  'Unauthorised'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me(){
        return response()->json(auth()->user());
    }

    public function logout(){
        auth()->logout();
        return response()->json(['message'  =>  'Successfully logged out']);
    }

    private function respondWithToken($token){
        return response()->json([
            'access token'  => $token,
            'token type'    => 'bearer',
            'expires in'    => auth('api')->factory()->getTTL() * 60
        ]);
    }
}
