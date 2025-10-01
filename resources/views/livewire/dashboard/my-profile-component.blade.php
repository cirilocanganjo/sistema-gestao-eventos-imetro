@section('title', 'Dashboard | Perfil')
<div>
    <main>
        <div id="main-wrapper" class="flex p-5 xl:pr-0">
            
            <x-dashboard.side-bar />
            
            <div class="w-full page-wrapper xl:px-6 px-0">
                <main class="h-full w-full">


                    
                    <div class="w-full max-w-none flex flex-col gap-6">
                        
                        <x-dashboard.top-bar />                 

                        <!-- Grid principal -->
                        <div  class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                            <!-- Card ocupando 100% (3 colunas) -->
                            <div id='content' class="card">
                                <div class="card-body">
                                    <h4 class="text-gray-700 text-lg uppercase  mb-4">Meu Perfil</h4>                                   
                                    
                                    <div class='main'>
                                        <div id='first_column' class=''>                                        
                                            <div>
                                                    <label for="nome" class="text-sm text-gray-600 mb-1">Nome</label>
                                                    <input 
                                                      type="text" 
                                                      id="nome" 
                                                      class="w-full py-3 px-4 border-gray-200 py-3 px-4 rounded-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                      placeholder="Digite seu nome"
                                                    />                                                
                                            </div>
                                        </div>                                      

                                        
                                        <div id='second_column'>

                                            <div>
                                                <label for="email" class="text-sm text-gray-600 mb-1">Email</label>
                                                <input 
                                                  type="text" 
                                                  id="email" 
                                                  class="w-full py-3 px-4 border-gray-200 py-3 px-4 rounded-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                  placeholder="Digite seu email"
                                                />                                                
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>      

                    </div>
                </main>             
            </div>

        </div>  
    </main>
</div>
