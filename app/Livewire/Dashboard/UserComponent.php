<?php

namespace App\Livewire\Dashboard;
use Livewire\Attributes\Layout;
use \App\Models\User;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class UserComponent extends Component
{
    public $searcher,$startdate,$enddate;
    #[Layout('layouts.dashboard.app')]
    public function render()
    {
        return view('livewire.dashboard.user-component',[
            'data' =>$this->getUsers()
        ]);
    }

    public function getUsers () {
        try {
            if ($this->searcher) {
                return User::query()->where('user_name', 'like', '%' .$this->searcher. '%')
                ->with(['userType', 'userPersonalData', 'visitor'])
                ->get(); 
            }else if ($this->startdate and $this->enddate) {
                return User::query()->whereBetween('created_at' ,[$this->startdate,$this->enddate])
                ->with(['userType', 'userPersonalData', 'visitor'])
                ->get(); 
            }else {
                return User::query()->with(['userType', 'userPersonalData', 'visitor'])->get(); 
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
