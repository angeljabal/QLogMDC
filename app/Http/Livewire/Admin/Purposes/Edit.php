<?php

namespace App\Http\Livewire\Admin\Purposes;

use App\Models\Facility;
use App\Models\Purpose;
use Livewire\Component;

class Edit extends Component
{
    public $link = '/admin/purposes';
    public $purposeId, $title, $hasDepartment, $facilities, $facilityIds = [];
    public function mount(){
        $this->title = $this->purpose->title;
        $this->hasDepartment = $this->purpose->hasDepartment;
        $this->facilities = Facility::whereHas('user')->get();
        $this->facilityIds = $this->purpose->facilities()->pluck('id')->toArray();
    }

    public function getPurposeProperty()
    {
        return Purpose::find($this->purposeId);
    }

    public function submit(){
        $this->validate([
            'title'         => 'required|min:3',
            'facilityIds'   => 'required',
        ]);
        $search = 'College of';
        foreach($this->facilityIds as $fac){
            $fac = Facility::select('id', 'name')->where('id', $fac)->first();
            if(preg_match("/{$search}/i", $fac->name)){
                $this->hasDepartment = 1;
                break;
            }else{
                $this->hasDepartment = 0;
            }
        }
        $this->purpose->update([
            'title'         => $this->title,
            'hasDepartment' => $this->hasDepartment
        ]);
        if($this->purpose->facilities()->sync($this->facilityIds)){
            $wasChanged = true;
        }
        return redirect($this->link);
    }

    public function back(){
        return redirect($this->link);
    }
    
    public function render()
    {
        return view('livewire.admin.purposes.edit');
    }
}
