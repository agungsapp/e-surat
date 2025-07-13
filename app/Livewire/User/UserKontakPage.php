<?php

namespace App\Livewire\User;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('livewire.user.layouts.app')]
class UserKontakPage extends Component
{
    public function render()
    {
        return view('livewire.user.user-kontak-page');
    }
}
