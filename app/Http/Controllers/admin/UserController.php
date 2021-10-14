<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function display() {

        return view('public.users.index');

    }

    public function edit(Profile $user){
        return view('public.users.edit', ['user'=>$user]);
    }
}
