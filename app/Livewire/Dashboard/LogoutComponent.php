<?php

namespace App\Livewire\Dashboard;

use Exception;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use \Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LogoutComponent extends Component
{
    protected $listeners = ['confirmLogout' => 'confirm'];
    
    public function render()
    {
        return view('livewire.dashboard.logout-component');
    }

     public function logout () {        
        try{  
            LivewireAlert::title('Atenção')
            ->text('Deseja realmente, terminar sessão?')
            ->warning()
            ->withDenyButton()
            ->withConfirmButton()
            ->confirmButtonText('Sim, confirmar')
            ->denyButtonText('Não, cancelar')
            ->withOptions(['allowOutsideClick' => false])
            ->timer(0)
            ->onConfirm('confirm')
            ->show();

        }catch(Exception $ex){
           LivewireAlert::title('Erro')
          ->text('erro: ' .$ex->getMessage())
          ->error()
          ->withConfirmButton()
          ->confirmButtonText('Fechar')
          ->show();
        }
    }

    public function confirm () {
        try {
            Auth::logout();
            return redirect()->route('user.login');
        } catch (Exception $ex) {
       LivewireAlert::title('Erro')
          ->text('erro: ' .$ex->getMessage())
          ->error()
          ->withConfirmButton()
          ->confirmButtonText('Fechar')
          ->show();
        }
    }
}
