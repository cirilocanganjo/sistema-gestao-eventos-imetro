<?php

namespace App\Livewire\Dashboard;

use App\Models\PersonalData;
use App\Models\User;
use App\Models\UserType;
use App\Models\VisitorType;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class MyProfileComponent extends Component
{
    use WithFileUploads;
    public $username,$password,$access_level,$profile_type,$new_password,$confirm_new_password,$email,$photo,$fileName;
    protected $listeners = ['confirm' =>'confirmUpdateAuthenticatedProfileUserData'];

    #[On('user-profile-data-updated')]
    public function mount () {
        try {
             $this->username = auth()->user()->user_name;
             $this->email = auth()->user()->email;   
             $this->access_level = auth()->user()->user_type_uuid;
             $this->profile_type = auth()->user()->visitor_uuid;
        } catch (\Throwable $e) {
           LivewireAlert::title('Erro')
          ->text('erro: ' .$e->getMessage())
          ->error()
          ->withConfirmButton()
          ->confirmButtonText('Fechar')
          ->show();
        }

        }

    
    #[Layout('layouts.dashboard.app')]
	public function render ()  {
		return view('livewire.dashboard.my-profile-component',[
            'data_of_access_levels' =>$this->getAccessLevels(),
            'data_of_user_types' =>$this->getVisitorTypes(),
        ]);
	}


    public function  updateAuthenticatedProfileUserData ()
    {
         $this->validate([
           'username' =>'required',
           'password' =>'required',
           'email' =>'required',
           'access_level' => 'required',
           'profile_type' => 'required'
         ],

         [
           'username.required' =>'Campo obrigatório *',
           'password.required' =>'Campo obrigatório *',
           'email.required' =>'Campo obrigatório *',
           'access_level.required' =>'Campo obrigatório *',
           'profile_type.required' =>'Campo obrigatório *',
         ]);

        try {
           LivewireAlert::title('Atenção')
            ->text('Deseja realmente, atualizar os dados?')
            ->warning()
            ->withDenyButton()
            ->withConfirmButton()
            ->confirmButtonText('Sim, confirmar')
            ->denyButtonText('Não, cancelar')
            ->withOptions(['allowOutsideClick' => false])
            ->timer(0)
            ->onConfirm('confirmUpdateAuthenticatedProfileUserData')
            ->show();

        } catch (Exception $e) {
         LivewireAlert::title('Erro')
          ->text('erro: ' .$e->getMessage())
          ->error()
          ->withConfirmButton()
          ->confirmButtonText('Fechar')
          ->show();
        }
    }
    
    public function  confirmUpdateAuthenticatedProfileUserData () {
        
        try {            
           
            if ($this->password and $this->new_password and $this->confirm_new_password) {

            }

            if (!Hash::check($this->password, auth()->user()->password)) {
             LivewireAlert::title('Atenção')
              ->text("Não podemos proceder a alteração dos dados, credenciais incorretas!")
              ->warning()
              ->withConfirmButton()
              ->timer(0)
              ->confirmButtonText('Fechar')
              ->show();

            }else{
            DB::beginTransaction();
            $user = User::query()->where('id',auth()->user()->id)->update([
                'user_name' =>$this->username,               
            ]);

            $exists_emails = User::where('email', $this->email)->get();
            while (!$exists_emails) {
                User::query()->where('id',auth()->user()->id)->update([
                    'email' =>$this->email
                ]);
            }

            if ($this->photo and $this->photo->isValid()) {
             $this->fileName = md5($this->photo->getClientOriginalName() .now()). '.' .$this->photo->getClientOriginalExtension();
             $this->photo->storeAs("imgs", $this->fileName, 'public');
            }

            if (Storage::disk('public')->exists('imgs/' . auth()->user()->userPersonalData->photo)) {
              Storage::disk('public')->delete('imgs/' . auth()->user()->userPersonalData->photo);                
            }

            $personal_data = PersonalData::query()->where('visitor_uuid', auth()->user()->visitor_uuid)->update([
                'full_name' =>$this->username,
                'photo' =>$this->fileName ?? null
            ]);

            DB::commit();           
            if ($user || $personal_data >= 1) {            
             LivewireAlert::title('Sucesso')
              ->text("Dados atualizados com sucesso!")
              ->success()
              ->withConfirmButton()
              ->confirmButtonText('Fechar')
              ->show();

              $this->dispatch('user-profile-data-updated');
              $this->dispatch('clean-photo-input');

            }

            }
        } catch (Exception $e) {
            DB::rollback();
            if (Storage::disk('public')->exists('imgs/' . $this->fileName)) { //Remove photo from storage if it exists there
              Storage::disk('public')->delete('imgs/' . $this->fileName);
            }
          LivewireAlert::title('Erro')
          ->text('erro: ' .$e->getMessage())
          ->error()
          ->timer(0)
          ->withConfirmButton()
          ->confirmButtonText('Fechar')
          ->show();
        }
    }

    public function getAccessLevels()
    {
        try {
            return UserType::select(['uuid', 'type'])->get();
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

    public function getVisitorTypes()
    {
        try {
            return VisitorType::select(['uuid', 'type'])->get();
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
}
