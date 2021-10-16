<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;

class Show extends Component
{
    public $userId;

    public function getUserProperty()
    {
        return User::with(['profile' => function($query){
                    return $query->with('department');
                }])
                ->find($this->userId);
    }

    public function render()
    {
        return view('livewire.admin.users.show');
    }
}
