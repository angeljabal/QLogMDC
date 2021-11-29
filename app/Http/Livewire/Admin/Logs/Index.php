<?php

namespace App\Http\Livewire\Admin\Logs;

use App\Models\Facility;
use App\Models\Log;
use Livewire\Component;

class Index extends Component
{
    public $facilities, $purposes, $facility;
    
    public function mount(){
        $this->facility = 0;
        $this->facilities = Facility::select('id', 'name')->get();
    }

    public function loadLogs(){
        if($this->facility==0){
            $logs = Log::orderBy('created_at', 'DESC')->paginate(10);
        }else{
            $logs = Log::orderBy('created_at', 'DESC')
                    ->where('facility_id', $this->facility)
                    ->paginate(10);
        }
        return compact('logs');
    }

    public function render()
    {
        return view('livewire.admin.logs.index', $this->loadLogs());
    }
}
