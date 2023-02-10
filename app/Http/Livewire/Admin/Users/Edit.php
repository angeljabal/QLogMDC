<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Facility;
use App\Models\Office;
use App\Models\User;
use Exception;
use Livewire\Component;
use App\Models\Role;

class Edit extends Component
{
    public $userId, $fname, $lname, $email, $phone_number;
    public $address, $type, $roles, $types, $brgy, $city_town, $province;
    public $facilities, $facilityId, $facility, $currentHeadId, $currentHead, $officeHeadId;
    public $role = [];
    public function mount()
    {
        $this->role = $this->user->roles->pluck('id')->toArray();
        $this->roles = Role::select('id', 'role')->orderBy('id')->get();

        $this->types = ["Student", "Staff", "Visitor"];
        $this->fname = $this->user->fname;
        $this->lname = $this->user->lname;
        $this->email = $this->user->email;
        $this->facilityId = 0;

        $this->officeHeadId = Role::where('role', 'office-head')->first()->id;
        // if (in_array('head', $this->role) && isset($this->user->office->id)) {
        //     $this->facilityId = $this->user->facility->id != null ? $this->user->facility->id : 0;
        // }
        if (in_array($this->officeHeadId, $this->role) && isset($this->user->office->id)) {
            $this->facilityId = $this->user->office->id != null ? $this->user->office->id : 0;
        }

        $this->facilities = Office::all();
    }

    public function getUserProperty()
    {
        return User::find($this->userId);
    }

    public function submit()
    {
        $this->validate([
            'role'               => 'required|array|min:1',
        ]);

        if (in_array('head', $this->role) && $this->facilityId != null) {
            $this->updateFacility($this->facilityId);
        }

        $this->user->roles()->sync($this->role);
        return redirect('/admin/users')->with('message', 'Updated Successfully');
    }

    public function updateFacility($facilityId)
    {
        if (isset($this->user->facility->id)) {
            $oldFaci = Facility::findOrFail($this->user->facility->id);
            $oldFaci->update(['user_id' => null]);
        }
        if ($facilityId != 'None') {
            $this->facility = Facility::findOrFail($facilityId);
            $this->facility->update(['user_id' => $this->user->id]);
        }
    }

    public function back()
    {
        return redirect('/admin/users');
    }

    public function render()
    {
        return view('livewire.admin.users.edit');
    }
}