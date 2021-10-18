<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Department;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public $userId, $name, $email, $address, $department, $type, $role, $phone_number, $roles, $types;
    
    // protected $rules = [
    //     'name'          => 'required|min:3',
    //     'email'         => 'required|email|max:255|unique:users,email,'.$this->user->id,
    //     'address'       => 'required|min:3',
    //     'type'          => 'required',
    //     'role'          => 'required',
    //     'phone_number'  => 'required|max:12'
    // ];

    public function mount()
    {
        $this->roles = ["User", "Admin", "Facility Head"];
        $this->types = ["Student", "Staff", "Visitor"];
        // $this->departments = Department::pluck('acronym','id')->toArray();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->address = $this->user->profile->address;
        // $this->department = $this->user->profile->department_id;
        $this->type = $this->user->type;
        $this->role = $this->user->role;
        $this->phone_number = $this->user->profile->phone_number;
    }

    public function getUserProperty()
    {
        return User::with(['profile'])
                ->find($this->userId);
    }

    public function submit()
    {
        $this->validate([
            'name'          => 'required|min:3',
            'email'         => 'required|email|max:255|unique:users,email,'.$this->user->id,
            'address'       => 'required|min:3',
            'type'          => 'required',
            'role'          => 'required',
            'phone_number'  => 'required|max:12'
        ]);

        $this->user->update([
            'name'  => $this->name,
            'email' => $this->email,
            'role'  => $this->role,
            'type'  => $this->type,
        ]);

        $this->user->profile()->update([
            'address'       => $this->address,
            'phone_number'  => $this->phone_number
        ]);

        return redirect()->route('admin.users.show', ['user'=>$this->user->id])->with('message', 'Updated Successfully');
    }

    public function back(){
        return redirect('/admin/users');
    }

    public function render()
    {
        
        return view('livewire.admin.users.edit');
    }
}
