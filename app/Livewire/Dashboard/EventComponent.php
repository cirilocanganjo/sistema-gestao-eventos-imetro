<?php

namespace App\Livewire\Dashboard;

use \App\Models\{Event};
use Carbon\Carbon;
use Exception;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

class EventComponent extends Component
{
    public $event_name,$status, $searcher,$startdate,$enddate;

    public function mount () {
        $this->status = false;
    }

    #[Layout('layouts.dashboard.app')]
    public function render()
    {
        return view('livewire.dashboard.event-component',[
            'data' =>$this->getEvents(),
        ]);
    }

    public function store () {
        try {
            dd();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function edit () {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function update () {
        try {
            //code...
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function getEvents () {
        try {
            return Event::query()->with(['eventCategory', 'user'])
            ->when(!empty($this->searcher), fn ($q) =>
             $q->where('event_name', 'like', "%{$this->searcher}%")
             ->orWhere('event_description', 'like', "%{$this->searcher}%"))

            ->when($this->startdate && $this->enddate, fn ($q) =>
                $q->whereBetween('created_at', [
                 Carbon::parse($this->startdate)->startOfDay(),
                 Carbon::parse($this->enddate)->endOfDay()
                ])
            )->get();

        } catch (Exception $e) {
         LivewireAlert::title('Erro')
             ->text('erro: ' .$e->getmessage())
             ->error()
             ->withConfirmButton()
             ->timer(0)
             ->confirmButtonText('Fechar')
             ->show();
             return collect([]);
        }
    }

    public function close () {
        try {
            //code...
        } catch (\Throwable $th) {
            LivewireAlert::title('Erro')
             ->text('erro: ' .$th->getmessage())
             ->error()
             ->withConfirmButton()
             ->timer(0)
             ->confirmButtonText('Fechar')
             ->show();
             return collect([]);
        }
    }
}
