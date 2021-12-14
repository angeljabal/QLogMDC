<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Facility;
use App\Models\Log;
use Carbon\Carbon;
use Livewire\Component;

class Admin extends Component
{
    protected $listeners = ['selectedDates' => 'setDateRange'];

    public $serving, $waiting, $completed, $walkIns, $facilitiesAvailable, $transactions, $startDate, $endDate;

    public function mount(){
        $this->startDate = Carbon::today();
        $this->endDate = Carbon::today();
        $this->loadData();
    }

    public function loadData($dateRange=null){
        $logQuery = Log::toBase()
                        ->selectRaw("count(case when status = 'waiting' then 1 end) as waiting")
                        ->selectRaw("count(case when status = 'serving' then 1 end) as serving")
                        ->selectRaw("count(case when status = 'completed' then 1 end) as completed")
                        ->selectRaw("count(case when purpose = 'walk-in' then 1 end) as walk_in");

        if(!is_null($dateRange)){
            $logQuery->whereDate('created_at', '>=', Carbon::parse($dateRange[0]))
                    ->whereDate('created_at', '<=', Carbon::parse($dateRange[1]));
        }else{
            $logQuery->where('created_at', '>=', Carbon::today());
        }

        $logCount = $logQuery->first();
        $this->waiting = $logCount->waiting;
        $this->completed = $logCount->completed;
        $this->walkIns = $logCount->walk_in;
        $this->serving = $logCount->serving;
        $this->transactions = $logQuery->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard.admin');
    }

    public function setDateRange($dateRange)
    {
        $this->loadData($dateRange);  
    }
}
