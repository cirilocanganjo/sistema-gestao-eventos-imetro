@section('title', 'Login')
<div>

   <main>               
                <div class="flex flex-col w-full  overflow-hidden relative min-h-screen radial-gradient items-center justify-center g-0 px-4">
                  
                    <div class="justify-center items-center w-full card lg:flex max-w-md ">
                        <div class=" w-full card-body">
                                <a wire:navigate href="{{ route('user.login') }}" class="py-4 block"><img src="{{ asset('dashboard/assets/dist/assets/images/logos/logo-light.svg') }}" alt="" class="mx-auto"/></a>
                            <!-- form -->
                            <form  wire:submit='login'>
                                <!-- username -->
                                <div class="mb-4">
                                    <label for="forUsername"
                                    class="block text-sm mb-2 text-gray-400">Email:</label>
                                <input type="text" id="forUsername"
                                    wire:model='email'
                                    class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 " aria-describedby="hs-input-helper-text" />
                                     @error('email') <span  style='font-size:14px; color:red;'>{{ $message }}</span>@enderror 

                                </div>
                                <!-- password -->
                                <div class="mb-2" style="position:relative">
                                    <label for="password"
                                    class="block text-sm  mb-2 text-gray-400">Senha:</label>
                                     <input type="password" wire:model='password'  id="password" class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 " aria-describedby="hs-input-helper-text" />
                                   <i class="bi bi-eye  toggle-password" onclick="togglePasswordVisibility()"  style="position:absolute; top: 70%; right: 15px; transform: translateY(-50%); cursor: pointer; font-size: 20px;"></i>
                                </div>   
                                @error('password') <span style='font-size:14px; color:red;'>{{ $message }}</span>@enderror       


                                 
                                    <!-- button -->
                                      <div class="grid my-6">
                                        <button class="btn py-[10px] text-base text-white font-medium hover:bg-blue-700 rounded-sm">
                                            Entrar
                                        </button>
                                        </div>

                                        @guest
                                         <div class="flex justify-center"> 
                                             <a wire:navigate href='{{ route('user.recover.password') }}'>Recuperar senha</a> 
                                         </div>   
                                         <div class="flex justify-center">    

                                            <span class="text-sm">Ainda não tem uma conta?</span>                              
                                            <a  href="{{ route('user.store.account') }}" class="text-sm  text-blue-600 hover:text-blue-700"> clique aqui para criar</a>
                                        </div> 
                                        @endguest
        
                                   
                                </div>
                            </form>
                        </div>
                    </div>
                
            </div>
        
    </main>
</div>


@push("auth")
    <script>
        const input = document.getElementById("password");
        const icon = document.querySelector(".toggle-password");
       
        function togglePasswordVisibility() {

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

          //document.addEventListener("DOMContentLoaded", togglePasswordVisibility); 
          document.addEventListener("livewire:navigated", () => {
                if (typeof togglePasswordVisibility === "function") {
                    togglePasswordVisibility();
                }
            });

    </script>    
@endpush
