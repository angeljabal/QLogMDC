<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(){
        return view('public.profile.show');
    }

    public function edit(){
        return view('public.profile.edit');
    }

    public function changePassword(){
        return view('public.profile.change-password');
    }
}
