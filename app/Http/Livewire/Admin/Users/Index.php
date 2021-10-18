<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Profile;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    public $perPage = 10, $search;

    public function loadProfiles()
    {
        $profiles = Profile::select('id', 'address','user_id', 'phone_number')
            ->search($this->search)
            ->with(['user:id,name','department:id,acronym'])->paginate(10);
        // dd($profiles);

        return compact('profiles');
    }

    public function render()
    {
        return view('livewire.admin.users.index', $this->loadProfiles());
    }
}
