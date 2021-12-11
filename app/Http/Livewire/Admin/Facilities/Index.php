<?php

namespace App\Http\Livewire\Admin\Facilities;

use App\Models\Facility;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $confirmingFacilityAdd = false;
    public $confirmingFacilityDeletion = false;
    public $facility, $facility_name, $name, $code, $head, $isOpen, $status, $search, $heads, $allHeads, $unavailableHeads;
    public $link = '/admin/facilities';

    public function mount(){
        $this->status = 'all';
        $this->heads = User::role('head')->select('id', 'name')->get();
        $this->allHeads = $this->heads->count();
        foreach($this->heads as $head){
            if($head->facility!=null){
                $this->unavailableHeads++;
            }
        }
    }

    public function loadFacilities(){
        $query = Facility::orderBy('name')->with('user:id,name')->search($this->search);
        if($this->status!='all'){
            $query->where('isOpen', $this->status);
        }
        $facilities = $query->paginate(10);
        return compact('facilities');
    }

    public function confirmFacilityDeletion($facilityId){
        $this->facility = Facility::where('id', $facilityId)->firstOrFail();
        $this->facility_name = $this->facility->name;
        $this->confirmingFacilityDeletion = true;
    }

    public function deleteFacility(){
        $this->currentHead = User::find($this->facility->user_id);
        $this->currentHead->removeRole('head');
        $this->facility->delete();
        $this->confirmingFacilityDeletion = false;
        return redirect($this->link)->with('deleted', 'Deleted Successfully');
    }

    public function confirmFacilityAdd(){
        $this->facility = null;
        $this->reset('name','code','head');
        $this->confirmingFacilityAdd = true;
    }

    public function confirmFacilityEdit($facilityId){
        $this->facility = Facility::where('id', $facilityId)->firstOrFail();
        $this->name = $this->facility->name;
        $this->code = $this->facility->code;
        $this->head = $this->facility->user->id;
        $this->isOpen = $this->facility->isOpen;
        $this->confirmingFacilityAdd = true;
    }

    public function saveFacility(){
        if(isset($this->facility->id)){
            $this->validate([
                'name'      => 'required|min:5|unique:facilities,name,'.$this->facility->id,
                'code'      => 'required|min:2|unique:facilities,code,'.$this->facility->id,
                'head'      => 'required',
                'isOpen'    => 'required|boolean',
            ]);
            $isHead = User::where('id',$this->head)->role('head')->exists();
            if($isHead){
                $this->facility->update([
                    'name'      => ucwords($this->name),
                    'code'      => strtoupper($this->code),
                    'user_id'   => $this->head,
                    'isOpen'    => $this->isOpen
                ]);
                return redirect($this->link)->with('message', 'Updated Successfully');
            }else{
                return redirect($this->link)->with('deleted', 'Failed to update.');
            }

        }else{
            $this->validate([
                'name'      => 'required|unique:facilities,name',
                'code'      => 'required|min:2|unique:facilities,code',
                'head'      => 'required'
            ]);
            $isHead = User::where('id',$this->head)->role('head')->whereDoesntHave('facility')->exists();
            if($isHead){
                Facility::create([
                    'name'      => $this->name,
                    'code'      => $this->code,
                    'user_id'   => $this->head
                ]);
                return redirect($this->link)->with('message', 'Added Successfully');
            }else{
                return redirect($this->link)->with('deleted', 'Failed to update.');
            }

        }
    }

    public function render()
    {
        return view('livewire.admin.facilities.index', $this->loadFacilities());
    }
}
