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
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormUserComponent extends Component
{
    use WithFileUploads;
    public $photo,$user_type_uuid,$fileName,$aleready_stored_email, $data = [],$fullname,$phone,$identity_card_number,$email,$password,$visitor_type,$confirm_password,$gender;

    public function mount () {
        try {
            $this->user_type_uuid = UserType::query()->where(fn ($q) => $q->where('type', 'visitante'))->orWhere('type', 'Visitante')->first()->uuid ?? '';

        }catch( Exception $e) {
            LivewireAlert::title('ERRO')
             ->text('erro: ' .$e->getmessage())
             ->error()
             ->withConfirmButton()
             ->timer(0)
             ->confirmButtonText('Fechar')
             ->show();
        }
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
           $this->aleready_stored_email = $user->query()->where('email',$this->email)->value('email') ?? null;
           $this->dispatch('validate-inputs', aleready_stored_email: $this->aleready_stored_email);

            while (!$this->aleready_stored_email and $this->fullname and $this->phone
                and $this->identity_card_number
                and $this->email
                and $this->password
                and $this->visitor_type
                and $this->photo
                and $this->confirm_password
                and $this->gender
            ) {

            DB::beginTransaction();
            if ($this->photo and $this->photo->isValid()) {
             $this->fileName = md5($this->photo->getClientOriginalName() .now()). '.' .$this->photo->getClientOriginalExtension();
             $this->photo->storeAs("imgs", $this->fileName, 'public');
            }

            $visitor = Visitor::create([
                'visitor_type_uuid' =>$this->visitor_type,
            ]);

            $personal_data = PersonalData::create([
                'full_name' =>$this->pull('fullname'),
                'gender' =>$this->pull('gender'),
                'phone' =>$this->pull('phone'),
                'photo' =>$this->pull('fileName') ?? null,
                'visitor_uuid'=>$visitor->uuid,
                'identity_card' =>$this->pull('identity_card_number')
            ]);

            $user = User::create([
              'user_name' =>$personal_data->full_name,
              'email' =>$this->pull('email'),
              'password' =>\Hash::make($this->password),
              'visitor_uuid' =>$visitor->uuid,
              'user_type_uuid' =>$this->pull('user_type_uuid') ?? '',
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
              $this->reset(['fullname','phone','identity_card_number','email','password','visitor_type','photo','confirm_password','gender']);
              $this->dispatch('reset-photo-input-value');
            }

        } catch (Exception $e) {
            DB::rollback();
            $this->reset(['fullname','phone','identity_card_number','email','password','visitor_type','photo','confirm_password','gender']);
            if (Storage::disk('public')->exists('imgs/' . $this->fileName)) { //Remove photo from storage if it exists there
              Storage::disk('public')->delete('imgs/' . $this->fileName);
            }
            LivewireAlert::title('Erro')
             ->text('erro: ' .$e->getmessage())
             ->error()
             ->withConfirmButton()
             ->timer(0)
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
