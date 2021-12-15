<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Facility;
use App\Models\User;
use Exception;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    public $userId, $name, $email, $phone_number;
    public $address, $type, $roles, $types, $brgy, $city_town, $province;
    public $facilities, $facilityId, $facility, $currentHeadId, $currentHead;
    public $role = [];
    public function mount()
    {
        $this->role = $this->user->roles->pluck('name')->toArray();
        $this->roles = Role::select('id', 'name')->orderBy('id')->get();

        $this->types = ["Student", "Staff", "Visitor"];
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->type = $this->user->type;
        $this->phone_number = $this->user->profile->phone_number;
        $this->facilityId = 0;

        try{
            $this->address = explode(",",  $this->user->profile->address);
            $this->brgy = $this->address[0];
            $this->city_town = $this->address[1];
            $this->province = $this->address[2];
        }catch(Exception $ex){
            $ex->getMessage();
        }

        if(in_array('head', $this->role) && isset($this->user->facility->id)){
            $this->facilityId = $this->user->facility->id != null ? $this->user->facility->id : 0;
        }

        $this->facilities = Facility::all();    
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
            'name'              => 'required|min:3',
            'email'             => 'required|email|max:255|unique:users,email,'.$this->user->id,
            'address'           => 'required|min:3|max:255',
            'type'              => 'required',
            'role'              => 'required|array|min:1',
            'phone_number'      => 'required'
        ]);

        $this->user->update([
            'name'          => ucwords($this->name),
            'email'         => $this->email,
            'type'          => $this->type
        ]);
        
        $this->user->profile()->update([
            'address'       => rtrim($this->address, ','),
            'phone_number'  => $this->phone_number
        ]);
        
        if(in_array('head', $this->role) && $this->facilityId!=null)
        {
            $this->updateFacility($this->facilityId);
        }

        $this->user->assignRole($this->role);
        return redirect('/admin/users')->with('message', 'Updated Successfully');
    }

    public function updateFacility($facilityId)
    {
        $this->facility = Facility::findOrFail($facilityId);
        $this->facility->update(['user_id' => $this->user->id]);
    }

    public function back(){
        return redirect('/admin/users');
    }

    public function render()
    {
        return view('livewire.admin.users.edit');
    }
}
