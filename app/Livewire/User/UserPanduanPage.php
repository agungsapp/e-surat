<?php

namespace App\Livewire\User;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('livewire.user.layouts.app')]
class UserPanduanPage extends Component
{
    public function render()
    {
        return view('livewire.user.user-panduan-page');
    }
}
