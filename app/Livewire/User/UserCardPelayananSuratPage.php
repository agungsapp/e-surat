<?php

namespace App\Livewire\User;

use App\Models\Surat;
use Livewire\Attributes\Layout;
use Livewire\Component;

class UserCardPelayananSuratPage extends Component
{

    public $surats;

    public function mount()
    {
        $this->surats = Surat::where('active', true)->get();
    }


    #[Layout('livewire.user.layouts.app')]
    public function render()
    {
        return view('livewire.user.user-card-pelayanan-surat-page');
    }
}
