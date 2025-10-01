<?php

namespace App\Livewire\Dashboard;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class UserComponent extends Component
{
    #[Layout('layouts.dashboard.app')]
    public function render()
    {
        return view('livewire.dashboard.user-component');
    }
}
