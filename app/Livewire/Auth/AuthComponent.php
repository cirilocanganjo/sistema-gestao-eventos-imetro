<?php

namespace App\Livewire\Auth;
use Exception;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class AuthComponent extends Component
{
 public $email,$password;
 protected $rules = ['email' => 'required','password'=> 'required']; 
 protected $messages = ['email.required' => 'Campo obrigatório*','password.required' => 'Campo obrigatório*'];

   #[Layout('layouts.auth.app')]
    public function render()
    {
        return view('livewire.auth.auth-component');
    }

    public function login () {
        $this->validate();
        try {
            if (auth()->attempt(["email" =>$this->email ,"password" =>$this->password])) {
                if (auth()->user()->userType->type === 'admin') {
                    $this->redirect(route('dashboard.home'), navigate: false);
                }else if (auth()->user()->userType->type === 'visitante' and  auth()->user()->visitor->visitorType->type === 'visitante e publicador de eventos') {
                    $this->redirect(route('dashboard.home') , navigate: false);
                }else if (auth()->user()->userType->type === 'visitante') {
                    return redirect()->route('evently.app.home');
                }
             }

             if (!auth()->attempt(["email" =>$this->email ,"password" =>$this->password])) {
                 LivewireAlert::title('Atenção')
                 ->text('Credenciais incorretas, tente novamente.')
                 ->warning()
                  ->withConfirmButton()
                 ->confirmButtonText('Fechar')
                 ->show();
             }
        } catch (Exception $e) {
            LivewireAlert::title('Erro')
             ->text('erro: ' .$e->getmessage())
             ->error()
             ->withConfirmButton()
             ->timer(0)
             ->confirmButtonText('Fechar')
             ->show();
        }
    }
}
