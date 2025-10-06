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
                        <div  class="d-flex  align-items-start col-md-12  my-3 mb-1 gap-1">
                            <div class="col-md-6">
                                 <div class="form-group mb-2">
                                     <input wire:model='password' placeholder="Digite a sua senha atual" type="password" class='form-control px-3 py-3'>
                                 </div>

                                 <div class="form-group mb-2">
                                     <input wire:model='username' placeholder="Digite o seu nome" type="text" class='form-control px-3 py-3'>
                                 </div>

                                 <div class='form-group mb-2' wire:ignore>
                                     <label>Nível de acesso:</label>
                                    <select id='access_level' wire:model='access_level' class="form-select px-3 py-3 " >
                                        <option value="">Selecionar</option>
                                        @if (isset($access_levels) and $access_levels->isNotEmpty())
                                        @foreach ($access_levels as $key => $level)
                                        <option wire:key='{{ $key }}' value='{{ $level->uuid }}'>{{ $level->type }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <span id='visitor_type_span' class='text-danger'></span>
                                 </div>

                                <div class='form-group mb-2' wire:ignore>
                                     <label>Tipo de perfil:</label>
                                    <select id='access_level' wire:model='access_level' class="form-select px-3 py-3 " >
                                        <option value="">Selecionar</option>
                                        @if (isset($access_levels) and $access_levels->isNotEmpty())
                                        @foreach ($access_levels as $key => $level)
                                        <option wire:key='{{ $key }}' value='{{ $level->uuid }}'>{{ $level->type }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <span id='visitor_type_span' class='text-danger'></span>
                                </div>



                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <input wire:model='email' placeholder="Digite o seu email" type="text" class='form-control px-3 py-3'>
                                </div>

                                <div class="form-group mb-2">
                                    <input wire:model='new_password' placeholder="Digite a sua nova senha" type="password" class='form-control px-3 py-3'>
                                </div>

                                 <div class="form-group mb-2">
                                    <input wire:model='new_password' placeholder="Confirmar a sua nova senha" type="password" class='form-control px-3 py-3'>
                                </div>

                                <div class="form-group ">
                                    <input wire:model='photo'  type="file" class='form-control px-3 py-3'>
                                </div>

                            </div>
                        </div>

                        <div>
                            <button class="text-uppercase btn btn-dark">
                                Atualizar
                            </button>
                        </div>
                      </div>

                      </div>

                  </div>


         </main>

</div>
