<?php

namespace App\Livewire\Dashboard;

use Livewire\Attributes\Layout;
use Livewire\Component;

class CategoryComponent extends Component
{
    #[Layout('layouts.dashboard.app')]
    public function render()
    {
        return view('livewire.dashboard.category-component');
    }
}
