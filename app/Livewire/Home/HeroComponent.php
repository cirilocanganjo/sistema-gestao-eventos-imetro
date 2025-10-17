<?php

namespace App\Livewire\Home;
use \App\Models\{Event};
use Exception;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class HeroComponent extends Component
{
  public Event|null $highlighted_event = null;

   
    public function render()
    {
        return view('livewire.home.hero-component',[
            'is_highlighted' => $this->getHighlightedEvent()
        ]);
    }
    
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
}
