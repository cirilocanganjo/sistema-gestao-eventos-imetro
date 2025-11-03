@props(['categories' => [], 'status' => false])
<div wire:ignore.self class="modal" id="modal">
      <div class="modal-content" style='max-width: 980px; width: 100%; max-height: 80vh; '>
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-uppercase"> {{ $status ? 'Editar' : 'Convidar'}} </h1>
          <button wire:click='close' class="modal-close" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body">
                 <div class='table-responsive'>
              <table class='table table-hover'>
                <thead>
                  <tr>
                    <th>Foto</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                  </tr>
                </thead>

              </table>
          </div>

        </div>
        
        <div class="d-flex gap-1 p-2 align-items-center justify-content-end">

          <button wire:click='sendEventInvitation'  class="d-flex btn btn-primary">
            Convidar
         </button>

        <button wire:click='close' onclick="closeModal()" type="button" class="d-flex btn  btn-danger">
          Fechar
        </button>
        </div>

    </div>
  </div>


