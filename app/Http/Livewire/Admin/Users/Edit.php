<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Facility;
use App\Models\User;
use Exception;
use GuzzleHttp\Psr7\Request;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    public $userId, $name, $email, $phone_number;
    public $address, $type, $role, $roles, $selectedRoles, $types, $brgy, $city_town, $province;
    public $facilities, $facilityId, $facility, $currentHeadId, $currentHead;

    public function mount()
    {
        $this->role = $this->user->roles->pluck('name');
        $this->roles = Role::whereNotIn('name', $this->role)->get();
        $this->selectedRoles = $this->role;

        $this->types = ["Student", "Staff", "Visitor"];
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->type = $this->user->type;
        $this->phone_number = $this->user->profile->phone_number;
        $this->facilityId = 1;

        try{
            $this->address = explode(",",  $this->user->profile->address);
            $this->brgy = $this->address[0];
            $this->city_town = $this->address[1];
            $this->province = $this->address[2];
        }catch(Exception $ex){
            $ex->getMessage();
        }

        if($this->user->role == 'Head' ){
            $this->facilityId = $this->user->facility->id != null ? $this->user->facility->id : 1;
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
            'type'          => $this->type,
        ]);
        
        $this->user->profile()->update([
            'address'       => rtrim($this->address, ','),
            'phone_number'  => $this->phone_number
        ]);

        if($this->role=='head')
        {
            $this->updateFacility($this->facilityId);
        }
        
        $this->user->assignRole($this->role);

        return redirect('/admin/users')->with('message', 'Updated Successfully');
    }

    public function updateFacility($facilityId)
    {
        $this->facility = Facility::find($facilityId);
        if($this->facility->user_id!=null)
        {
            $this->currentHeadId = $this->facility->user_id;
            $this->currentHead = User::find($this->currentHeadId);
            $this->currentHead->removeRole('head');
        }

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
