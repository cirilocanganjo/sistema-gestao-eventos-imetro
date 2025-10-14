@props(['status' => false])
<div wire:ignore.self class="modal fade" id="form-event" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content bg-white">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-uppercase"> {{ $status ? 'Editar Evento' : 'Adicionar Evento'}} </h1>
          <button wire:click='close'  type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <div class="gap-1">
                      <div  class='form-group'>
                        <label class='form-label'>Nome do evento:</label>
                        <input id='access-level' wire:model='event_name' type='text' class='form-control rounded' />
                        @error("event_name") <span class='text-danger'>{{ $message }}</span> @enderror
                      </div>
             </div>

        </div>
        <div class="modal-footer border-0">
          <button wire:click='{{$status ? 'update' : 'store'}}'  class="d-flex btn {{$status ? 'btn-success' : ' btn-primary'}}">
          <i class='ri-check-line'></i>
            {{ $status ? 'Atualizar' : 'Salvar' }}
        </button>
        <button type="button" class="d-flex btn  btn-danger" data-bs-dismiss="modal">
          <i class='ri-close-fill'></i>
          Fechar
        </button>
        </div>

      </div>
    </div>
  </div>


