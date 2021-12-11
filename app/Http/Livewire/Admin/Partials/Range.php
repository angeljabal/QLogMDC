<?php

namespace App\Http\Livewire\Admin\Partials;

use Carbon\Carbon;
use Livewire\Component;

class Range extends Component
{
    public $selectedDates;
    
    public function mount(){
        $this->dateStr = Carbon::now()->format('M d, Y');
    }

    public function dateRange($selectedDates){
        $this->selectedDates = $selectedDates;

        if(count($this->selectedDates) > 1)
        {
            $this->emit('selectedDates', $this->selectedDates);
        }
    }

    public function render()
    {
        return view('livewire.admin.partials.range');
    }
}
