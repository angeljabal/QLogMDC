<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Log;
use Carbon\Carbon;
use Livewire\Component;

class Head extends Component
{
    public $startDate, $endDate;
    protected $listeners = ['updateCounter'];

    public function dateRange(){
        dd($this->startDate);
    }

    public function loadOverview(){
        $waiting = Log::where('facility_id', auth()->user()->facility->id)
            ->where('status', "waiting")
            ->where('created_at', '>=', Carbon::today())
            ->count();

        $completed = Log::where('facility_id', auth()->user()->facility->id)
            ->where('status', "completed")
            ->where('created_at', '>=', Carbon::today())
            ->where('created_at', '<=', Carbon::today())
            ->count();

        $transactions = Log::where('facility_id', auth()->user()->facility->id)->count();

        return compact('transactions', 'waiting', 'completed');
    }

    public function updateCounter()
    {
        dd('fired');
    }

    public function render()
    {
        return view('livewire.admin.dashboard.head', $this->loadOverview());
    }
}
