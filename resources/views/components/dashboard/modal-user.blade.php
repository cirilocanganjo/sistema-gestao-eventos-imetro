@props(['visitor_types' => [], 'access_levels' => [] ])
<div wire:ignore.self class="modal" id="modal">
      <div class="modal-content bg-white">
        <div class="modal-header">
          <h1 class="modal-title fs-5 text-uppercase">Adicionar utilizador</h1>
          <button wire:click='close' class="modal-close" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body">
         
            <div class="gap-1">

                      <div  class='form-group'>
                        <label class='form-label'>Nome</label>
                        <input id='name' wire:model='firstname' type='text' class='form-control rounded' />
                        @error("firstname") <span class='text-danger'>{{ $message }}</span> @enderror
                      </div>                   

                      <div class='form-group'>
                        <label class='form-label'>Email</label>
                        <input  id='email' wire:model='email'  type='text' class='form-control rounded' />
                        @error("email") <span class='text-danger'>{{ $message }}</span> @enderror
                      </div>      

                      <div  class='form-group'>
                        <label class='form-label'>Telefone</label>
                        <input  wire:model='telephone' type='text' class='form-control rounded' />
                        @error("telephone") <span class='text-danger'>{{ $message }}</span> @enderror                                                                  
                      </div>

                      <div class='form-group mb-3'>
                       <label>Tipo de utilizador:</label>
                        <select id='visitor_type' wire:model='visitor_type' class="form-select visitor_types" >
                             <option value="">Selecionar</option> 
                             @if (isset($visitor_types) ) 
                             @foreach ($visitor_types as $key => $type)
                             <option selected wire:key='user-type-{{ $key }}' value='{{ $type->uuid }}'>{{ $type->type }}</option>
                             @endforeach
                             @endif                                                
                        </select>
                        <span id='visitor_type_span' class='text-danger'></span>                
                     </div>

                      <div class='form-group mb-3' wire:ignore>
                       <label>Nível de acesso:</label>
                        <select id='access_level' wire:model='access_level' class="form-select" >
                            <option value="">Selecionar</option>
                             @if (isset($access_levels)) 
                             @foreach ($access_levels as $key => $level)
                             <option wire:key='{{ $key }}' value='{{ $level->uuid }}'>{{ $level->type }}</option>
                             @endforeach
                             @endif                                                
                        </select>
                        <span id='visitor_type_span' class='text-danger'></span>                
                     </div>
                 
                    <div class='form-group'>
                        <label class='form-label'>Senha</label>
                        <input wire:model="password" type='password' class='form-control rounded' />
                    </div>
               
            </div>
        </div>
        <div class="d-flex gap-1 p-2 align-items-center justify-content-end">
          <button  class="d-flex btn btn-primary">
            Salvar
        </button>
        <button wire:click='close' onclick="closeModal()" type="button" class="d-flex btn btn-danger">
          Fechar
        </button>
        </div>
        
    </div>
  </div>


