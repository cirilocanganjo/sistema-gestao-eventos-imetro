<?php

namespace App\Livewire\Dashboard;
use Livewire\Attributes\Layout;
use \App\Models\User;
use App\Models\UserType;
use App\Models\VisitorType;
use Exception;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class UserComponent extends Component
{
    public $id,$user,$searcher,$startdate,$enddate;
    
    #[Layout('layouts.dashboard.app')]
    public function render()
    {
        return view('livewire.dashboard.user-component',[
            'access_levels' =>$this->getProfileForAccessLevels(),
            'visitor_types' =>$this->getVisitorTypes(),
            'data' =>$this->getUsers()
        ]);
    }

    public function getUsers () {
        try {
            if ($this->searcher) {
                return User::query()->where('user_name', 'like', '%' .$this->searcher. '%')
                ->with(['userType', 'userPersonalData', 'visitorForVisitorType'])
                ->get(); 
            }else if ($this->startdate and $this->enddate) {
                return User::query()->whereBetween('created_at' ,[$this->startdate,$this->enddate])
                ->with(['userType', 'userPersonalData', 'visitorForVisitorType'])
                ->get(); 
            }else {
                return User::query()->with(['userType', 'userPersonalData', 'visitorForVisitorType'])->get(); 
            }

        } catch (Exception $e) {
            LivewireAlert::title('Erro')
          ->text('erro: ' .$e->getMessage())
          ->error()
          ->timer(0)
          ->withConfirmButton()
          ->confirmButtonText('Fechar')
          ->show();
        }
    }

    public function edit ($id) {
        try { 
            $this->id = $id;                  
            $this->user = User::query()->with(['userType', 'userPersonalData', 'visitor'])->find($id);        
            $this->dispatch('edit-user', user: $this->user);
        } catch (Exception $e) {
        LivewireAlert::title('Erro')
          ->text('erro: ' .$e->getMessage())
          ->error()
          ->withConfirmButton()
          ->confirmButtonText('Fechar')
          ->show();
        }
    }

    public function getVisitorTypes () {
        try {
            return VisitorType::query()->get();
        } catch (Exception $e) {
              LivewireAlert::title('Erro')
                  ->text('erro: ' .$e->getmessage())
                  ->error()
                  ->withConfirmButton()
                  ->confirmButtonText('Fechar')
                  ->show();
        }
    }

    public function  getProfileForAccessLevels()
    {
        try {
            return UserType::get();
           } catch (Exception $e) {
             LivewireAlert::title('Erro')
             ->text('erro: ' .$e->getmessage())
             ->error()
             ->withConfirmButton()
             ->confirmButtonText('Fechar')
             ->show();
           }   
    }
}
