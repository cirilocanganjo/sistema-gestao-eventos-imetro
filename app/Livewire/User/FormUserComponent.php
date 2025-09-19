<?php

namespace App\Livewire\User;

use App\Models\PersonalData;
use App\Models\User;
use App\Models\UserType;
use App\Models\Visitor;
use App\Models\VisitorType;
use Exception;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormUserComponent extends Component
{
    use WithFileUploads;
    public $photo,$visitor_user_type_uuid,$fileName,$aleready_stored_email, $data = [],$fullname,$phone,$identity_card_number,$email,$password,$visitor_type,$confirm_password,$gender;

    public function mount () {
    $this->visitor_user_type_uuid = UserType::query()->whereIn('type', ['visitante','Visitante'])->value('uuid');
    }

    public function boot () {
             
    }

    #[Layout('layouts.user.app')]
    public function render () {
        return view('livewire.user.form-user-component',[
            'visitor_types' =>$this->getVisitorTypes()
        ]);
    }

    public function rules () {
        return [
            'fullname' => 'required',
            'phone' => 'required',
            'identity_card_number' => 'required',
            'email' => 'required',
            'password' => 'required',
            'visitor_type' => 'required',
        ];
    }

    public function messages () {
        return [
            'fullname.required' => 'Campo obrigatório *',
            'phone.required' => 'Campo obrigatório *',
            'identity_card_number.required' => 'Campo obrigatório *',
            'email.required' => 'Campo obrigatório *',
            'password.required' => 'Campo obrigatório *',
            'visitor_type.required' => 'Campo obrigatório *',
        ];
    }

    public function storeNewAccount (User $user) {           
   
        try {
           $this->aleready_stored_email = $user->query()->where('email',$this->email)->value('email');
           $this->dispatch('validate-inputs', aleready_stored_email: $this->aleready_stored_email);                
                                
            if (
                blank($this->aleready_stored_email) 
                and blank($this->fullname)
                and blank($this->phone)
                and blank($this->identity_card_number)
                and blank($this->email)
                and blank($this->password)
                and blank($this->visitor_type)
                and blank($this->photo)
                and blank($this->confirm_password)
                and blank($this->gender)
            ) {          

            }else {

            if ($this->photo and $this->photo->isValid()) {
             $this->fileName = md5($this->photo->getClientOriginalName() .now()). '.' .$this->photo->getClientOriginalExtension();
             $this->photo->storeAs("imgs", $this->fileName, 'public');
            }
            DB::beginTransaction();
            $personal_data = PersonalData::create([
                'fullname' =>$this->pull('fullname'),
                'gender' =>$this->pull('gender'),
                'phone' =>$this->pull('phone'),
                'identity_card' =>$this->pull('identity_card_number')
            ]);

            $visitor = Visitor::create([
                'visitor_type_id' =>$this->visitor_type,
            ]);

            $user = User::create([
              'username' =>$personal_data->full_name,
              'email' =>$this->pull('email'),
              'password' =>$this->pull('password'),
              'visitor_id' =>$visitor->uuid,
              'user_type_id' =>$this->visitor_user_type_uuid ?? '',
              'photo' =>$this->pull('fileName') ?? null
            ]);
            DB::commit();

            LivewireAlert::title('SUCESSO')
              ->html("
                    <div>
                        A sua conta foi criada com sucesso, 
                        <a style='text-decoration:underline; color:blue;' href='" .route('user.login'). "'>clique aqui</a> para efectuar o login.
                    </div>
              ")
              ->success()
              ->withConfirmButton()
              ->confirmButtonText('Fechar')
              ->withOptions([
                'allowOutsideClick' => false,
                'timer' => 0,
                'showCloseButton' => true, 
              ])->show();  

            }            
           
        } catch (Exception $e) {
            DB::rollback();
            LivewireAlert::title('Erro')
             ->text('erro: ' .$e->getmessage())
             ->error()
             ->withConfirmButton()
             ->confirmButtonText('Fechar')
             ->show();
        }
    }

    public function updated () {
        if ($this->phone === '+244') {
            $this->phone = null;
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
   
}
