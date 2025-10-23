@props(['status' => false])
<div wire:ignore.self class="modal" id="modal">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-uppercase"> {{ $status ? 'Editar nivel de acesso' : 'Adicionar nivel de acesso'}} </h1>
          <button wire:click='close' class="modal-close" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body">

            <div class="gap-1">
                      <div  class='form-group'>
                        <label class='form-label'>Nível de acesso:</label>
                        <input id='access-level' wire:model='access_level' type='text' class='form-control px-2 py-2 rounded' />
                        @error("access_level") <span class='text-danger'>{{ $message }}</span> @enderror
                      </div>
             </div>

        </div>
        <div class="d-flex gap-1 p-2 align-items-center justify-content-end">
          <button wire:click='{{$status ? 'update' : 'store'}}'  class="d-flex btn {{$status ? 'btn-success' : ' btn-primary'}}">         
            {{ $status ? 'Atualizar' : 'Salvar' }}
        </button>
        <button wire:click='close' onclick="closeModal()" type="button" class="d-flex btn  btn-danger" data-bs-dismiss="modal">         
          Fechar
        </button>
        </div>
    
    </div>
  </div>


