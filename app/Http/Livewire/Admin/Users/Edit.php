<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Department;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{
    public $userId, $departments, $name, $email, $address, $department;
    
    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'address' => 'required|min:3',
    ];

    public function mount()
    {
        $this->departments = Department::pluck('acronym','id')->toArray();
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->address = $this->user->profile->address;
        $this->department = $this->user->profile->department_id;
    }

    public function getUserProperty()
    {
        return User::with(['profile' => function($query){
                    return $query->with('department');
                }])
                ->find($this->userId);
    }

    public function submit()
    {
        $this->validate();

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        $this->user->profile()->update([
            'address' => $this->address,
            'department_id' => $this->department
        ]);
        
    }

    public function render()
    {
        
        return view('livewire.admin.users.edit');
    }
}
