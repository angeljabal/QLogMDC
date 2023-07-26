<?php

namespace App\Http\Livewire;

use App\Models\Log;
use App\Models\Office;
use App\Models\Purpose;
use Carbon\Carbon;
use Livewire\Component;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;


class TransConfirmation extends Component
{
    public $purposeId;
    public $departments;
    public $purpose_title;
    public $department;
    public $log;
    public $officeId;

    public function mount()
    {
        $this->purpose_title = $this->purpose->title;
        if ($this->purpose->hasDepartment) {
            $this->departments = Office::search('College of')->get();
        }
    }
    public function back()
    {
        $this->purposeId = null;
        return redirect('/logout');
    }

    public function submit()
    {
        $count = Log::where('created_at', '>=', Carbon::today())->count();

        if ($this->purpose->hasDepartment) {
            $this->validate([
                'department'   => 'required'
            ]);
            $this->log = Log::where('user_id', auth()->user()->id)
                ->where('office_id', $this->department)
                ->where('created_at', '>=', Carbon::today())
                ->where('status', '!=', 'completed')
                ->first();
            if (!$this->log) {
                $this->log = Log::create([
                    'user_id'       => auth()->user()->id,
                    'office_id'     => $this->department,
                    'queue_no'      => ++$count,
                    'purpose'       => $this->purpose_title,
                    'status'        => "waiting"
                ]);
            }
        } else {
            $this->log = Log::where('user_id', auth()->user()->id)
                ->where('office_id', $this->purpose->office_id)
                ->where('created_at', '>=', Carbon::today())
                ->where('status', '!=', 'completed')
                ->first();

            if (!$this->log) {
                $this->log = Log::create([
                    'user_id'       => auth()->user()->id,
                    'office_id'     => $this->purpose->office_id,
                    'queue_no'      => ++$count,
                    'purpose'       => $this->purpose_title,
                    'status'        => "waiting"
                ]);
            }
        }
        $this->print($this->log);
        $this->officeId = $this->log->office_id;
        // return redirect('queue/complete');
    }

    public function print(Log $log)
    {
        $connector = new WindowsPrintConnector("XP 58");
        $printer = new Printer($connector);
        $printer->initialize();
        $printer->text("Welcome, you are currently in the queue. \n");
        $printer->setFont(Printer::FONT_A);
        $printer->setTextSize(2, 2);
        $printer->text("--------------\n");
        $printer->text("Queue #: " . sprintf('%03d', $log->queue_no) . "\n");
        $printer->setFont(Printer::FONT_B);
        $printer->setTextSize(1, 2);
        $printer->text("Name: " .  $log->user->fname . " " . $log->user->lname . "\n");
        $printer->text("Purpose: Enrolment \n");
        $printer->setFont(Printer::FONT_B);
        $printer->setTextSize(2, 2);
        $printer->text("--------------\n");
        $printer->setFont(Printer::FONT_B);
        $printer->setTextSize(1, 1);
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text($log->created_at->todatestring() . "\n");
        $printer->setJustification(Printer::JUSTIFY_CENTER);
        $printer->text("***Only valid on the same day***\n\n\n\n");

        $printer->setJustification();
        $printer->cut();
        $printer->close();
    }

    public function getPurposeProperty()
    {
        return Purpose::find($this->purposeId);
    }

    public function render()
    {
        return view('livewire.trans-confirmation');
    }
}
