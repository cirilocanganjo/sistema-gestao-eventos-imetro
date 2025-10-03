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

    #[Layout('layouts.auth.app')]
    public function render()
    {
        return view('livewire.auth.recover-password-component');
    }

       public function recoverPassword(User $user) {
        $this->validate([
            'email' => "required"
        ],[
            "email.required" => "Campo obrigatório"
        ]);

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
                $user::query()->where("email", $this->email)->update([
                    "password_verified_code" => $recoverCode
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
            $this->isVerified = false;
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

        $this->validate([
                'verificationCode' =>'required',
                'newPassword' =>'required',
                'confirmNewPassword' =>'required',
            ],[
                'verificationCode.required' =>'Campo obrigatório',
                'newPassword.required' =>'Campo obrigatório',
                'confirmNewPassword.required' =>'Campo obrigatório',
            ]);

        try {

            $user = User::query()->where('email', $this->isVerifiedEmail)
            ->where("password_verified_code", $this->verificationCode)
            ->first();

            if(!$user) {
               LivewireAlert::title('Atenção')
                ->text('Código  de verificação incorreto!')
                ->timer(0)
                ->warning()
                ->withConfirmButton()
                ->confirmButtonText('Fechar')
                ->show();
            }else{
                DB::beginTransaction();
                User::find($user->id)->update([
                    "password" => $this->newPassword,
                    'email_verified_at' => \Carbon\Carbon::now()
                ]);
                DB::commit();               
                
                LivewireAlert::title('Sucesso')
                ->text("A sua senha foi restaurada com successo!")             
                ->success()
                ->withConfirmButton()
                ->confirmButtonText('Fechar')
                ->timer(300000)
                ->show();  
                
                $this->isVerified = false;
                $this->reset(["email"]);
            }

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
