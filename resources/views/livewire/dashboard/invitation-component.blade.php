@section('title', 'Convites')
<div>

 <x-dashboard.top-bar />
  <x-dashboard.side-bar />
  <x-dashboard.modal-send-event-invitation /> 
         <main id="main" class="main">

                  <div class='card'>
                      <div class='card-header'>
                        <h5>Convites</h5>
                      </div>

                      <div class='card-body'>
                      

                      <x-dashboard.invitation-event-inputs-filter  />
                      <x-dashboard.invitation-event-filter-buttons :allInvitationEventButton="$allInvitationEventButton ?? true"                      
                      :sentInvitationEventButton="$sentInvitationEventButton ?? false"
                      :receivedInvitationEventButton="$receivedInvitationEventButton ?? false"
                      :rejectedInvitationEventButton="$rejectedInvitationEventButton ?? false"
                       />
                      <x-dashboard.invitation-event-table />

                      </div>

                  </div>

         </main>

</div>


@push('invitations')

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
                        //console.log('Editando com UUID:', uuid);
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

           

                   function initSelect2() {             

                            $(".invitation_sender").select2({
                              width: '100%',
                              theme: "default",
                              language: "pt",
                              placeholder: "Selecionar convidados",
                              allowClear: true,
                              dropdownParent: $("#modal"),
                              }).on('change', function (e) {
                              @this.set('invitation_sender', $(this).val());                       
                              });
                     }                      
                                  
                          initSelect2(); 
            
                        document.addEventListener("livewire:init", () => {                
                        Livewire.hook('morph.updated', ({ component, el, skip }) => {   // Reexecuta o initSelect2 após o processamento de mensagens Livewire
                            initSelect2();
                        });

                        // Escuta eventos personalizados emitidos do backend Livewire
                        Livewire.on('refreshSelect2', () => {
                            $('.invitation_sender').select2('destroy'); 
                            initSelect2();

                            let invitation_sender = $wire.get('invitation_sender');
                            $('.invitation_sender').val(invitation_sender).trigger('change'); 
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

                        
        </script>




@endpush
