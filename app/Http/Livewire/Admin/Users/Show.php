<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Show extends Component
{
    public $userId;

    public function getUserProperty()
    {
        return User::with(['profile', 'roles'])
            ->find($this->userId);
    }

    public function generateQr()
    {
        $data = [
            'id'            => $this->user->id,
            'name'          => $this->user->name
        ];

        $jsonData = json_encode($data);
        $qrcode = QrCode::format('png')->generate($this->user->id);

        $this->dispatchBrowserEvent('swal', [
            'title' => 'QrCode',
            'text'  => $this->user->name,
            'imageUrl'  => $qrcode
        ]);
    }

    public function back()
    {
        return redirect('/admin/users');
    }

    public function render()
    {
        return view('livewire.admin.users.show');
    }
}