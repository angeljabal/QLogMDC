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
    public $facility, $facility_name, $name, $code, $head, $isOpen, $status, $search;
    public $link = '/admin/facilities';

    public function mount(){
        $this->status = 'all';
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
        $this->head = $this->facility->user->name;
        $this->isOpen = $this->facility->isOpen;
        $this->confirmingFacilityAdd = true;
    }

    public function saveFacility(){
        if(isset($this->facility->id)){
            $this->validate([
                'name'      => 'required|min:5|unique:facilities,name,'.$this->facility->id,
                'code'      => 'required|min:2|unique:facilities,code,'.$this->facility->id,
                'head'      => 'required|exists:users,name',
                'isOpen'    => 'required|boolean',
            ],[
                'head.exists'   => 'User does not exists.'
            ]);

            $this->currentHead = User::find($this->facility->user_id);
            $this->currentHead->removeRole('head');
            $user = User::where('name', $this->head)->select('id')->first();
            $user->assignRole('head');
            $this->facility->update([
                'name'      => ucwords($this->name),
                'code'      => strtoupper($this->code),
                'user_id'   => $user->id,
                'isOpen'    => $this->isOpen
            ]);
            return redirect($this->link)->with('message', 'Updated Successfully');
        }else{
            $this->validate([
                'name'      => 'required|unique:facilities,name',
                'code'      => 'required|min:2|unique:facilities,code',
                'head'      => 'required|exists:users,name'
            ]);
            $user = User::where('name', $this->head)->select('id')->first();
            $user->assignRole('head');
            Facility::create([
                'name'      => $this->name,
                'code'      => $this->code,
                'user_id'   => $user->id
            ]);
            return redirect($this->link)->with('message', 'Added Successfully');
        }
    }

    public function render()
    {
        return view('livewire.admin.facilities.index', $this->loadFacilities());
    }
}
