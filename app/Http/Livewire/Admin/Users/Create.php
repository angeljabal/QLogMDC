<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Facility;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Create extends Component
{
    public $name, $email, $phone_number, $password;
    public $address, $type, $roles, $types, $brgy, $city_town, $province;
    public $facilities, $facilityId, $facility;
    public $role = [];

    public function mount(){
        $this->types = ["Student", "Staff", "Visitor"];
        $this->roles = Role::select('id', 'name')->orderBy('id')->get();
        $this->facilities = Facility::all();
        $this->password = 'qlog2021';
    }

    public function submit(){
        $this->validate([
            'name'              => ['required', 'string', 'max:255'],
            'email'             => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'type'              => ['required'],
            'brgy'              => ['required', 'string', 'max:255'],
            'city_town'         => ['required', 'string', 'max:255'],
            'province'          => ['required', 'string', 'max:255'],
            'phone_number'      => ['required', 'string', 'max:12'],
            'role'              => ['required']
        ]);
        $this->address = $this->brgy . ',' . $this->city_town . ',' . $this->province;
        $user = User::create([
            'name'              => ucfirst($this->name),
            'email'             => $this->email,
            'password'          => Hash::make($this->password),
            'type'              => $this->type,
            'email_verified_at' => Carbon::now()
        ]);

        $user->profile()->create([
            'address' => ucfirst($this->address),
            'phone_number' => $this->phone_number
        ]);

        if(in_array('head', $this->role) && $this->facilityId!=null)
        {
            $this->updateFacility($this->facilityId);
        }

        $user->assignRole($this->role);
        return redirect('/admin/users')->with('message', 'Updated Successfully');
    }

    public function back(){
        return redirect('/admin/users');
    }

    public function updateFacility($facilityId)
    {
        $this->facility = Facility::find($facilityId);
        $this->facility->update(['user_id' => $this->user->id]);
    }


    public function render()
    {
        return view('livewire.admin.users.create');
    }
}
