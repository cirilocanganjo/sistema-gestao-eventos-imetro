@section('title', 'Meu perfil')
<div>


 <x-dashboard.top-bar />
  <x-dashboard.side-bar />

         <main id="main" class="main">


                  <div class='card'>
                      <div class='card-header'>
                        <h5 class='text-uppercase'>Meu perfil</h5>
                      </div>

                      <div class='card-body'>
                        <div  class="d-flex  align-items-center col-md-12  my-3 mb-3 gap-1">
                            <div class="col-md-6">
                                 <div class="form-group mb-2">
                                     <input wire:model='username' placeholder="Digite o seu nome" type="text" class='form-control px-3 py-3'>
                                 </div>

                                 <div class="form-group mb-2">
                                     <input wire:model='username' placeholder="Digite o seu nome" type="text" class='form-control px-3 py-3'>
                                 </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <input wire:model='email' placeholder="Digite o seu email" type="text" class='form-control px-3 py-3'>
                                </div>

                                <div class="form-group mb-2">
                                    <input wire:model='email' placeholder="Digite o seu email" type="text" class='form-control px-3 py-3'>
                                </div>

                            </div>
                        </div>

                        <div>
                            <button class="btn btn-dark">Atualizar</button>
                        </div>
                      </div>

                      </div>

                  </div>


         </main>

</div>
