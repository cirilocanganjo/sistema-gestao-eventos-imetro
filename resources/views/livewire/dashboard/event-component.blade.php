@section('title', 'Eventos')
<div>

 <x-dashboard.top-bar />
  <x-dashboard.side-bar />

         <main id="main" class="main">

          <x-dashboard.modal-event 
            :status="$status ?? false" 
            :categories="$categories ?? [] " 
            />

            <x-dashboard.modal-event-photo
             :eventName="$eventName" 
             :eventCoverPhoto="$eventCoverPhoto" 
             />

                  <div class='card'>
                      <div class='card-header'>
                        <h5>Eventos</h5>
                      </div>

                      <div class='card-body'>
                      <div class='d-flex align-items-center gap-1 mt-3 mb-3'>
                          <button id='button-add'  class='btn btn-dark d-flex px-2 py-2'>
                            <i class='ri-add-line'></i>
                            <span>Adicionar</span>
                          </button>
                          <input wire:model.live='searcher' type='text' placeholder="Pesquisar evento" class='form-control px-2 py-2' />
                          <input wire:model.live='startdate' type='date'  class='form-control px-2 py-2' />
                          <input wire:model.live='enddate' type='date' class='form-control px-2 py-2' />
                      </div>

                        <div class='table-responsive'>
                          <table class='table table-hover'>
                            <thead>
                              <tr>
                                  <th>Foto</th>
                                  <th>Evento</th>
                                  <th class='text-center'>Data</th>
                                  <th class='text-center'>Hora</th>
                                  <th class='text-center'>Local</th>
                                  <th class='text-center'>Descrição</th>
                                  <th class='text-center'>Categoria</th>
                                  <th>Utilizador</th>
                                  <th class='text-center'>Opções</th>
                              </tr>
                            </thead>
                            <tbody class="text-center">
                              @if (isset($data) and $data->count() > 0)
                                @foreach ($data as $key => $event)
                                  <tr>
                                        
                                      <td data-uuid="{{ $event->uuid }}" class='tdImgEventDetails' style='cursor: pointer;'>
                                      <img 
                                        wire:click="showEventCoverPhoto('{{ $event->uuid }}')"  
                                        class='eventDetailImg rounded' src="{{ asset('storage/imgs/' . $event->event_cover_photo) }}"                                      
                                        style="height:50px; width: 60px;" 
                                      />
                                      </td>
                                     <td class='text-center' style="text-align: justify; width: 350px; word-break: break-word; overflow-wrap: break-word; white-space: normal;">{{ $event->event_name }}</td>
                                      <td class='text-center' style="text-align: justify; width: 350px; word-break: break-word; overflow-wrap: break-word; white-space: normal;">{{ $event->event_date }}</td>
                                      <td class='text-center' style="text-align: justify; width: 350px; word-break: break-word; overflow-wrap: break-word; white-space: normal;">{{ $event->event_time }}</td>
                                      <td class='text-center' style="text-align: justify; width: 350px; word-break: break-word; overflow-wrap: break-word; white-space: normal;">{{ $event->location  }}</td>
                                      <td class='text-center' style="text-align: center; width: 350px; word-break: break-word; overflow-wrap: break-word; white-space: normal;">{{ $event->event_description }}</td>
                                       <td class='text-center' style="text-align: justify; width: 350px; word-break: break-word; overflow-wrap: break-word; white-space: normal;">{{ $event->eventCategory->category ?? '' }}</td>
                                       <td>{{ $event->user->user_name }}</td>
                                      <td>
                                        <div class='d-flex align-items-center gap-1'>
                                            <button wire:click="highlightEvent('{{ $event->uuid }}')" wire:key='{{ $key }}' class='d-flex gap-1 btn {{ $event->event_highlighted ? ' btn-warning' : ' btn-secondary'}} btn-sm'>
                                            <i class='ri-pushpin-line'></i>
                                            <span>{{ $event->event_highlighted ? 'Destacado' : 'Destacar'}}</span>
                                            </button>

                                            <button wire:click="edit('{{ $event->uuid }}')" 
                                              wire:key='event-{{$key}}'
                                              data-uuid="{{ $event->uuid }}" 
                                              class='button-edit d-flex gap-1 btn btn-sm btn-primary'>
                                            <i class='ri-edit-box-line'></i>
                                            <span>Editar</span>
                                            </button>

                                            <button wire:click="delete('{{ $event->uuid }}')"  wire:key='event-{{$key}}'  class='d-flex gap-1 btn btn-sm btn-danger'>
                                              <i class='ri-delete-bin-4-line'></i>
                                              <span>Eliminar</span>
                                            </button>

                                        </div>
                                      </td>
                                  </tr>
                                  @endforeach
                              @else
                                <tr>
                                  <td class="text-center" colspan="12">
                                  <div class='alert alert-warning text-center'>Nenhum resultado encontrado!</div>
                                </td>
                                </tr>
                              @endif
                            </tbody>
                          </table>
                        </div>
                      </div>

                  </div>

         </main>

</div>

@push('events')

<script>
    // Função para inicializar os event listeners
    function initializeEventListeners() {
        const buttonAdd = document.getElementById('button-add');
        const buttonsEdit = document.querySelectorAll('.button-edit');
        const tdImageDetails = document.querySelectorAll('.tdImgEventDetails');

        // Botão "Adicionar"
        if (buttonAdd) {
            const newButtonAdd = buttonAdd.cloneNode(true);
            buttonAdd.replaceWith(newButtonAdd);

            newButtonAdd.addEventListener('click', () => openModal());
        }

        // Botões "Editar"
        buttonsEdit.forEach(button => {
            const newButton = button.cloneNode(true);
            button.replaceWith(newButton);

            newButton.addEventListener('click', () => {
                const uuid = newButton.getAttribute('data-uuid');
                openModal(uuid);
            });
        });

        // Imagem de detalhes
        tdImageDetails.forEach(td => {
            const newTd = td.cloneNode(true);
            td.replaceWith(newTd);

            newTd.addEventListener('click', () => {
                const uuid = newTd.getAttribute('data-uuid');
                openEventImageDetailModal(uuid);
            });
        });

        // Evitar fechar com ESC
        const handleEscape = event => {
            if (event.key === 'Escape') event.preventDefault();
        };

        document.removeEventListener('keydown', handleEscape);
        document.addEventListener('keydown', handleEscape);
    }

    // Função para abrir o modal principal
    function openModal(uuid = null) {
        const modal = document.getElementById('modal');
        if (modal) {
            modal.style.display = 'flex';
            modal.classList.add('fade-in');
            if (uuid) {
                console.log('Editando com UUID:', uuid);
                // Lógica de carregamento do evento aqui
            }
        }
    }

    // Função para fechar o modal principal
    function closeModal() {
        const modal = document.getElementById('modal');
        if (modal) {
            modal.style.display = 'none';
            modal.classList.remove('fade-in');
        }
    }



    // Função para abrir modal de detalhes da imagem
    function openEventImageDetailModal(uuid = null) {
        const eventImageDetailModal = document.getElementById('event-image-detail-modal');
        if (eventImageDetailModal) {
            eventImageDetailModal.style.display = 'flex';
            eventImageDetailModal.classList.add('fade-in');
            //console.log('Abrindo detalhe da imagem com UUID:', uuid);
        }
    }

     function closeModalImageDetailsModal() {
        const modal = document.getElementById('event-image-detail-modal');
        if (modal) {
            modal.style.display = 'none';
            modal.classList.remove('fade-in');
        }
    }

    // Inicialização
    document.addEventListener('DOMContentLoaded', initializeEventListeners);
    document.addEventListener('livewire:navigated', initializeEventListeners);

    // Eventos Livewire
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('event-created', () => {
            const eventPhoto = document.getElementById('event_photo');
            if (eventPhoto) eventPhoto.value = '';
        });

        Livewire.on('event-updated', () => {
            const eventPhoto = document.getElementById('event_photo');
            if (eventPhoto) eventPhoto.value = '';
            });
        });

          /* function initSelect2() {             

                    $(".event_category").select2({
                      width: '100%',
                      theme: "default",
                      language: "pt",
                      placeholder: "Selecionar categoria",
                      allowClear: true,
                      dropdownParent: $("#modal"),
                      }).on('change', function (e) {
                      @this.set('event_category', $(this).val());                       
                      });
             }                      
                          
                  initSelect2(); 
    
                document.addEventListener("livewire:init", () => {                
                Livewire.hook('morph.updated', ({ component, el, skip }) => {   // Reexecuta o initSelect2 após o processamento de mensagens Livewire
                    initSelect2();
                });

                // Escuta eventos personalizados emitidos do backend Livewire
                Livewire.on('refreshSelect2', () => {
                    $('.event_category').select2('destroy'); 
                    initSelect2();

                    let eventCategory = $wire.get('event_category');
                    $('.event_category').val(eventCategory).trigger('change'); 
                 
                });

                // Listener manual do window
                window.addEventListener('initSelect2', () => {
                    initSelect2();
                    });
                });

              document.addEventListener("DOMContentLoaded",  initSelect2);
                  document.addEventListener("livewire:navigated", () => {
                    initSelect2();
                });

                */
</script>

@endpush






