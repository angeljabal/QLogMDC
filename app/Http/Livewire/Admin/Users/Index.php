<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Session;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Index extends Component
{
    use WithPagination;
    protected $listeners = ['login'];
    public $perPage, $search, $user, $name;
    public $role, $roles, $types, $type;
    public $confirmingUserDeletion = false;

    public function mount(){
        $this->perPage = 10;
        $this->role = $this->type = 'all';
        $this->roles = Role::all();
        $this->types = ["Student", "Staff", "Visitor"];
    }

    public function loadProfiles()
    {
        $query = User::whereHas('profile')->with('profile')->search($this->search);

        if($this->type!='all'){
            $query->where('type', $this->type);
        }

        if($this->role!='all'){
            $query->role($this->role);
        }

        $users = $query->orderBy('name')->paginate($this->perPage);

        return compact('users');
    }

    public function alertConfirm($userId)
    {
        $this->user = User::findOrFail($userId);
        $this->name = $this->user->name;
        $this->dispatchBrowserEvent('swal:confirm', [
                'type' => 'warning',  
                'message' => "Login as $this->name?"
        ]);
    }

    public function login()
    {
        Session::put('admin_id', auth()->user()->id);
        Auth::login($this->user);
        return redirect('/dashboard');
    }

    public function back(){
        return redirect('/admin/users');
    }
    
    public function deleteUser(){
        $this->user->delete();
        $this->confirmingUserDeletion = false;
        return redirect('/admin/users')->with('message', 'Deleted Successfully');
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
