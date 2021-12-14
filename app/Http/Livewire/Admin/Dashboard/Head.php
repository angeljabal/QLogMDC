<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Log;
use Carbon\Carbon;
use Livewire\Component;

class Head extends Component
{
    public $waiting, $completed, $transactions;
    protected $listeners = ['selectedDates' => 'setDateRange'];

    public function mount(){
        $this->loadData();
    }

    public function loadData($dateRange=null){
        $logQuery = Log::toBase()
                        ->selectRaw("count(case when status = 'waiting' then 1 end) as waiting")
                        ->selectRaw("count(case when status = 'serving' then 1 end) as serving")
                        ->selectRaw("count(case when status = 'completed' then 1 end) as completed")
                        ->where('facility_id', auth()->user()->facility->id);
        
        if(!is_null($dateRange)){
            $logQuery->whereDate('created_at', '>=', Carbon::parse($dateRange[0]))
                    ->whereDate('created_at', '<=', Carbon::parse($dateRange[1]));
        }else{
            $logQuery->where('created_at', '>=', Carbon::today());
        }

        $logCount = $logQuery->first();
        $this->waiting = $logCount->waiting;
        $this->completed = $logCount->completed;
        $this->transactions = $logQuery->count();
    }

    public function setDateRange($dateRange)
    {   
        $this->loadData($dateRange);
    }

    public function render()
    {
        return view('livewire.admin.dashboard.head');
    }
}
