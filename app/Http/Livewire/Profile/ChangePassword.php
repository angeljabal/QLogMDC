<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Validation\Rules;

class ChangePassword extends Component
{
    public $password, $old_password, $password_confirmation;
    public function submit()
    {
        $this->validate([
            'old_password'  => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, Auth::user()->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
            'password'  => ['required', 'confirmed', Rules\Password::defaults()],
            'password_confirmation'  => ['required'],
        ]);

        $this->user->update([
            'password'      => Hash::make($this->password)
        ]);
        
        return redirect('profile')->with('message', 'Password Changed Successfully');
    }

    public function back(){
        return redirect('profile');
    }

    public function getUserProperty()
    {
        return User::with('profile')
                ->find(auth()->user()->id);
    }
    
    public function render()
    {
        return view('livewire.profile.change-password');
    }
}
