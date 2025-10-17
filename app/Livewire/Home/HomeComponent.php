<?php

namespace App\Livewire\Home;
use Illuminate\Support\Facades\Auth;
use \Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use \App\Models\{Event};
use Livewire\Attributes\Layout;
use Exception;
use Livewire\Attributes\On;
use Livewire\Component;


class HomeComponent extends Component
{
    public Event|null $highlighted_event = null;
    protected $listeners = ['confirm' => 'confirmLogout'];

    #[Layout('layouts.home.app')]	
	public function render ()  {
		return view('livewire.home.home-component',[
            //'is_highleghted_event' => $this->getHighlightedEvent(),
        ]);
	}
	
    #[On('event_highlighted')]
    public function getHighlightedEvent () {
        try {
            $this->highlighted_event = Event::query()->where("event_highlighted",true)
            ->orderBy('event_highlighted', 'DESC')
            ->first();

        } catch (Exception $e) {
          LivewireAlert::title('Erro')
          ->text('erro: ' .$e->getMessage())
          ->error()
          ->withConfirmButton()
          ->confirmButtonText('Fechar')
          ->show();
        }
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
            ->onConfirm('confirmLogout')
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

    public function confirmLogout () {
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