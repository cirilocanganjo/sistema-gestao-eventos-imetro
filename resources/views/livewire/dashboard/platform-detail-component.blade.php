@section('title', 'Detalhes da Plataforma')
<div>


 <x-dashboard.top-bar />
  <x-dashboard.side-bar />

         <main id="main" class="main">

                <style>
                    .form-select,.form-control {
                        padding: 14px !important;
                    }
                </style>
                  <div class='card'>
                      <div class='card-header'>
                        <h5>Detalhes</h5>
                      </div>

                      <form wire:submit='update'>
                              <div class='card-body'>
                                <div  class="d-flex flex-column align-items-start col-md-12  my-3 mb-1 gap-1">
                                    <div class="col-md-8">
                                        <div class="form-group mb-2">
                                             <label>Nome da aplicação:</label>
                                             <input wire:model='app_name' placeholder="Digite o nome da aplicação" type="text" class='form-control px-2 py-2'>
                                             @error ('app_name') <span class='text-danger'>{{ $message }}</span> @enderror
                                         </div>  
                                </div>

                                <div>
                                    <button class="text-uppercase btn btn-dark">
                                        Atualizar
                                    </button>
                                </div>
                              </div>
                     </form>

                      </div>

                      </div>

                  </div>


         </main>

</div>


