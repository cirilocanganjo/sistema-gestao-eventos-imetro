@props(['categories' => [], 'status' => false])
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
                        <input wire:model='event_name' type='text' class='form-control rounded' />
                        @error("event_name") <span class='text-danger'>{{ $message }}</span> @enderror
                      </div>

                      <div  class='form-group'>
                        <label class='form-label'>Categoria:</label>
                        <select class='form-select'>
                            <option value="">Selecionar</option>
                            @if (isset($categories) and $categories->isNotEmpty())
                            @foreach ($categories as $key => $category )
                            <option wire:key="category-{{$key}}" value="{{$category->uuid}}">{{$category->category}}</option>
                            @endforeach
                            @endif
                        </select>
                        @error("category") <span class='text-danger'>{{ $message }}</span> @enderror
                      </div>

                       <div  class='form-group'>
                        <label class='form-label'>Data do evento:</label>
                        <input wire:model='event_date' type='date' class='form-control rounded' />
                        @error("event_date") <span class='text-danger'>{{ $message }}</span> @enderror
                      </div>

                       <div  class='form-group'>
                        <label class='form-label'>Hora do evento:</label>
                        <input wire:model="event_time" type="time" class="form-control rounded" step="60" placeholder="hh:mm" />
                        @error("event_time") <span class='text-danger'>{{ $message }}</span> @enderror
                      </div>

                      <div  class='form-group'>
                        <label class='form-label'>Descrição:</label>
                        <textarea wire:model='event_description' class="form-control" cols="30" rows="10"></textarea>
                        @error("event_description") <span class='text-danger'>{{ $message }}</span> @enderror
                      </div>

                        <div  class='form-group'>
                        <label class='form-label'>Foto:</label>
                        <input wire:model='photo' type='file' class='form-control rounded' />
                        @error("photo") <span class='text-danger'>{{ $message }}</span> @enderror
                      </div>
             </div>

        </div>
        <div class="modal-footer border-0">
          <button wire:click='{{$status ? 'update' : 'store'}}'  class="d-flex btn {{$status ? 'btn-success' : ' btn-primary'}}">
            {{ $status ? 'Atualizar' : 'Salvar' }}
        </button>
        <button type="button" class="d-flex btn  btn-danger" data-bs-dismiss="modal">
          Fechar
        </button>
        </div>

      </div>
    </div>
  </div>


