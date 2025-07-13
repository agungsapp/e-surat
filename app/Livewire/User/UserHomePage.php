<?php

namespace App\Livewire\User;

use App\Models\Banner;
use App\Models\Permohonan;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class UserHomePage extends Component
{
    public $count = [];
    public $banners;

    public function mount()
    {
        $this->count['pending'] = Permohonan::where('status', 'pending')->count();
        $this->count['rejected'] = Permohonan::where('status', 'rejected')->count();
        $this->count['approved'] = Permohonan::where('status', 'approved')->count();

        $this->banners = Banner::all();


        // dd($this->count); 
    }

    #[Layout('livewire.user.layouts.app')]
    public function render()
    {
        return view('livewire.user.user-home-page');
    }
}
