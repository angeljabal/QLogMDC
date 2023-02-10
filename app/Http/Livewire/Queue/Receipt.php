<?php

namespace App\Http\Livewire\Queue;

use App\Models\Log;
use Carbon\Carbon;
use Livewire\Component;

class Receipt extends Component
{
    public $officeId;

    public function render()
    {
        $log = Log::where('user_id', auth()->user()->id)
            ->where('office_id', $this->officeId)
            ->where('created_at', '>=', Carbon::today())
            ->where('status', '!=', 'completed')
            ->first();
        return view('livewire.queue.receipt', compact('log'))->with('message');
    }
}