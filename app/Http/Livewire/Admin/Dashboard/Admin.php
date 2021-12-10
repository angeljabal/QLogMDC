<?php

namespace App\Http\Livewire\Admin\Dashboard;

use Livewire\Component;

class Admin extends Component
{
    protected $listeners = ['updateCounter' => 'myOwnfunction'];

    public function render()
    {
        return view('livewire.admin.dashboard.admin');
    }

    public function myOwnfunction($dateRange)
    {
        dd($dateRange);
    }
}
