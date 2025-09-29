<?php

namespace App\Livewire\Dashboard;
use Livewire\Attributes\Layout;
use Exception;
use Livewire\Component;


class DashboardComponent extends Component
{   

    #[Layout('layouts.dashboard.app')]
    public function render()
    {
        return view('livewire.dashboard.dashboard-component');
    }


  
}
