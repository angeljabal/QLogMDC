<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShowFacilitiesController extends Controller
{
    public function show(){
        return view('public.facilities');
    }
}
