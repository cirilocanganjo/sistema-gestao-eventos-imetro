<?php

namespace App\Livewire\Home;
use Illuminate\Support\Facades\Auth;
use \Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use \App\Models\{AppDetail, Event, PersonalData, User, UserType, Visitor, VisitorType};
use Livewire\Attributes\Layout;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class HomeComponent extends Component
{
   public $highlighted_event,$searcher;

  protected $listeners = ['confirm' => 'confirmLogout'];   

    public function mount () {
        $this->verifyIfAlreadyHaveAdminUser();
    }
    #[Layout('layouts.home.app')]	
	public function render () : View  {
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

    #[Computed]
    public function events () {
        try {
            return Event::query()->when($this->searcher, function ($q) {    
            $q->where(function ($query) {
                $query->where('event_name', 'like', "%{$this->searcher}%")
                ->orWhere('event_description', 'like', "%{$this->searcher}%");
            });
    })->get(); 
            
        } catch (Exception $e) {
          LivewireAlert::title('Erro')
          ->text('erro: ' .$e->getmessage())
          ->error()
          ->withConfirmButton()
          ->confirmButtonText('Fechar')
          ->show();
        }
    }


    public function verifyIfAlreadyHaveAdminUser () {
        try {
            $users = User::all();
            $user_types = UserType::all();
            $user_personal_data = PersonalData::all();

           if ($users->isEmpty() && $user_types->isEmpty() && $user_personal_data->isEmpty() ) {
            DB::beginTransaction();            
            $admin_user_type =  UserType::query()->create([
                'type' => 'admin'
            ]);

             $visitor_type = VisitorType::query()->create([
                'type' => 'Admin'
            ]);

            $visitor = Visitor::query()->create([
                'visitor_type' => 'Administrador',
                'visitor_type_uuid' => $visitor_type->uuid
            ]);

            $admin_user = User::query()->create([
                'user_name' => 'admin',
                'email' => 'admin@email.com',
                'password' => bcrypt('!admin25#'),
                'status' => 'active',
                'visitor_uuid' => $visitor->uuid,
                'user_type_uuid' =>$admin_user_type->uuid
            ]);           
            
            $admin_personal_data = PersonalData::query()->create([
                'full_name' => 'Administrador do Sistema',
                'gender' => 'male',
                'identity_card' => '0000013JH233',
                'phone' => '923456788',
                'gender' => 'male',
                'visitor_uuid' => $visitor->uuid
            ]);
            DB::commit();
           }

        } catch (\Throwable $th) {
            DB::rollBack();
          LivewireAlert::title('Erro')
          ->text('erro: ' .$th->getmessage())
          ->error()
          ->withConfirmButton()
          ->timer(0)
          ->confirmButtonText('Fechar')
          ->show();
        }
    }

    #[Computed]
    public function get_app_name () 
    {
        try {
        return AppDetail::query()->value("app_name");            
        } catch (Exception $e) {
            LivewireAlert::title('Erro')
          ->text('erro: ' .$e->getmessage())
          ->error()
          ->withConfirmButton()
          ->timer(0)
          ->confirmButtonText('Fechar')
          ->show();
        }
    }

}

