@section('title', 'Utilizadores')
<div>

 <x-dashboard.top-bar />
  <x-dashboard.side-bar />

         <main id="main" class="main">
         <x-dashboard.modal-user :visitor_types="$visitor_types ?? []" :access_levels="$access_levels ?? []" />

                  <div class='card'>
                      <div class='card-header'>
                        <h5>Utilizadores</h5>
                      </div>

                      <div class='card-body'>
                      <div class='d-flex align-items-center gap-1 mt-3 mb-3'>
                          <button id='button-add' class='btn btn-dark d-flex px-2 py-2'>
                            <i class='ri-add-line'></i>
                            <span>Adicionar</span>
                          </button>
                          <input wire:model.live='searcher' type='text' placeholder="Pesquisar utilizador" class='form-control px-2 py-2' />
                          <input wire:model.live='startdate' type='date'  class='form-control px-2 py-2' />
                          <input wire:model.live='enddate' type='date' class='form-control px-2 py-2' />
                      </div>

                        <div class='table-responsive'>
                          <table class='table table-hover'>
                            <thead class='text-center'>
                              <tr>
                                  <th>Foto</th>
                                  <th>Data</th>
                                  <th>Nome</th>
                                  <th>Email</th>
                                  <th>Acesso</th>
                                  <th>Tipo visitante</th>
                                  <th>Status</th>
                                  <th>Opções</th>
                              </tr>
                            </thead>
                            <tbody class="text-center">
                              @if (isset($data))
                                @foreach ($data as $key => $user)
                                  <tr>
                                      <td>
                                    
                                       @if (!$user->userPersonalData->photo)
                                             @if($user->userPersonalData->gender === 'male')
                                              <img style="height:45px; width: 50px;" class='rounded' src="{{ asset('dashboard/assets/img/9bce03b6e54cdf0b7b5cf85c5d9d87bc.png') }}" />
                                              @elseif ($user->userPersonalData->gender === 'female')
                                              <img style="width: 45px;" class='img-fluid rounded' src="{{ asset('dashboard/assets/img/592727514f8b799775df3834b591ee22.png') }}" />
                                              @endif

                                        @else
                                        <img style="width: 45px;" class='img-fluid rounded' src="{{ asset('storage/imgs/' . $user->userPersonalData->photo) }}" />
                                        @endif 

                                       
                                      </td>
                                      <td>{{ $user->created_at ?? '' }}</td>
                                      <td>{{ $user->user_name ?? '' }}</td>
                                      <td>{{ $user->email ?? '' }}</td>
                                      <td class='text-center'>{{ $user->userType->type ?? '' }}</td>
                                      <td  style="text-align: justify; width: 350px; word-break: break-word; overflow-wrap: break-word; white-space: normal;" class='text-center'>{{ $user->visitorForVisitorType->visitorType->type ?? '' }}</td>
                                      <td>{{ $user->status === 'active' ? 'ativo' : 'inativo' }}</td>
                                      <td>
                                        <div class='button-edit d-flex align-items-center gap-1'>
                                            <button 
                                            wire:click='edit({{ $user->id }})' 
                                            wire:key='{{ $key }}' 
                                            data-uuid="{{ $user->uuid }}"
                                            class='d-flex gap-1 btn btn-sm btn-primary'>
                                            <i class='ri-edit-box-line'></i>
                                            <span>Editar</span>
                                            </button>

                                            <button wire:key='{{ $key }}' class='d-flex gap-1 btn btn-sm btn-danger'>
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


@push('users')
<script> 
  
    // Função para inicializar os event listeners
    function initializeEventListeners() {
        // Selecionar o botão de adicionar
        const buttonAdd = document.getElementById('button-add');
        
        // Selecionar todos os botões de edição
        const buttonsEdit = document.querySelectorAll('.button-edit');

        // Remover event listeners antigos para evitar duplicatas
        if (buttonAdd) {
            const newButtonAdd = buttonAdd.cloneNode(true); // Clonar para remover listeners
            buttonAdd.parentNode.replaceChild(newButtonAdd, buttonAdd);
            
            // Adicionar evento ao botão de adicionar
            newButtonAdd.addEventListener('click', () => {
                openModal();
            });
        }

        // Adicionar evento a cada botão de edição
        buttonsEdit.forEach(button => {
            const newButton = button.cloneNode(true); // Clonar para remover listeners
            button.parentNode.replaceChild(newButton, button);
            newButton.addEventListener('click', () => {
                const uuid = newButton.getAttribute('data-uuid'); // Obter o UUID do botão clicado
                openModal(uuid); // Passar o UUID para a função openModal
            });
        });

        // Evitar fechar com a tecla Esc
        const handleEscape = function(event) {
            if (event.key === 'Escape') {
                event.preventDefault();
            }
        };
        // Remover listener antigo do keydown
        document.removeEventListener('keydown', handleEscape);
        document.addEventListener('keydown', handleEscape);
        
    }

    // Função para abrir o modal
    function openModal(uuid = null) {
        const modal = document.getElementById('modal');
        if (modal) {
            modal.style.display = 'flex';
            modal.classList.add('fade-in');
            if (uuid) {
                console.log('Editando com UUID:', uuid);
                // Lógica para carregar dados com o UUID, se necessário
            }
        }
    }

    // Função para fechar o modal
    function closeModal() {
        const modal = document.getElementById('modal');
        if (modal) {
            modal.style.display = 'none';
            modal.classList.remove('fade-in');
        }
    }

     document.addEventListener("livewire:init", () => {                
            Livewire.hook('morph.updated', ({ component, el, skip }) => {   // Reexecuta o initializeEventListeners após o processamento de mensagens Livewire
                initializeEventListeners();
            });
            });
    
    document.addEventListener('DOMContentLoaded', initializeEventListeners);    
    document.addEventListener('livewire:navigated', () => {
        initializeEventListeners(); 
    });

     
     
    


 

</script>
@endpush
