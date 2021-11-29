<?php

namespace App\Http\Livewire\Head\Facility;

use App\Models\Facility;
use App\Models\Log;
use Livewire\Component;

class Index extends Component
{
    public $isOpen;

    public function mount(){
        $this->isOpen = auth()->user()->facility->isOpen;
    }

    public function loadLogs(){
        $logs = Log::orderBy('created_at', 'DESC')->paginate(10);
        return compact('logs');
    }

    public function changeStatus(){
        $facility = auth()->user()->facility;
        $this->isOpen ? $facility->update(['isOpen' => 0]) : $facility->update(['isOpen' => 1]);
        $this->isOpen = auth()->user()->facility->isOpen;
    }
    
    public function render()
    {
        return view('livewire.head.facility.index', $this->loadLogs());
    }
}
