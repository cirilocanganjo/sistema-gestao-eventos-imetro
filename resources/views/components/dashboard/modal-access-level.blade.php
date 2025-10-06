
<div wire:ignore.self class="modal fade" id="access-level-user" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content bg-white">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-uppercase">Adicionar utilizador</h1>
          <button  type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
         
            <div class="gap-1">
                      <div  class='form-group'>
                        <label class='form-label'>Nível de acesso:</label>
                        <input id='access-level' wire:model='access_level' type='text' class='form-control rounded' />
                        @error("access_level") <span class='text-danger'>{{ $message }}</span> @enderror
                      </div>                  
            </div>

        </div>
        <div class="modal-footer border-0">
          <button  class="d-flex btn btn-primary">
          <i class='ri-check-line'></i>
            Salvar
        </button>
        <button type="button" class="d-flex btn  btn-danger" data-bs-dismiss="modal">
          <i class='ri-close-fill'></i>
          Fechar
        </button>
        </div>
        
      </div>
    </div>
  </div>


