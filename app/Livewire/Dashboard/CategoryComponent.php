<?php

namespace App\Livewire\Dashboard;

use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use \App\Models\{EventCategory};
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryComponent extends Component
{
    public $uuid,$category,$category_event,$status,$searcher, $startdate,$enddate;

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
      DB::beginTransaction();
       $createdCategory = EventCategory::create([
            'category' =>$this->pull('category'),
            'user_id' =>auth()->user()->id
        ]);
        DB::commit();

        if ($createdCategory) {
            LivewireAlert::title('Sucesso')
              ->text("Categoria cadastrada com sucesso!")
              ->success()
              ->withConfirmButton()
              ->confirmButtonText('Fechar')
              ->show();
        }

    } catch (\Throwable $th) {
        DB::rollback();
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

    public function edit (string $uuid) {
        try {
           $this->uuid = $uuid;
           $this->status = true;
           $this->category_event = EventCategory::find($uuid);
           $this->category = $this->category_event->category;
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

    public function close() {
        $this->status = false;
        $this->reset(['category']);
    }

}
