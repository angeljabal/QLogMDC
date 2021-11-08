<?php

namespace App\Http\Livewire\Admin\Purposes;

use App\Models\Facility;
use App\Models\Purpose;
use Livewire\Component;

class Show extends Component
{
    public $purposeId, $facilities, $facilityId;

    public function mount(){
        $this->facilities = Facility::all(); 
    }

    public function getPurposeProperty()
    {
        // $purpose = Purpose::with(['facilities'])
        //         ->find($this->purposeId);
        //         dd($purpose);
        return Purpose::with(['facilities'])
                ->find($this->purposeId);
    }

    public function render()
    {
        return view('livewire.admin.purposes.show');
    }
}
