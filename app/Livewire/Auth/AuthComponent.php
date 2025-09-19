<?php

namespace App\Livewire\Auth;
use Exception;
use Livewire\Attributes\Layout;
use Livewire\Component;

class AuthComponent extends Component
{
 public $credentials = [],$email,$password;
 protected $rules = ['email' => 'required','password'=> 'required']; 
 protected $messages = ['email.required' => 'Campo obrigatório*','password.required' => 'Campo obrigatório*'];

   #[Layout('layouts.dashboard.app')]
    public function render()
    {
        return view('livewire.auth.auth-component');
    }

    function login () {
        $this->validate();
        try {
            
        } catch (Exception $e) {
            
        }
    }
}
