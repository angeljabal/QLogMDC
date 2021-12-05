<?php

namespace App\Http\Livewire\Admin\Dashboard\Partials;

use Carbon\Carbon;
use Livewire\Component;

class Range extends Component
{
    public $dateStr, $selectedDates;
    
    public function mount(){
        $this->dateStr = Carbon::now()->format('M d, Y');
    }

    public function dateRange($selectedDates, $date){
        $this->dateStr = $date;
        $this->selectedDates = $selectedDates;
    }

    public function render()
    {
        return view('livewire.admin.dashboard.partials.range');
    }
}
