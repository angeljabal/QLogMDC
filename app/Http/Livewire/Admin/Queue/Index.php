<?php

namespace App\Http\Livewire\Admin\Queue;

use App\Models\Log;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    public $today, $current_serving, $on_queue;

    public function render()
    {
        $this->today = Carbon::today();
        $this->current_serving = Log::where('status', "serving")
            ->where('created_at', '>=', $this->today)->get();
        $this->on_queue = Log::where('status', "waiting")
            ->where('created_at', '>=', $this->today)->get();

        return view('livewire.admin.queue.index');
    }
}