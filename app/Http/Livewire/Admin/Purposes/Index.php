<?php

namespace App\Http\Livewire\Admin\Purposes;

use App\Models\Facility;
use App\Models\Purpose;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Index extends Component
{
    public $perPage = 10;
    public $confirmingPurposeAdd = false;
    public $confirmingPurposeDeletion = false;
    public $purpose, $title, $facilities, $assignedFacilities, $facility, $search;

    public function mount(){
        $this->facilities = Facility::all();
        $this->assignedFacilities = [];  
    }

    public function loadPurposes()
    {
        $query = Purpose::orderBy('title')->search($this->search);
        if($this->facility!=0){
            $query->whereHas('facilities', function(Builder $q){
                $q->where('facility_id', 'like', $this->facility);
            });
        }

        $purposes = $query->paginate(10);
        return compact('purposes');
    }

    public function addPurpose(){
        // if( isset( $this->purpose->id)) {
        //     $this->validate([
        //         'title'     => 'required|max:40|unique:purposes,title,'.$this->purpose->id
        //     ]);
        //     $this->purpose->save();
        //     $this->confirmingPurposeAdd = false;
        //     session()->flash('message', 'Saved Successfully');
        // } else {
        //     $this->validate([
        //         'title'     => 'required|max:40|unique:purposes,title,'
        //     ]);
        //     Purpose::create([
        //         'title'   => $this->title
        //     ]);
        //     $this->confirmingPurposeAdd = false;
        //     return redirect('admin/purposes')->with('message', 'Added Successfully');
        // }
        return redirect('/admin/purposes/create');
    }

    public function confirmPurposeAdd() 
    {
        $this->confirmingPurposeAdd = true;
    }
    
    public function back(){
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

    public function deletePurpose(){
        $this->purpose->delete();
        $this->confirmingPurposeDeletion = false;
        return redirect('/admin/purposes')->with('deleted', 'Deleted Successfully');
    }

    public function render()
    {
        return view('livewire.admin.purposes.index', $this->loadPurposes());
    }
}
