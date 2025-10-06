<?php

namespace App\Livewire\Home;
use Exception;
use Illuminate\Support\Facades\Auth;
use \Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;


class HomeComponent extends Component
{
    protected $listeners = ['confirmLogout' => 'confirm'];

    #[Layout('layouts.home.app')]	
	public function render ()  {
		return view('livewire.home.home-component');
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
            return redirect()->to('/');
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