<?php

namespace App\Livewire\Admin;

use App\Models\Permohonan;
use Livewire\Component;

class DashboardPage extends Component
{

    public $permohonan, $pending, $aproved, $riject;

    public function mount()
    {
        $this->permohonan = Permohonan::all()->count();
        $this->pending = Permohonan::where('status', 'pending')->get()->count();
        $this->aproved = Permohonan::where('status', 'approved')->get()->count();
        $this->riject = Permohonan::where('status', 'reject')->get()->count();
    }


    public function render()
    {
        return view('livewire.admin.dashboard-page');
    }
}
