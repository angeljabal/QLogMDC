<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ShowUsersController extends Controller
{
    public function show(){
        $users = User::select('id', 'name', 'type')
                    ->with('profile:user_id,address,phone_number')
                    ->get();

        return response()->json([
            'success'       => true,
            'users'         => $users
        ], 202);
    }
}
