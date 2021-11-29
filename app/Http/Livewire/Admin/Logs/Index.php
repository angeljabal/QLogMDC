<?php

namespace App\Http\Livewire\Admin\Logs;

use App\Models\Log;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        $logs = Log::orderBy('created_at')->paginate(10);
        return view('livewire.admin.logs.index', compact('logs'));
    }
}
