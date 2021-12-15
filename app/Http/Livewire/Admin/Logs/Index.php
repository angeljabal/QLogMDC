<?php

namespace App\Http\Livewire\Admin\Logs;

use App\Exports\LogExport;
use App\Models\Facility;
use App\Models\Log;
use App\Models\Purpose;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Index extends Component
{
    use WithPagination;

    protected $listeners = ['selectedDates' => 'setDateRange'];
    public $facilities, $purposes, $facility, $startDate, $endDate;
    
    public function mount(){
        $this->facility=0;
        $this->facilities = Facility::all();
        if(session('purpose')){
            $this->facility = -1;
        }
    }

    public function loadLogs(){
        $query = Log::orderBy('created_at', 'DESC');

        if(session('status')){
            $query->where('status', 'waiting');
        }

        if($this->facility!=0 && $this->facility!=-1){
            $query->where('facility_id', $this->facility);
        }
        
        if($this->facility==-1){
            $query->where('purpose', "Walk-in");
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

    public function export() 
    {
        return Excel::download(new LogExport($this->facility, $this->startDate, $this->endDate), 'log.xlsx');
    }

    public function render()
    {
        return view('livewire.admin.logs.index', $this->loadLogs());
    }
}
