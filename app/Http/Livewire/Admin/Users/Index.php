<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    use WithPagination;
    
    public $perPage, $search, $confirmingUserDeletion = false, $user, $name;
    public $role, $roles, $types, $type;

    public function mount(){
        $this->perPage = 10;
        $this->role = $this->type = 'all';
        $this->roles = Role::all();
        $this->types = ["Student", "Staff", "Visitor"];
    }

    public function loadProfiles()
    {
        $query = User::select('id', 'name', 'type')->whereHas('profile')->with('profile')->search($this->search);

        if($this->type!='all'){
            $query->where('type', $this->type);
        }

        if($this->role!='all'){
            $query->role($this->role);
        }

        $users = $query->paginate($this->perPage);

        return compact('users');
    }
    public function back(){
        return redirect('/admin/users');
    }
    
    public function deleteUser(){
        $this->user->delete();
        $this->confirmingUserDeletion = false;
        return redirect('/admin/users')->with('deleted', 'Deleted Successfully');
    }

    public function confirmUserDeletion($userId) 
    {
        $this->user = User::findOrFail($userId);
        $this->name = $this->user->name;
        $this->confirmingUserDeletion = true;
    }
    public function render()
    {
        return view('livewire.admin.users.index', $this->loadProfiles());
    }
}
