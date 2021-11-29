<?php

namespace App\Http\Livewire\Admin\Purposes;

use App\Models\Facility;
use App\Models\Purpose;
use Livewire\Component;

class Edit extends Component
{
    public $purposeId, $title, $facilities, $facilityIds = [];
    public function mount(){
        $this->title = $this->purpose->title;
        $this->facilities = Facility::all();
        $this->facilityIds = $this->purpose->facilities()->pluck('id')->toArray();
    }

    public function getPurposeProperty()
    {
        return Purpose::find($this->purposeId);
    }

    public function submit(){
        $this->validate([
            'title' => 'required|min:3',
        ]);
        $this->purpose->facilities()->sync($this->facilityIds);
        return redirect('/admin/purposes')->with('message', 'Updated Successfully');
    }

    public function back(){
        return redirect('/admin/purposes');
    }
    
    public function render()
    {
        return view('livewire.admin.purposes.edit');
    }
}
