<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Facility;
use App\Models\Log;
use App\Models\Office;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    public $admin, $today, $count, $facilitiesAvailable;

    public function mount()
    {
        // dd(auth()->user()->hasRole('admin'));
        if (session('admin')) {
            $this->admin = User::findOrFail(session('admin'));
        }
        $this->today = Carbon::now()->format('M d, Y');

        $this->count = Log::distinct('office_id')
            ->where('user_id', auth()->user()->id)
            ->where('created_at', '>=', Carbon::today())
            ->count();

        $this->facilitiesAvailable = Office::where('isOpen', true)->whereHas('user')->count();
    }

    public function loadLogs()
    {
        $logs = Log::where('user_id', auth()->user()->id)
            ->where('created_at', '>=', Carbon::today()->subDays(2))
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
        return compact('logs');
    }

    public function render()
    {
        return view('livewire.dashboard.index', $this->loadLogs());
    }
}