<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Log;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    public $admin, $today, $count;

    public function mount(){
        if(session('admin')){
            $this->admin = User::findOrFail(session('admin'));
        }
        $this->today = Carbon::now()->format('M d, Y');

        $this->count = Log::distinct('facility_id')
                ->where('user_id', $this->id)
                ->where('created_at', '>=', Carbon::today())
                ->count();
    }

    public function loadLogs(){
        $logs = Log::where('user_id', $this->id)
                    ->where('created_at', '>=', Carbon::today()->subDays(2))
                    ->orderBy('created_at', 'DESC')
                    ->paginate(10);
        
        return compact($logs);
    }

    public function render()
    {
        return view('livewire.dashboard.index', $this->loadLogs());
    }
}
