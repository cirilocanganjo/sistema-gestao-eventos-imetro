<?php

namespace App\Livewire\Auth;
use App\Models\User;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use \App\Mail\User\RecoverPassword;
use Exception;
use Livewire\Component;

class RecoverPasswordComponent extends Component
{
    public $isVerified,$isVerifiedEmail,$email, $verificationCode, $newPassword,$confirmNewPassword;
    protected $rules = ['email' => "required"];
    protected $messages = ["email.required" => "Campo obrigatório"];

    #[Layout('layouts.dashboard.app')]
    public function render()
    {
        return view('livewire.auth.recover-password-component');
    }

       public function recoverPassword(User $user) {
        $this->validate();
        try {
            $user = User::where("email", $this->email)->first();
            if(!$user) {
               LivewireAlert::title('Atenção!')
                ->text("Não existe nenhuma conta associada a este email!")
                ->timer(0)
                ->warning()
                ->withConfirmButton()
                ->confirmButtonText('Fechar')
                ->timer(0)
                ->show();  
            }else{
               $this->isVerified = true;
               $this->isVerifiedEmail = $this->email;
               $recoverCode = rand(1,1000);
               DB::beginTransaction();
                $user->where("email", $this->email)->update([
                    "reset_password_code" => $recoverCode
                ]);
                DB::commit();

                try {
                Mail::to($this->email)->send(new RecoverPassword($recoverCode));
                LivewireAlert::title('Atenção')
                ->text("Foi-lhe enviado o código para recuperação da sua senha, consulte o seu email!")
                ->timer(0)
                ->warning()
                ->withConfirmButton()
                ->confirmButtonText('Fechar')
                ->timer(0)
                ->show(); 
                
               }catch(Exception$e) {
                LivewireAlert::title('Atenção!')
                ->text('Encontramos o seguinte problema ao enviar o email: '.$e->getmessage())
                ->timer(0)
                ->warning()
                ->withConfirmButton()
                ->confirmButtonText('Fechar')
                ->show();  
               }
                
            }
        } catch (\Throwable $th) {
            DB::rollBack();
             LivewireAlert::title('Erro')
                ->text('erro: '.$th->getMessage())
                ->timer(0)
                ->error()
                ->withConfirmButton()
                ->confirmButtonText('Fechar')
                ->show(); 
        }
    }

    public function updateCredentials() {
        try {
            
        } catch (Exception $e) {
            LivewireAlert::title('Erro')
                ->text('erro: '.$e->getmessage())
                ->timer(0)
                ->error()
                ->withConfirmButton()
                ->confirmButtonText('Fechar')
                ->show(); 
        }
    }

}
