<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Profile;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    public $perPage = 10, $search;

    public function loadProfiles()
    {
        $profiles = Profile::select('id', 'address','user_id', 'phone_number')
            ->whereHas('user')
            ->search($this->search)
            ->with(['user:id,name','department:id,acronym'])->paginate(10);
        // dd($profiles);

        return compact('profiles');
    }

    public function deleteUser($userId){
        $user = User::findOrFail($userId);
        $user->delete();
        return redirect()->back();
    }

    public function render()
    {
        return view('livewire.admin.users.index', $this->loadProfiles());
    }
}
