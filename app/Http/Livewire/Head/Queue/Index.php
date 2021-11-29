<?php

namespace App\Http\Livewire\Head\Queue;

use App\Models\Log;
use Carbon\Carbon;
use Exception;
use Livewire\Component;

class Index extends Component
{
    public $perPage = 10, $status, $statuses, $log, $today, $autoServe;

    public function mount(){
        $this->statuses = ["waiting", "skipped", "completed"];
        $this->status = "waiting";
        $this->today = Carbon::today();
    }

    public function loadQueue()
    {
        $current_serving = Log::where('facility_id', auth()->user()->facility->id)
                            ->where('status', "serving")
                            ->where('created_at', '>=', $this->today)
                            ->paginate($this->perPage);

        $logs = Log::where('facility_id', auth()->user()->facility->id)
                ->where('status', $this->status)
                ->where('created_at', '>=', $this->today)
                ->paginate($this->perPage);

        return compact('logs', 'current_serving');
    }

    public function changeStatus($logId, $status){
        $this->log = Log::where('id', $logId)->firstOrFail();
        if($this->autoServe && $status!='serving'){
            try{
                $next = Log::where('facility_id', auth()->user()->facility->id)
                        ->where('status', "waiting")
                        ->where('created_at', '>=', $this->today)
                        ->firstOrFail();
                $next->update(["status" => "serving"]);
            }catch(Exception $e){
                $e->getMessage();
            }
        }

        $this->log->update(["status" => $status]);
    }

    public function render()
    {
        return view('livewire.head.queue.index', $this->loadQueue());
    }
}
