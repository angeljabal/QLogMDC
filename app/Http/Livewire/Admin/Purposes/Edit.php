<?php

namespace App\Http\Livewire\Admin\Purposes;

use App\Models\Facility;
use App\Models\Office;
use App\Models\Purpose;
use Livewire\Component;

class Edit extends Component
{
    public $link = '/admin/purposes';
    public $purposeId;
    public $title;
    public $hasDepartment;
    public $facilities;
    public $selectedOffices;
    public $first;
    public function mount()
    {
        $this->title = $this->purpose->title;
        $this->hasDepartment = $this->purpose->hasDepartment;
        $this->facilities = Office::whereHas('user')->get();
        $this->selectedOffices = $this->purpose->offices()->pluck('id')->toArray();
        $this->first = $this->purpose->office_id;
    }

    public function getPurposeProperty()
    {
        return Purpose::find($this->purposeId);
    }

    public function submit()
    {
        $this->validate([
            'title'             => 'required|min:3'
        ]);
        $search = 'College of';
        foreach ($this->selectedOffices as $fac) {
            $fac = Office::select('id', 'name')->where('id', $fac)->first();
            if (preg_match("/{$search}/i", $fac->name)) {
                $this->hasDepartment = 1;
                break;
            } else {
                $this->hasDepartment = 0;
            }
        }
        $this->purpose->update([
            'title'         => $this->title,
            'hasDepartment' => $this->hasDepartment
        ]);
        if ($this->purpose->offices()->sync($this->selectedOffices)) {
            $wasChanged = true;
        }
        return redirect($this->link);
    }

    public function back()
    {
        return redirect($this->link);
    }

    public function render()
    {
        return view('livewire.admin.purposes.edit');
    }
}