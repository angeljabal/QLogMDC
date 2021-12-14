<?php

namespace App\Http\Livewire\Admin\Logs;

use App\Models\Facility;
use App\Models\Log;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $listeners = ['selectedDates' => 'setDateRange'];
    public $facilities, $purposes, $facility, $startDate, $endDate;
    
    public function mount(){
        $this->facility=0;
        $this->facilities = Facility::all();
    }

    public function loadLogs(){
        $query = Log::orderBy('created_at', 'DESC');

        if($this->facility!=0){
            $query->where('facility_id', $this->facility);
        }

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


    public function render()
    {
        return view('livewire.admin.logs.index', $this->loadLogs());
    }
}
