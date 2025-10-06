<?php

namespace App\Livewire\Dashboard;
use Exception;
use Livewire\Attributes\Layout;
use Livewire\Component;


class MyProfileComponent extends Component
{
    public $username,$password,$email;

    
    public function mount () {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    #[Layout('layouts.dashboard.app')]
	public function render ()  {
		return view('livewire.dashboard.my-profile-component');
	}
}
