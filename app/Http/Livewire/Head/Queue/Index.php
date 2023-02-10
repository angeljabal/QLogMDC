<?php

namespace App\Http\Livewire\Head\Queue;

use App\Models\Facility;
use App\Models\Log;
use Carbon\Carbon;
use Exception;
use Livewire\Component;

class Index extends Component
{
    public $perPage = 10, $status, $statuses, $log, $today, $autoServe, $windows, $selectedWindow;
    public $confirmingNext = false, $facilities, $facility, $user_id, $purpose, $logId;

    public function mount()
    {
        $this->statuses = ["waiting", "skipped", "completed"];
        $this->status = "waiting";
        $this->today = Carbon::today();
        $this->windows = auth()->user()->office->windowsAvailable;
        $this->selectedWindow = 1;
        $this->facilities = [];
    }

    public function loadQueue()
    {
        $current_serving = Log::where('office_id', auth()->user()->office->id)
            ->where('status', "serving")
            ->where('created_at', '>=', $this->today)
            ->paginate($this->perPage);

        $logs = Log::where('office_id', auth()->user()->office->id)
            ->where('status', $this->status)
            ->where('created_at', '>=', $this->today)
            ->paginate($this->perPage);

        // foreach($current_serving as $log){
        //     $facilities = Facility::whereHas('purposes', function($q) use($log) {
        //                     $q->whereIn('title', [$log->purpose])
        //                         ->select('id','name');
        //                 })->get();
        // }

        return compact('logs', 'current_serving');
    }

    public function changeStatus($logId, $status)
    {
        $this->log = Log::where('id', $logId)->firstOrFail();
        if ($this->autoServe && $status != 'serving') {
            try {
                $next = Log::where('office_id', auth()->user()->office->id)
                    ->where('status', "waiting")
                    ->where('created_at', '>=', $this->today)
                    ->firstOrFail();
                $next->update(["status" => "serving", "window" => $this->selectedWindow]);
            } catch (Exception $e) {
                $e->getMessage();
            }
        }

        $this->log->update(["status" => $status, "window" => $this->selectedWindow]);
    }

    public function confirmNext($logId, $userId, $purpose)
    {
        $this->user_id = $userId;
        $this->purpose = $purpose;
        $this->log = Log::where('id', $logId)->firstOrFail();
        $this->facilities = Facility::whereHas('purposes', function ($q) use ($purpose) {
            $q->whereIn('title', [$purpose])
                ->select('id', 'name');
        })->get();
        $this->confirmingNext = true;
    }

    public function next()
    {
        $this->validate([
            'facility'      => 'required'
        ]);
        $count = Log::where('office_id', $this->facility)
            ->where('created_at', '>=', Carbon::today())
            ->count();
        $exist = Log::where('user_id', $this->user_id)
            ->where('office_id', $this->facility)
            ->where('created_at', '>=', Carbon::today())
            ->where('status', '!=', 'completed')
            ->first();

        if (!$exist) {
            Log::create([
                'user_id'       => $this->user_id,
                'office_id'   => $this->facility,
                'queue_no'      => $this->log->queue_no,
                'purpose'       => $this->purpose,
                'status'        => "waiting"
            ]);
            $this->changeStatus($this->log->id, 'completed');
            $this->confirmingNext = false;
        }
    }

    public function render()
    {
        return view('livewire.head.queue.index', $this->loadQueue());
    }
}