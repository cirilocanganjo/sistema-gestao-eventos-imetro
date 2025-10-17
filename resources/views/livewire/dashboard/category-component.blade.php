@section('title', 'Categorias')
<div>

 <x-dashboard.top-bar />
  <x-dashboard.side-bar />

         <main id="main" class="main">    
          <x-dashboard.modal-event-category :status="$status ?? false " />        
                  <div class='card'>
                      <div class='card-header'>
                        <h5>Categorias</h5>
                      </div>

                      <div class='card-body'>
                      <div class='d-flex align-items-center gap-1 mt-3 mb-3'>
                          <button id='button-add'  class='btn btn-dark d-flex px-2 py-2'>
                            <i class='ri-add-line'></i>
                            <span>Adicionar</span>
                          </button>
                          <input wire:model.live='searcher' type='text' placeholder="Pesquisar categoria" class='form-control px-2 py-2' />
                          <input wire:model.live='startdate' type='date'  class='form-control px-2 py-2' />
                          <input wire:model.live='enddate' type='date' class='form-control px-2 py-2' />
                      </div>

                        <div class='table-responsive'>
                          <table class='table table-hover'>
                            <thead class=''>
                              <tr>
                                  <th>Data</th>
                                  <th>Categoria</th>
                                  <th>Cadastrada por</th>
                                  <th>Opções</th>
                              </tr>
                            </thead>
                            <tbody class="">
                              @if (isset($data) and $data->count() > 0)
                                @foreach ($data as $key => $category)
                                  <tr>
                                       <td>{{ $category->created_at }}</td>
                                       <td>{{ $category->category }}</td>
                                       <td>{{ $category->user->user_name ?? '' }}</td>
                                      <td>
                                        <div class='d-flex align-items-center gap-1'>
                                            <button  wire:key='{{ $key }}'  
                                            wire:click="edit('{{ $category->uuid }}')"   
                                            data-uuid="{{ $category->uuid }}"                                          
                                            class='button-edit d-flex gap-1 btn btn-sm btn-primary'>
                                            <i class='ri-edit-box-line'></i>
                                            <span>Editar</span>
                                            </button>

                                            <button wire:key='{{ $key }}'  wire:click="delete('{{ $category->uuid }}')" class='d-flex gap-1 btn btn-sm btn-danger'>
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

@push('categories')
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

    // Inicializar os eventos no carregamento inicial
    document.addEventListener('DOMContentLoaded', initializeEventListeners);

    // Reinicializar os eventos após navegação com wire:navigate
    document.addEventListener('livewire:navigated', initializeEventListeners);
</script>
@endpush