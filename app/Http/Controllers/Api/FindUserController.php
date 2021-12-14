<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class FindUserController extends Controller
{
    public function find(Request $request){
        $request->validate([
            'id'         => 'required|exists:users'
        ]);

        $user = User::where('id',$request->id)->with('profile')->first();
        
        return response()->json([
            'success'       => true,
            'user'         => $user
        ], 202);
    }
}
