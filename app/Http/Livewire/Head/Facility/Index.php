<?php

namespace App\Http\Livewire\Head\Facility;

use App\Models\Log;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = ['selectedDates' => 'setDateRange'];
    public $isOpen, $startDate, $endDate;

    public function mount(){
        $this->isOpen = auth()->user()->facility->isOpen;
    }

    public function loadLogs(){
        $query = Log::orderBy('created_at', 'DESC')->where('facility_id', auth()->user()->facility->id);

        if(isset($this->startDate)){
            $query->whereDate('created_at', '>=', $this->startDate)
                    ->whereDate('created_at', '<=', $this->endDate);
        }
        
        $logs = $query->paginate(10);
        return compact('logs');
    }

    public function setDateRange($dateRange)
    {
        $this->startDate = Carbon::parse($dateRange[0]);
        $this->endDate = Carbon::parse($dateRange[1]);
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
