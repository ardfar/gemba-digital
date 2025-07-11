<?php

namespace App\Livewire\Card\Table\Genba;

use App\Models\Attendances;
use Livewire\Component;

class Attendance extends Component
{
    public $genba;
    public $attendances;
    
    public function mount($genba)
    {
        $this->genba = $genba;

        $this->get_data();
    }

    public function get_data()
    {
        $this->attendances = Attendances::where('session_id', $this->genba->id)->get();
    }

    public function reload()
    {
        $this->get_data();

        $this->dispatch('resetGenbaAttendanceTable');
    }
    
    public function render()
    {
        return view('livewire.card.table.genba.attendance');
    }
}
