<?php

namespace App\Http\Livewire\Queue;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Landing extends Component
{
    public $userId;
    public $confirmingTransaction = false;
    public $user;

    public function login()
    {
        $login = Auth::loginUsingId($this->userId);
        if (!$login) {
            $this->userId = '';
        }
    }
    public function render()
    {
        return view('livewire.queue.landing');
    }
}