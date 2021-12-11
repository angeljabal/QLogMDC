<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Log;
use Carbon\Carbon;
use Livewire\Component;

class Head extends Component
{
    public $startDate, $endDate, $waiting, $completed, $transactions;
    protected $listeners = ['selectedDates' => 'setDateRange'];

    public function mount(){
        $this->startDate = Carbon::today();
        $this->endDate = Carbon::today();
        $this->loadData();
    }

    public function countLogs($term){
        if($this->startDate==$this->endDate){
            $log = Log::where('facility_id', auth()->user()->facility->id)
                ->where('status', $term)
                ->where('created_at', '>=', $this->startDate)->count();
        }else{
            $log = Log::where('facility_id', auth()->user()->facility->id)
                ->where('status', $term)
                ->where('created_at', '>=', $this->startDate)
                ->where('created_at', '<=', $this->endDate)
                ->count();
        }

       return $log;
    }

    public function countTotalTransactions(){
        if($this->startDate==$this->endDate){
            $count = Log::where('facility_id', auth()->user()->facility->id)->where('created_at', '>=', $this->startDate)->count();
        }else{
            $count = Log::where('facility_id', auth()->user()->facility->id)
                        ->where('created_at', '>=', $this->startDate) ->where('created_at', '<=', $this->endDate)->count();
        }

        return $count;
    }

    public function loadData(){
        $this->waiting = $this->countLogs('waiting');
        $this->completed = $this->countLogs('completed');
        $this->transactions = $this->countTotalTransactions();
    }

    public function setDateRange($dateRange)
    {          
        $this->startDate = Carbon::parse($dateRange[0]);
        $this->endDate = Carbon::parse($dateRange[1]);
        $this->loadData();
    }

    public function render()
    {
        return view('livewire.admin.dashboard.head');
    }
}
