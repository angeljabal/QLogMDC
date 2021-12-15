<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'lname'             => ['required', 'string', 'max:255'],
            'fname'             => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'          => ['required', 'confirmed', Rules\Password::defaults()],
            'type'              => ['required'],
            'brgy'              => ['required', 'string', 'max:255'],
            'city_town'         => ['required', 'string', 'max:255'],
            'province'          => ['required', 'string', 'max:255'],
            'phone_number'      => ['required', 'string', 'max:12']
        ]);

        $user = User::create([
            'name'          => ucwords($request->fname . " " . $request->lname),
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
            'type'          => $request->type
        ]);

        $user->profile()->create([
            'address' => $request->brgy. ', ' . $request->city_town . ', ' . $request->province,
            'phone_number' => $request->phone_number
        ]);

        event(new Registered($user));

        // Auth::login($user);
        // Mail::send('auth.verify-email', ['user'=>$user], function($mail) use ($user){
        //     $mail->to($user->email);
        //     $mail->subject('Account Verification');
        //     $mail->from('mdc-qlog@gmail.com', 'QLOG System');
        // });
        $user->assignRole('user');
        Auth::login($user);

        return redirect(RouteServiceProvider::HOME)->with('status', 'verification-link-sent');
    }
}
