<?php

namespace App\Http\Livewire;

use App\Exports\LogExport;
use App\Exports\UserExport;
use App\Models\AvailableId;
use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Ids extends Component
{

    public $idNum;
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public function updatedIdNum()
    {
        $user = User::findOrFail($this->idNum);
        AvailableId::create([
            'user_id'   =>  $user->id
        ]);
        $this->idNum = '';
    }

    public function loadAvailableIds()
    {
        $availableIds = AvailableId::with('user')->paginate(10);
        return compact('availableIds');
    }

    public function export()
    {
        return Excel::download(new UserExport(), 'log.xlsx');
    }


    public function render()
    {
        return view('livewire.ids', $this->loadAvailableIds());
    }
}
