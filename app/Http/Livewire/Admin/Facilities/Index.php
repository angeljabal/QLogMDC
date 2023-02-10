<?php

namespace App\Http\Livewire\Admin\Facilities;

use App\Models\Facility;
use App\Models\Office;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $confirmingFacilityAdd = false;
    public $confirmingFacilityDeletion = false;
    public $facility, $facility_name, $name, $code, $head, $isOpen, $status, $search, $heads, $allHeads, $unavailableHeads;
    public $link = '/admin/facilities';

    public function mount()
    {
        $this->status = 'all';
        $this->heads = User::whereHas(
            'roles',
            function (Builder $q) {
                $q->where('role', 'office-head');
            }
        )->select('id', 'lname', 'fname')->get();
        $this->allHeads = $this->heads->count();
        foreach ($this->heads as $head) {
            if ($head->facility != null) {
                $this->unavailableHeads++;
            }
        }
    }

    public function loadFacilities()
    {
        $query = Office::orderBy('name')->with('user:id,fname,lname')->search($this->search);
        if ($this->status != 'all') {
            $query->where('isOpen', $this->status);
        }
        $facilities = $query->paginate(10);
        return compact('facilities');
    }

    public function confirmFacilityDeletion($facilityId)
    {
        $this->facility = Office::where('id', $facilityId)->firstOrFail();
        $this->facility_name = $this->facility->name;
        $this->confirmingFacilityDeletion = true;
    }

    public function deleteFacility()
    {
        // $this->currentHead = User::find($this->facility->user_id);
        // if($this->currentHead!=null && $this->currentHead->hasRole('head')){
        //     $this->currentHead->removeRole('head');
        // }
        $this->facility->delete();
        $this->confirmingFacilityDeletion = false;
        return redirect($this->link)->with('message', 'Deleted Successfully');
    }

    public function confirmFacilityAdd()
    {
        $this->facility = null;
        $this->reset('name', 'head');
        $this->confirmingFacilityAdd = true;
    }

    public function confirmFacilityEdit($facilityId)
    {
        $this->facility = Office::where('id', $facilityId)->firstOrFail();
        $this->name = $this->facility->name;
        $this->head = optional($this->facility->user)->id;
        $this->isOpen = $this->facility->isOpen;
        $this->confirmingFacilityAdd = true;
    }

    public function saveFacility()
    {
        if (isset($this->facility->id)) {
            $this->validate([
                'name'      => 'required|min:5|unique:offices,name,' . $this->facility->id,
                'isOpen'    => 'required|boolean',
            ]);
            $isHead = User::where('id', $this->head)->whereHas(
                'roles',
                function (Builder $q) {
                    $q->where('role', 'office-head');
                }
            )->exists();
            if ($isHead) {
                $this->facility->update([
                    'name'      => ucwords($this->name),
                    'user_id'   => $this->head,
                    'isOpen'    => $this->isOpen
                ]);
                return redirect($this->link)->with('message', 'Updated Successfully');
            }
        } else {
            $this->validate([
                'name'      => 'required|unique:offices,name',
            ]);
            // if (isset($this->head)) {
            //     $isHead = User::where('id', $this->head)->hasRole('head')->whereDoesntHave('facility')->exists();
            //     if ($isHead) {
            //         Office::create([
            //             'name'      => ucwords($this->name),
            //             'code'      => strtoupper($this->code),
            //             'user_id'   => $this->head
            //         ]);
            //     }
            // } else {
            //     Office::create([
            //         'name'      => ucwords($this->name),
            //         'code'      => strtoupper($this->code)
            //     ]);
            // }
            Office::create([
                'name'      => ucwords($this->name),
                'user_id'   => $this->head
            ]);
            return redirect($this->link)->with('message', 'Added Successfully');
        }
        return redirect($this->link)->with('error', 'Failed to update.');
    }

    public function render()
    {
        return view('livewire.admin.facilities.index', $this->loadFacilities());
    }
}