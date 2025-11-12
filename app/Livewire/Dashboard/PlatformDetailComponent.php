<?php

namespace App\Livewire\Dashboard;

use App\Models\AppDetail;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class PlatformDetailComponent extends Component
{
    public $id,$app_name;
    protected $listeners = ["confirm" => "confirmAplicatioNameUpdate"];

    public function mount()
    {
        $this->app_name = AppDetail::query()->first()->app_name ?? '';
    }


    public function render() : View
    {
        return view('livewire.dashboard.platform-detail-component')->layout("layouts.dashboard.app");
    }

    public function update() : void
    {
           $this->id = AppDetail::query()->select(['id'])->value('id');                
           LivewireAlert::title('Atenção')
            ->text('Deseja realmente, alterar o nome da aplicação?')
            ->warning()
            ->withDenyButton()
            ->withConfirmButton()
            ->confirmButtonText('Sim, confirmar')
            ->denyButtonText('Não, cancelar')
            ->withOptions(['allowOutsideClick' => false])
            ->timer(0)
            ->onConfirm('confirmAplicatioNameUpdate')
            ->show();
    }

    public function confirmAplicatioNameUpdate () {
        try {
            \DB::beginTransaction();
            if ($this->id) {
                AppDetail::query()->find($this->id)->update([
                    'app_name' => $this->app_name,
                    'user_id' => auth()->user()->id
                ]);
            }else{
                AppDetail::create([
                    'app_name' => $this->app_name,
                    'user_id' => auth()->user()->id
                ]);
            }

            \DB::commit();
             LivewireAlert::title('Sucesso')
                ->text('Operação realizada com sucesso!')
                ->success()
                ->withConfirmButton()
                ->timer(0)
                ->confirmButtonText('Fechar')
                ->show();           

        } catch (\Exception $e) {
            \DB::rollBack();
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
