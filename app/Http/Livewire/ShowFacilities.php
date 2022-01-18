<?php

namespace App\Http\Livewire;

use App\Models\Facility;
use Livewire\Component;
use Livewire\WithPagination;

class ShowFacilities extends Component
{
    use WithPagination;
    public $status, $search;

    public function mount(){
        $this->status = 'all';
    }

    public function loadFacilities(){
        $query = Facility::orderBy('name')->search($this->search);
        if($this->status!='all'){
            $query->where('isOpen', $this->status);
        }
        $facilities = $query->paginate(10);
        return compact('facilities');
    }
    
    public function render()
    {
        return view('livewire.show-facilities', $this->loadFacilities());
    }
}
