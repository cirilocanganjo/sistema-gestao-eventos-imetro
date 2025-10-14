<?php

namespace App\Livewire\Dashboard;

use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use \App\Models\{EventCategory};
use Carbon\Carbon;

class CategoryComponent extends Component
{
    public $category,$status,$searcher, $startdate,$enddate;

    public function mount() {
        $this->status = false;
    }

    #[Layout('layouts.dashboard.app')]
    public function render()
    {
        return view('livewire.dashboard.category-component',[
            'data' =>$this->getEventCategories()
        ]);
    }

  public function store () {
    $this->validate([
        'category' => 'required|unique:event_categories'
    ],[
        'category.required' => 'Campo obrigatório*',
        'category.unique' => 'Categoria já adicionada'
    ]);

    try {

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

    public function edit () {

    }

    public function update () {

    }

    public function getEventCategories () {
        try {
           return EventCategory::query()->with('user')
           ->when(!empty($this->searcher), fn ($q) =>
             $q->where('category', 'like', "%{$this->searcher}%"))

            ->when($this->startdate && $this->enddate, fn ($q) =>
                $q->whereBetween('created_at', [
                 Carbon::parse($this->startdate)->startOfDay(),
                 Carbon::parse($this->enddate)->endOfDay()
                ])
            )->get();

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

    publIC function close () {
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
