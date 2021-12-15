<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Exception;
use Livewire\Component;

class Edit extends Component
{
    public $name, $email, $phone_number;
    public $address, $type, $roles, $types, $brgy, $city_town, $province;
    
    public function mount()
    {
        $this->name = $this->user->name;
        $this->phone_number = $this->user->profile->phone_number;

        try{
            $this->address = explode(",",  $this->user->profile->address);
            $this->brgy = $this->address[0];
            $this->city_town = $this->address[1];
            $this->province = $this->address[2];
        }catch(Exception $ex){
            $ex->getMessage();
        }

    }

    public function submit()
    {
        $this->address = $this->brgy . ',' . $this->city_town . ',' . $this->province;
        $this->validate([
            'name'              => 'required|min:3',
            'address'           => 'required|min:3|max:255',
            'phone_number'      => 'required'
        ]);

        $this->user->update([
            'name'          => ucwords($this->name)
        ]);
        
        $this->user->profile()->update([
            'address'       => rtrim($this->address, ','),
            'phone_number'  => $this->phone_number
        ]);
        
        return redirect('/profile')->with('message', 'Updated Successfully');
    }

    public function back(){
        return redirect('/profile');
    }

    public function getUserProperty()
    {
        return User::with('profile')
                ->find(auth()->user()->id);
    }

    
    public function render()
    {
        return view('livewire.profile.edit');
    }
}
