<?php

namespace App\Http\Livewire;

use App\Exports\UserExport;
use App\Models\IdsLog;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Idlog extends Component
{
    public $idNum;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public function updatedIdNum()
    {
        $user = User::findOrFail($this->idNum);
        Idslog::create([
            'user_id'   =>  $user->id
        ]);
        $this->idNum = '';
    }

    public function loadLogs()
    {
        $logs = IdsLog::with('user')->paginate(10);
        return compact('logs');
    }

    public function export()
    {
        return Excel::download(new UserExport(), 'log.xlsx');
    }

    public function render()
    {
        return view('livewire.idlog', $this->loadLogs());
    }
}
