@section('title', 'SGEI | Login')
<div>
   <main>				
                <div class="flex flex-col w-full  overflow-hidden relative min-h-screen radial-gradient items-center justify-center g-0 px-4">
                  
                    <div class="justify-center items-center w-full card lg:flex max-w-md ">
                        <div class=" w-full card-body">
                                <a href="../" class="py-4 block"><img src="{{ asset('dashboard/assets/dist/assets/images/logos/logo-light.svg') }}" alt="" class="mx-auto"/></a>
                                <p class="mb-4 text-gray-400 text-md text-center">Login</p>
                            <!-- form -->
                            <form>
                                <!-- username -->
                                <div class="mb-4">
                                    <label for="forUsername"
                                    class="block text-sm mb-2 text-gray-400">Username</label>
                                <input type="text" id="forUsername"
                                    class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 " aria-describedby="hs-input-helper-text">
                                </div>
                                <!-- password -->
                                <div class="mb-6">
                                    <label for="forPassword"
                                    class="block text-sm  mb-2 text-gray-400">Password</label>
                                <input type="password" id="forPassword"
                                    class="py-3 px-4 block w-full border-gray-200 rounded-sm text-sm focus:border-blue-600 focus:ring-0 " aria-describedby="hs-input-helper-text">
                                </div>   
                                 
                                    <!-- button -->
                                      <div class="grid my-6">
                                        <button class="btn py-[10px] text-base text-white font-medium hover:bg-blue-700 rounded-sm">
                                            Entrar
                                        </button>
                                        </div>

                                         <div class="flex justify-center">                                   
                                            <a href="../" class="text-sm font-semibold text-blue-600 hover:text-blue-700">Esqueçeu a sua senha?</a>
                                        </div>
        
                                    <div class="flex justify-center gap-2 items-center">
                                        <p class="text-base font-semibold text-gray-400">Ainda não tem uma conta?</p>
                                        <a href="./authentication-register.html" class="text-sm font-semibold text-blue-600 hover:text-blue-700">Criar conta</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
				
			</div>
		
	</main>
</div>
