<?php

namespace App\Livewire\Home;

use App\Models\PersonalData;
use App\Models\User;
use App\Models\UserType;
use App\Models\Visitor;
use App\Models\VisitorType;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

class HomeComponent extends Component
{
    public $visitor,$user_type, $visitor_type;
    public function mount()
    {
       
    }

    #[Layout('layouts.home.app')]
    public function render()
    {
        return view('livewire.home.home-component');
    }


}
