<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use App\Models\UserType;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;

class AccessLevelComponent extends Component
{

    public $data_to_delete,$uuid,$status,$access_level,$acess_levels,$searcher;
    protected $listeners = ['delete' =>'confirmAccessLevelDeletion'];
    public function mount()
    {
        $this->status = false;
    }

    #[Layout('layouts.dashboard.app')]
    public function render()
    {
        return view('livewire.dashboard.access-level-component',[
            'data' =>$this->getAccessLevels(),
        ]);
    }

    public function store () {
        $this->validate([
            'access_level' => 'required|unique:user_types,type'
        ],[
            'access_level.required' => 'Campo obrigatório *',
            'access_level.unique' => 'Este nivel de acesso já existe *',
        ]);
        try {
            DB::beginTransaction();
            UserType::query()->create([
                'type' => $this->pull('access_level')
            ]);
            DB::commit();
             LivewireAlert::title('Sucesso')
            ->text("Nivel de acesso cadastrado com sucesso")
            ->success()
            ->withConfirmButton()
            ->confirmButtonText('Fechar')
            ->show();
        } catch (\Throwable $th) {
            DB::rollBack();
            LivewireAlert::title('Erro')
          ->text('erro: ' .$th->getMessage())
          ->error()
          ->withConfirmButton()
          ->confirmButtonText('Fechar')
          ->show();
        }
    }

    public function update () {
        $this->validate([
            'access_level' => 'required'
        ],[
            'access_level.required' => 'Campo obrigatório *',
        ]);
        try {
            DB::beginTransaction();
            UserType::query()->where('uuid', $this->uuid)->update([
                'type' => $this->pull('access_level')
            ]);
            DB::commit();
             LivewireAlert::title('Sucesso')
            ->text("Nivel de acesso atualizado com sucesso")
            ->success()
            ->withConfirmButton()
            ->confirmButtonText('Fechar')
            ->show();
        } catch (\Throwable $th) {
         LivewireAlert::title('Erro')
          ->text('erro: ' .$th->getMessage())
          ->error()
          ->withConfirmButton()
          ->confirmButtonText('Fechar')
          ->show();
        }
    }

    public function delete ($uuid) {
        try {
            $this->uuid = $uuid;
            LivewireAlert::title('Atenção')
            ->text('Deseja realmente, terminar sessão?')
            ->warning()
            ->withDenyButton()
            ->withConfirmButton()
            ->confirmButtonText('Sim, confirmar')
            ->denyButtonText('Não, cancelar')
            ->withOptions(['allowOutsideClick' => false])
            ->timer(0)
            ->onConfirm('confirmAccessLevelDeletion')
            ->show();

        } catch (\Throwable $th) {
            DB::rollBack();
            LivewireAlert::title('Erro')
          ->text('erro: ' .$th->getMessage())
          ->error()
          ->withConfirmButton()
          ->confirmButtonText('Fechar')
          ->show();
        }
    }

    public function confirmAccessLevelDeletion () {
        try {
            DB::beginTransaction();
            $this->data_to_delete = UserType::query()->where('uuid', $this->uuid)->delete();
            if ($this->data_to_delete >= 1) {
            LivewireAlert::title('Sucesso')
            ->text("Nivel de acesso eliminado com sucesso")
            ->success()
            ->withConfirmButton()
            ->confirmButtonText('Fechar')
            ->show();
            }
            DB::commit();
        } catch (\Throwable $th) {
        LivewireAlert::title('Erro')
          ->text('erro: ' .$th->getMessage())
          ->error()
          ->withConfirmButton()
          ->confirmButtonText('Fechar')
          ->show();
        }
    }

    public function getAccessLevels()
    {
        try {
            if ($this->searcher) {
            return UserType::query()->when($this->searcher, fn ($q) => $q->where('type', 'like', "%{$this->searcher}%")
            )->get();
            }
            return UserType::query()->get();
        } catch (Exception $e) {
         LivewireAlert::title('Erro')
          ->text('ERRO: '.$e->getMessage())
          ->error()
          ->withConfirmButton()
          ->confirmButtonText('Fechar')
          ->show();
        }
    }

    public function edit($uuid)
    {
        try {
            $this->uuid = $uuid;
            $data = UserType::query()->where('uuid', $uuid)->first();
            $this->status = true;
            $this->access_level = $data->type ?? '';
        } catch (Exception $e) {
         LivewireAlert::title('Erro')
          ->text('ERRO: '.$e->getMessage())
          ->error()
          ->withConfirmButton()
          ->confirmButtonText('Fechar')
          ->show();
        }
    }

    public function close () {
        $this->status = false;
        $this->reset(['access_level']);
    }
}
