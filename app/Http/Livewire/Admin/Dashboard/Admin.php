<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Facility;
use App\Models\Log;
use Carbon\Carbon;
use Livewire\Component;

class Admin extends Component
{
    protected $listeners = ['selectedDates' => 'setDateRange'];

    public $waiting, $completed, $walkIns, $facilitiesAvailable, $transactions, $startDate, $endDate;

    public function mount(){
        $this->startDate = Carbon::today();
        $this->endDate = Carbon::today();
        $this->loadData();
    }

    public function countLogs($column, $term){
        if($this->startDate==$this->endDate){
            $log = Log::where($column, $term)
                ->where('created_at', '>=', $this->startDate)->count();
        }else{
            $log = Log::where($column, $term)
                ->where('created_at', '>=', $this->startDate)
                ->where('created_at', '<=', $this->endDate)
                ->count();
        }

       return $log;
    }

    public function countTotalTransactions(){
        if($this->startDate==$this->endDate){
            $count = Log::where('created_at', '>=', $this->startDate)->count();
        }else{
            $count = Log::where('created_at', '>=', $this->startDate)
                     ->where('created_at', '<=', $this->endDate)->count();
        }

        return $count;
    }

    public function loadData(){
        $this->waiting = $this->countLogs('status','waiting');
        $this->completed = $this->countLogs('status','completed');
        $this->walkIns = $this->countLogs('purpose','walk-in');
        $this->facilitiesAvailable = Facility::where('isOpen', true)->count();
        $this->transactions = $this->countTotalTransactions();
    }

    public function render()
    {
        return view('livewire.admin.dashboard.admin');
    }

    public function setDateRange($dateRange)
    {
        $this->startDate = Carbon::parse($dateRange[0]);
        $this->endDate = Carbon::parse($dateRange[1]);
        $this->loadData();  
    }
}
