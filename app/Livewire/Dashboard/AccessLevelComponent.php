<?php

namespace App\Livewire\Dashboard;

use App\Models\UserType;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

class AccessLevelComponent extends Component
{

    public $acess_levels,$searcher;    

    public function mount()
    {
       
    }
    
    #[Layout('layouts.dashboard.app')]
    public function render()
    {
        return view('livewire.dashboard.access-level-component',[
            'data' =>$this->getAccessLevels(),
        ]);
    }

    public function getAccessLevels()
    {
        try {
            if ($this->searcher) {
            return UserType::query()->when($this->searcher, fn ($q) => $q->where('type', 'like', "%{$this->searcher}%")                
            )->get();       
            }
            
            return UserType::query()->get();


        } catch (Exception $e) {
         LivewireAlert::title('Erro')
          ->text('ERRO: '.$e->getMessage())
          ->error()
          ->withConfirmButton()
          ->confirmButtonText('Fechar')
          ->show();
        }
    }
}
