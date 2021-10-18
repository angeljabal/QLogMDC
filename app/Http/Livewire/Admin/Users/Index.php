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
        $profiles = Profile::select('id', 'address', 'department_id','user_id')
            ->search($this->search)
            ->with(['user:id,name','department:id,acronym'])->paginate(10);
        // dd($profiles);

        return compact('profiles');
    }

    public function deleteUser(){
        $this->user->delete();
        $this->confirmingUserDeletion = false;
        return redirect('/admin/users')->with('delete', 'Deleted Successfully');
    }
    public function confirmItemDeletion($userId) 
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
