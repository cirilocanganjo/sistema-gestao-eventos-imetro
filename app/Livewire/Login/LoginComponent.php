<?php

namespace App\Livewire\Login;

use Livewire\Component;
use Livewire\Attributes\Layout;
class LoginComponent extends Component
{
    #[Layout('layouts.dashboard.app')]
    public function render()
    {
        return view('livewire.login.login-component');
    }
}
