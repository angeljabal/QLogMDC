<?php

namespace App\Http\Livewire\Admin\Purposes;

use App\Models\Facility;
use App\Models\Office;
use App\Models\Purpose;
use Livewire\Component;

class Create extends Component
{
    public $facilities;
    public $selectedOffices;
    public $title;
    public $hasDepartment = 0;
    public $first;
    public $officeIds = [];

    public function mount()
    {
        $this->facilities = Office::whereHas('user')->get();
    }

    public function submit()
    {
        $this->validate([
            'title'             => 'required|unique:purposes,title,'
        ]);
        $search = 'College of';
        foreach ($this->selectedOffices as $fac) {
            $fac = Office::select('id', 'name')->where('id', $fac)->first();
            if (preg_match("/{$search}/i", $fac->name)) {
                $this->hasDepartment = 1;
                break;
            }
            // array_push($this->officeIds, $fac->id);
        }
        $purpose = Purpose::create([
            'title'         => $this->title,
            'hasDepartment' => $this->hasDepartment,
            'office_id'     => $this->first
        ]);
        $purpose->offices()->sync($this->selectedOffices);
        return redirect('admin/purposes')->with('message', 'Added Successfully');
    }

    public function back()
    {
        return redirect('/admin/purposes');
    }

    public function render()
    {
        return view('livewire.admin.purposes.create');
    }
}