<?php

namespace App\Http\Livewire\Admin\Purposes;

use App\Models\Facility;
use App\Models\Office;
use App\Models\Purpose;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Index extends Component
{
    public $perPage = 10;
    public $confirmingPurposeAdd = false;
    public $confirmingPurposeDeletion = false;
    public $purpose, $title, $facilities, $assignedFacilities, $facility, $search;

    public function mount()
    {
        $this->facilities = Office::all();
        $this->assignedFacilities = [];
    }

    public function loadPurposes()
    {
        $query = Purpose::with('offices')->orderBy('title')->search($this->search);
        if ($this->facility != 0) {
            $query->whereHas('offices', function (Builder $q) {
                $q->where('facility_id', 'like', $this->facility);
            });
        }

        $purposes = $query->paginate(10);
        return compact('purposes');
    }

    public function addPurpose()
    {
        return redirect('/admin/purposes/create');
    }

    public function confirmPurposeAdd()
    {
        $this->confirmingPurposeAdd = true;
    }

    public function back()
    {
        return redirect('/admin/purposes');
    }

    public function confirmPurposeEdit($purposeId)
    {
        $this->purpose = Purpose::where('id', $purposeId)->firstOrFail();
        $this->title = $this->purpose->title;
        $this->confirmingPurposeAdd = true;
    }

    public function confirmPurposeDeletion($purposeId)
    {
        $this->purpose = Purpose::where('id', $purposeId)->firstOrFail();
        $this->title = $this->purpose->title;
        $this->confirmingPurposeDeletion = true;
    }

    public function deletePurpose()
    {
        $this->purpose->delete();
        $this->confirmingPurposeDeletion = false;
        return redirect('/admin/purposes')->with('message', 'Deleted Successfully');
    }

    public function render()
    {
        return view('livewire.admin.purposes.index', $this->loadPurposes());
    }
}