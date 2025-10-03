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
use \Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HomeComponent extends Component
{
    protected $listeners = ['confirmLogout' => 'confirm'];
    public $visitor,$user_type, $visitor_type;
    public function mount()
    {
       
    }

    #[Layout('layouts.home.app')]
    public function render()
    {
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
