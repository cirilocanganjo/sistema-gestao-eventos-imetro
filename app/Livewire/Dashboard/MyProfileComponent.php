<?php

namespace App\Livewire\Dashboard;
use Exception;
use Livewire\Attributes\Layout;
use Livewire\Component;


class MyProfileComponent extends Component
{
    #[Layout('layouts.dashboard.app')]	
	public function render ()  {
		return view('livewire.dashboard.my-profile-component');
	}
}