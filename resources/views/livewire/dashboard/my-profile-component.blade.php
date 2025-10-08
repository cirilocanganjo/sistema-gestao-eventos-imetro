@section('title', 'Meu perfil')
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
                        <h6 class='text-uppercase'>Meu perfil</h6>
                      </div>

                      <form wire:submit.prevent='updateAuthenticatedProfileUserData()'>
                              <div class='card-body'>
                                <div  class="d-flex  align-items-start col-md-12  my-3 mb-1 gap-1">
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                             <input wire:model='username' placeholder="Digite o seu nome" type="text" class='form-control px-2 py-2'>
                                             @error ('username') <span class='text-danger'>{{ $message }}</span> @enderror
                                         </div>                                           


                                         <div class="form-group mb-2 position-relative">
                                             <input id='password' wire:model='password' placeholder="Digite a sua senha atual" type="password" class='form-control px-2 py-2'>
                                            <i onclick='togglePasswordVisibility()' style="top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer; font-size: 20px;" class="ri ri-eye-line position-absolute toggle-password"></i>
                                         </div>
                                          @error ('password') <span class='text-danger'>{{ $message }}</span> @enderror

                                        @if (auth()->user()->userType->type === 'admin' || auth()->user()->userType->type === 'Admin')
                                                 <div class='form-group mb-2'>
                                                     <label>Nível de acesso:</label>
                                                    <select  wire:model='access_level' class="form-select px-2 py-2 " >
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
                                                    <select  wire:model='profile_type' class="form-select px-2 py-2 " >
                                                        <option value="">Selecionar</option>
                                                        @if (isset($data_of_user_types) and $data_of_user_types->isNotEmpty())
                                                        @foreach ($data_of_user_types as $key => $user_type)
                                                        <option wire:key='{{ $key }}' value='{{ $user_type->uuid }}'>{{ $user_type->type }}</option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    @error('profile_type')<span class='text-danger'>{{ $message }}</span>@enderror
                                                </div>

                                        @endif
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <input wire:model='email' placeholder="Digite o seu email" type="email" class='form-control px-2 py-2' />
                                          @error ('email') <span class='text-danger'>{{ $message }}</span> @enderror
                                        </div>

                                        <div class="form-group mb-2 position-relative">
                                            <input id='new_password' wire:model='new_password' placeholder="Digite a sua nova senha" type="password" class='form-control px-2 py-2' />
                                           <i  onClick='toggleNewPasswordVisibility()' style="top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer; font-size: 20px;" class="ri ri-eye-line position-absolute toggle-new-password"></i>
                                        </div>

                                         <div class="form-group mb-2 position-relative">
                                            <input id='confirm_new_password' wire:model='confirm_new_password' placeholder="Confirmar a sua nova senha" type="password" class='form-control px-2 py-2' />
                                           <i onClick='toggleConfirmNewPasswordVisibility()' style="top: 50%; right: 15px; transform: translateY(-50%); cursor: pointer; font-size: 20px;" class="ri ri-eye-line position-absolute toggle-confirm-new-password"></i>
                                        </div>


                                        <div class="form-group ">
                                            <input :key='uniqid()' id='photo' wire:model='photo'  type="file" class='form-control px-2 py-2'>
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

      const password_input = document.getElementById("password");
      const password_icon = document.querySelector(".toggle-password");   

      const new_password_input = document.getElementById("new_password");
      const new_password_icon = document.querySelector(".toggle-new-password");   

      const confirm_new_password_input = document.getElementById("confirm_new_password");
      const confirm_new_password_icon = document.querySelector(".toggle-confirm-new-password");  


      const photo = document.getElementById('photo');

      document.addEventListener('livewire:initialized', () => {
                Livewire.on('clean-photo-input', () => {
                    photo.value = '';
                });
            });

       function togglePasswordVisibility() {            
         if (password_input.type === "password") {
            password_input.type = "text";
            password_icon.classList.remove("ri-eye-line");
            password_icon.classList.add("ri-eye-off-line");
         } else {
            password_input.type = "password";
            password_icon.classList.remove("ri-eye-off-line");
            password_icon.classList.add("ri-eye-line");
           }
         }    


        function toggleNewPasswordVisibility() {            
         if (new_password_input.type === "password") {
            new_password_input.type = "text";
            new_password_icon.classList.remove("ri-eye-line");
            new_password_icon.classList.add("ri-eye-off-line");
         } else {
            new_password_input.type = "password";
            new_password_icon.classList.remove("ri-eye-off-line");
            new_password_icon.classList.add("ri-eye-line");
           }
         } 


        function toggleConfirmNewPasswordVisibility() {            
         if (confirm_new_password_input.type === "password") {
            confirm_new_password_input.type = "text";
            confirm_new_password_icon.classList.remove("ri-eye-line");
            confirm_new_password_icon.classList.add("ri-eye-off-line");
         } else {
            confirm_new_password_input.type = "password";
            confirm_new_password_icon.classList.remove("ri-eye-off-line");
            confirm_new_password_icon.classList.add("ri-eye-line");
           }
         }     

            document.addEventListener("DOMContentLoaded", togglePasswordVisibility, toggleNewPasswordVisibility , toggleConfirmNewPasswordVisibility); 
            document.addEventListener("livewire:navigated", () => {
                if (typeof togglePasswordVisibility === "function" && typeof toggleNewPasswordVisibility === "function" && typeof toggleConfirmNewPasswordVisibility === "function") {
                    togglePasswordVisibility();
                    toggleNewPasswordVisibility();
                    toggleConfirmNewPasswordVisibility();
                }
            });
</script>

@endpush