<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Department;
use App\Models\User;
use Exception;
use Livewire\Component;

class Edit extends Component
{
    public $userId, $name, $email, $address, $department, $type, $role, $phone_number, $roles, $types, $brgy, $city_town, $province;
    
    public function mount()
    {
        $this->roles = ["User", "Admin", "Facility Head"];
        $this->types = ["Student", "Staff", "Visitor"];        
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->type = $this->user->type;
        $this->role = $this->user->role;
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

    public function getUserProperty()
    {
        return User::with('profile')
                ->find($this->userId);
    }

    public function submit()
    {
        $this->address = $this->brgy . ',' . $this->city_town . ',' . $this->province;
        $this->validate([
            'name'          => 'required|min:3',
            'email'         => 'required|email|max:255|unique:users,email,'.$this->user->id,
            'address'       => 'required|min:3|max:255',
            'type'          => 'required',
            'role'          => 'required',
            'phone_number'  => 'required|max:12'
        ]);

        $this->user->update([
            'name'          => $this->name,
            'email'         => $this->email,
        ]);

        $this->user->profile()->update([
            'address'       => $this->address,
            'phone_number'  => $this->phone_number
        ]);
        // dd($this->user->profile->wasChanged());
        /**
         * $this->user->profile->wasChanged() was not triggered
         */
        if($this->user->wasChanged() || $this->user->profile->wasChanged()){
            return redirect('/admin/users')->with('message', 'Updated Successfully');
        }
        return redirect('/admin/users');
    }

    public function back(){
        return redirect('/admin/users');
    }

    public function render()
    {
        return view('livewire.admin.users.edit');
    }
}
