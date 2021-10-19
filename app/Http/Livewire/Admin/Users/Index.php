<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Profile;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    public $perPage = 10, $search, $confirmingUserDeletion = false, $user, $name;

    public function loadProfiles()
    {
        $profiles = Profile::select('id', 'address','user_id', 'phone_number')
            ->whereHas('user')
            ->search($this->search)
            ->with(['user:id,name'])
            ->paginate($this->perPage);

        return compact('profiles');
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
