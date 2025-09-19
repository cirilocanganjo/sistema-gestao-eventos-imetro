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

class FormUserComponent extends Component
{
    public $data = [],$fullname,$phone,$identity_card_number,$email,$password,$visitor_type,$photo,$confirm_password,$gender;

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

    public function storeNewAccount () {            
           $this->dispatch('validate-inputs');                
           //$this->validate();  
        try {
           
            /*
            $email = User::query()->where('email', $this->email)->get();
            $user_type = UserType::where()->value('type', 'visitante');
            if ($email) {
            LivewireAlert::title('Atenção')
               ->text('O email já foi registado no sistema')
               ->warning()
               ->withConfirmButton()
               ->confirmButtonText('Fechar')
               ->show();

            }else {
            DB::beginTransaction();
            $personal_data = PersonalData::create([
                'fullname' =>$this->fullname,
                'gender' =>$this->gender,
                'phone' =>$this->phone,
                'identity_card' =>$this->identity_card_number
            ]);

            $visitor = Visitor::create([
                'visitor_type_id' =>$this->visitor_type,
            ]);

            $user = User::create([
              'username' =>$personal_data->full_name,
              'email' =>$this->email,
              'password' =>$this->password,
              'visitor_id' =>$visitor->uuid,
              'user_type_id' =>$user_type->uuid
            ]);
            DB::commit();
            }

            */
           
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
