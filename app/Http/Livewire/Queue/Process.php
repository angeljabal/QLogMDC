<?php

namespace App\Http\Livewire\Queue;

use App\Models\Office;
use App\Models\Purpose;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Process extends Component
{
    public $userId;
    public $confirmingTransaction = false;
    public $purpose;
    public $purpose_title, $departments;
    public $hide = '';
    public $purposeId;
    public $showPurpose = false;
    public function loadPurposes()
    {
        $purposes = Purpose::whereHas('offices')->get();
        return compact('purposes');
    }

    public function openConfirmation($purposeId)
    {
        $this->hide = 'hidden';
        $this->confirmingTransaction = true;
        $this->purposeId = $purposeId;
        // $this->purpose = Purpose::find($purposeId);
        // $this->purpose_title = $this->purpose->title;
        // if ($this->purpose->hasDepartment) {
        //     $this->departments = Office::search('College of')->get();
        // }
        $this->confirmingTransaction = true;
    }

    public function back()
    {
        $this->confirmingTransaction = false;
        $this->purposeId = null;
        $this->purpose = null;
        $this->purpose_title = null;
        $this->departments = null;
    }

    public function render()
    {
        // $login = Auth::loginUsingId($this->userId);
        // if (!$login) {
        //     return back();
        // }
        return view('livewire.queue.process', $this->loadPurposes());
    }
}