<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;

class Show extends Component
{
    public $userId;

    public function getUserProperty()
    {
        return User::with(['profile', 'roles'])
                ->find($this->userId);
    }

    public function back(){
        return redirect('/admin/users');
    }

    public function render()
    {
        return view('livewire.admin.users.show');
    }
}
