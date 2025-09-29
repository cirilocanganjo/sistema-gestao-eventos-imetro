@section('title', 'Sistema de Gestão de Eventos Imetro | Recuperar senha')
<div>

   <main>               
                <div class="flex flex-col w-full  overflow-hidden relative min-h-screen radial-gradient items-center justify-center g-0 px-4">
                  
                    <div class="justify-center items-center w-full card lg:flex max-w-md ">
                        <div class=" w-full card-body">
                                <a href="{{ route('user.login') }}" class="py-4 block"><img src="{{ asset('dashboard/assets/dist/assets/images/logos/logo-light.svg') }}" alt="" class="mx-auto"/></a>
                            
                            <main>
                         
                                <div class="{{ !$isVerified ? 'hidden' : '' }} mb-4">
                                    <label for="verificationCode"
                                    class="block text-sm mb-2 text-gray-400">Codigo de recuperação:</label>
                                <input type="text" id="verificationCode"
                                    wire:model='verificationCode'
                                    class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 " aria-describedby="hs-input-helper-text">
                                     @error('verificationCode') <span  style='font-size:14px; color:red;'>{{ $message }}</span>@enderror 
                                </div>

                                <div class="{{ !$isVerified ? 'hidden' : '' }} mb-2" style="position:relative">
                                    <label for="newPassword"
                                    class="block text-sm  mb-2 text-gray-400">Nova Senha:</label>
                                     <input wire:model='newPassword' type="password"  id="newPassword" class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 " aria-describedby="hs-input-helper-text">
                                   <i class="bi bi-eye  toggle-password" onclick="togglePasswordVisibility()"  style="position:absolute; top: 70%; right: 15px; transform: translateY(-50%); cursor: pointer; font-size: 20px;"></i>
                                </div>   
                                @error('newPassword') <span style='font-size:14px; color:red;'>{{ $message }}</span>@enderror 


                                <div class="{{ !$isVerified ? 'hidden' : '' }} mb-2" style="position:relative">
                                    <label for="confirmNewPassword"
                                    class="block text-sm  mb-2 text-gray-400">Confirmar senha:</label>
                                     <input wire:model='confirmNewPassword' type="password"  id="confirmNewPassword" class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 " aria-describedby="hs-input-helper-text">
                                     <i class="bi bi-eye  toggle-confirm-password" onclick="toggleConfirmPasswordVisibility()"  style="position:absolute; top: 70%; right: 15px; transform: translateY(-50%); cursor: pointer; font-size: 20px;"></i>
                                </div>   
                                @error('confirmNewPassword') <span style='font-size:14px; color:red;'>{{ $message }}</span>@enderror 



                                 <div class="{{ $isVerified ? 'hidden' : '' }} mb-4">
                                    <label for="email"
                                    class="block text-sm mb-2 text-gray-400">Email:</label>
                                    <input type="text" id="email"
                                    wire:model='email'
                                    class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 " aria-describedby="hs-input-helper-text">
                                     @error('email') <span  style='font-size:14px; color:red;'>{{ $message }}</span>@enderror 
                                </div>
                               

                                <div class="{{ $isVerified ? 'hidden' : '' }} grid my-6">
                                     <button wire:click='recoverPassword' class="btn py-[10px] text-base text-white font-medium bg-gray-500  rounded-sm" >
                                        Recuperar
                                     </button>
                                </div>

                                 <div class="{{ !$isVerified ? 'hidden' : '' }} grid my-6">
                                    <button wire:click='updateCredentials' class="btn py-[10px] text-base text-white font-medium bg-teal-500  rounded-sm">
                                        Atualizar
                                    </button>
                                </div>                                
                                  

                                @guest
                                    <div class="flex justify-center"> 
                                        <a href='{{ route('user.login') }}'>Ir para login</a> 
                                    </div>   

                                     <div class="flex justify-center">    
                                        <span class="text-sm">Ainda não tem uma conta?</span>                              
                                        <a href="{{ route('user.store.account') }}" class="text-sm  text-blue-600 hover:text-blue-700"> clique aqui para criar</a>
                                    </div> 
                                @endguest        
                                   
                                </div>
                            </main>
                        </div>
                    </div>
                
            </div>
        
    </main>
</div>


@push("auth")
    <script>
        function togglePasswordVisibility() {
            const input = document.getElementById("newPassword");
            const icon = document.querySelector(".toggle-password");

                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.remove("bi-eye");
                    icon.classList.add("bi-eye-slash");
                } else {
                    input.type = "password";
                    icon.classList.remove("bi-eye-slash");
                    icon.classList.add("bi-eye");
                }
            }


            function toggleConfirmPasswordVisibility() {
            const input = document.getElementById("confirmNewPassword");
            const icon = document.querySelector(".toggle-confirm-password");

                if (input.type === "password") {
                    input.type = "text";
                    icon.classList.remove("bi-eye");
                    icon.classList.add("bi-eye-slash");
                } else {
                    input.type = "password";
                    icon.classList.remove("bi-eye-slash");
                    icon.classList.add("bi-eye");
                }
            }
    </script>    
@endpush
