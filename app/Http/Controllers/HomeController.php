<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function display() {
       
        $profiles = Profile::select('id', 'year', 'department_id','user_id')
            ->with(['user:id,name','department:id,acronym'])->paginate(10);

        // dd($profiles);

        return view('public.users.index', compact('profiles'));

    }
}
