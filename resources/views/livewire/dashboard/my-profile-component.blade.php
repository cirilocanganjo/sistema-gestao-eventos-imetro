@section('title', 'Meu perfil')
<div>


 <x-dashboard.top-bar />
  <x-dashboard.side-bar />

         <main id="main" class="main">


                  <div class='card'>
                      <div class='card-header'>
                        <h6 class='text-uppercase'>Meu perfil</h6>
                      </div>

                      <form wire:submit.prevent='updateAuthenticatedProfileUserData()'>
                              <div class='card-body'>
                                <div  class="d-flex  align-items-start col-md-12  my-3 mb-1 gap-1">
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                             <input wire:model='username' placeholder="Digite o seu nome" type="text" class='form-control px-3 py-3'>
                                             @error ('username') <span class='text-danger'>{{ $message }}</span> @enderror
                                         </div>                                           


                                         <div class="form-group mb-2 position-relative">
                                             <input wire:model='password' placeholder="Digite a sua senha atual" type="password" class='form-control px-3 py-3'>
                                            <i style="top: 60%; right: 15px; transform: translateY(-50%); cursor: pointer; font-size: 20px;" class="ri ri-eye-line position-absolute toggle-password"></i>
                                         </div>
                                          @error ('password') <span class='text-danger'>{{ $message }}</span> @enderror

                                         <div class='form-group mb-2'>
                                             <label>Nível de acesso:</label>
                                            <select  wire:model='access_level' class="form-select px-3 py-3 " >
                                                <option value="">Selecionar</option>
                                                @if (isset($data_of_access_levels) and $data_of_access_levels->isNotEmpty())
                                                @foreach ($data_of_access_levels as $key => $level)
                                                <option wire:key='{{ $key }}' value='{{ $level->uuid }}'>{{ $level->type }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            @error('access_level')<span  class='text-danger'>{{ $message }}</span>@enderror
                                         </div>

                                        <div class='form-group mb-2'>
                                             <label>Tipo de perfil:</label>
                                            <select  wire:model='profile_type' class="form-select px-3 py-3 " >
                                                <option value="">Selecionar</option>
                                                @if (isset($data_of_user_types) and $data_of_user_types->isNotEmpty())
                                                @foreach ($data_of_user_types as $key => $user_type)
                                                <option wire:key='{{ $key }}' value='{{ $user_type->uuid }}'>{{ $user_type->type }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                            @error('profile_type')<span class='text-danger'>{{ $message }}</span>@enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <input wire:model='email' placeholder="Digite o seu email" type="email" class='form-control px-3 py-3' />
                                          @error ('email') <span class='text-danger'>{{ $message }}</span> @enderror
                                        </div>

                                        <div class="form-group mb-2">
                                            <input wire:model='new_password' placeholder="Digite a sua nova senha" type="password" class='form-control px-3 py-3'>
                                        </div>

                                         <div class="form-group mb-2">
                                            <input wire:model='confirm_new_password' placeholder="Confirmar a sua nova senha" type="password" class='form-control px-3 py-3'>
                                        </div>

                                        <div class="form-group ">
                                            <input :key='uniqid()' id='photo' wire:model='photo'  type="file" class='form-control px-3 py-3'>
                                        </div>

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


@push('user-prifile-scripts')
<script>
     const photo = document.getElementById('photo');
      document.addEventListener('livewire:initialized', () => {
                Livewire.on('clean-photo-input', () => {
                    photo.value = '';
                });
            });
</script>

@endpush