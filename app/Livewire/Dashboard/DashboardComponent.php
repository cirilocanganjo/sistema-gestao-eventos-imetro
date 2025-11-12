<?php

namespace App\Livewire\Dashboard;
use \App\Models\{Event, TemporaryInvitationEvent, User, UserType};
use \Carbon\Carbon;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\Component;


class DashboardComponent extends Component
{   
    public $eventMonths = [] ,$eventCounter = [];

    public function mount()
    {
      $this->verifyIfAlreadyHasVisitorAndVisitorAndEventPublisherProfiles();
    }

    #[Layout('layouts.dashboard.app')]
    public function render() : View
    {
        return view('livewire.dashboard.dashboard-component', [
            'chartData' =>$this->getEventsForRenderInChart(),
            'dataStatForUserCounter' =>$this->getUserCounter(),
            'dataStatForEventCounter' =>$this->getCreatedEventCounter(),
            'dataStatForTemporaryInvitationCounter' =>$this->getTemporaryInvitationEvent()
        ]);
    }


       public function getEventsForRenderInChart(){
        try {
            if (auth()->user()->userType->type === "admin") {
                $events = Event::query()->select(["uuid", "created_at"])                
                ->get()
                ->groupBy(function($data){
                  return Carbon::parse($data->created_at)->format("M");
                }); 

            }else {
                 $events = Event::query()->select(["uuid", "user_id", "created_at"])  
                ->where("user_id", auth()->user()->id)              
                ->get()
                ->groupBy(function($data){
                  return Carbon::parse($data->created_at)->format("M");
                });  
            }

                if ($events) {
                    foreach ($events as $month => $values) {
                    $this->eventMonths[] =  $month;
                    $this->eventCounter[] = count($values);

                }
          }

        } catch (Exception $ex) {
         LivewireAlert::title('Erro')
          ->text('erro: ' .$ex->getMessage())
          ->error()
          ->timer(0)
          ->withConfirmButton()
          ->confirmButtonText('Fechar')
          ->show();
        }
    }

  public function getUserCounter()
  {
      try {
          return User::query()->count();
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

  public function getCreatedEventCounter()
  {
      try {
          if (auth()->user()->userType->type === 'admin') {
            return Event::query()->count();
          }else{
            return Event::query()->where('user_id', auth()->user()->id)->count();
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

  public function getTemporaryInvitationEvent()
  {
      try {          
            return TemporaryInvitationEvent::query()->whereHas('event' , function ($q) {
                $q->where('user_id', auth()->user()->id);
            })->with('event')            
            ->count();          

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

  public function verifyIfAlreadyHasVisitorAndVisitorAndEventPublisherProfiles() {
    try {
      $user_types = UserType::query()->where(fn ($q) => $q->whereIn('type', ["visitante", "visitante e publicador de eventos"]))->get();        
      
      DB::beginTransaction();
      if ($user_types->isEmpty()) {
        UserType::query()->create([
          'type' => 'visitante',
        ]); 

        UserType::query()->create([
          'type' => 'visitante e publicador de eventos',
        ]);
      }
      DB::commit();
    } catch (Exception $e) {
        DB::rollBack();
         LivewireAlert::title('Erro')
          ->text('erro: ' .$e->getMessage())
          ->error()
          ->timer(0)
          ->withConfirmButton()
          ->confirmButtonText('Fechar')
          ->show();
    }
  }
}
