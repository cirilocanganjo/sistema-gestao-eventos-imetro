@props(['categories' => [], 'status' => false])
<div wire:ignore.self class="modal" id="modal" >
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-uppercase"> {{ $status ? 'Editar Evento' : 'Adicionar Evento'}} </h1>
          <button wire:click='close' class="modal-close" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body">
            <div class="gap-1">
                      <div  class='form-group'>
                        <label class='form-label'>Nome do evento:</label>
                        <input wire:model='event_name' placeholder="Digite o nome do evento" type='text' class='px-2 py-2 form-control rounded' />
                        @error("event_name") <span class='text-danger'>{{ $message }}</span> @enderror
                      </div>

                      <div  class='form-group'>
                        <label class='form-label'>Categoria:</label>
                        <select wire:model='event_category' class=' event_category px-2 py-2 form-select'>
                            <option value="">Selecionar</option>
                            @if (isset($categories))
                            @foreach ($categories as $key => $category )
                            <option wire:key="category-{{$key}}" value="{{$category->uuid}}">{{$category->category}}</option>
                            @endforeach
                            @endif
                        </select>
                        @error("event_category") <span class='text-danger'>{{ $message }}</span> @enderror
                      </div>

                       <div  class='form-group'>
                        <label class='form-label'>Data do evento:</label>
                        <input wire:model='event_date' type='date' class='px-2 py-2 form-control rounded' />
                        @error("event_date") <span class='text-danger'>{{ $message }}</span> @enderror
                      </div>

                       <div  class='form-group'>
                        <label class='form-label'>Hora do evento:</label>
                        <input wire:model="event_time" type="time" class="px-2 py-2 form-control rounded" step="60" placeholder="hh:mm" />
                        @error("event_time") <span class='text-danger'>{{ $message }}</span> @enderror
                      </div>

                       <div  class='form-group'>
                        <label class='form-label'>Local:</label>
                        <input wire:model='event_location' placeholder="Digite o nome do evento" type='text' class='px-2 py-2 form-control rounded' />
                        @error("event_location") <span class='text-danger'>{{ $message }}</span> @enderror
                      </div>

                      <div  class='form-group'>
                        <label class='form-label'>Descrição:</label>
                        <textarea wire:model='event_description' class="form-control" cols="30" rows="10"></textarea>
                        @error("event_description") <span class='text-danger'>{{ $message }}</span> @enderror
                      </div>

                        <div  class='form-group'>
                        <label class='form-label'>Foto:</label>
                        <input accept="image/*" id='event_photo' wire:model='event_photo' type='file' class='form-control px-2 py-2 rounded' />
                        @error("event_photo") <span class='text-danger'>{{ $message }}</span> @enderror
                      </div>
             </div>

        </div>
        <div class="d-flex gap-1 p-2 align-items-center justify-content-end">
          <button wire:click='{{$status ? 'update' : 'store'}}'  class="d-flex btn {{$status ? 'btn-success' : ' btn-primary'}}">
            {{ $status ? 'Atualizar' : 'Salvar' }}
        </button>
        <button wire:click='close' onclick="closeModal()" type="button" class="d-flex btn  btn-danger">
          Fechar
        </button>
        </div>

    </div>
  </div>


