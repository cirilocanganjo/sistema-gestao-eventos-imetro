<?php

namespace App\Livewire\Home;
use \App\Models\{Event};
use Carbon\Carbon;
use Exception;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class HeroComponent extends Component
{
  public $searcher;

   
    public function render()
    {
        return view('livewire.home.hero-component',[
            'highlighted_event' => $this->getHighlightedEvent()
        ]);
    }
    
    public function getHighlightedEvent () {
        try {
            return Event::query()->where("event_highlighted",true)
            ->orderBy('event_highlighted', 'DESC')
            ->first() ?? '';

        } catch (Exception $e) {
          LivewireAlert::title('Erro')
          ->text('erro: ' .$e->getMessage())
          ->error()
          ->withConfirmButton()
          ->confirmButtonText('Fechar')
          ->show();
        }
    }

    #[Computed]
    public function event_remaining_time () {
        try {
            $eventDateTime = Carbon::parse($this->highlighted_event->event_date . ' ' . $this->highlighted_event->time);
            $now = Carbon::now();
            if (!$eventDateTime->isPast()) {
              return $now->diff($eventDateTime);               
            }
            
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
