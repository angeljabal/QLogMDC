<?php

namespace App\Http\Livewire\Admin\Queue;

use App\Models\Log;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    public $today, $current_serving;

    protected $listeners = ['refresh' => 'refresh'];


    public function mount(){
        $this->today = Carbon::today();
        $this->current_serving = Log::where('status', "serving")
                ->where('created_at', '>=', $this->today)->get();
    }

    public function render()
    {
        return view('livewire.admin.queue.index');
    }
}
