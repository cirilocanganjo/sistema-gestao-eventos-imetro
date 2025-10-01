@section('title', 'Dashboard | Utilizadores')
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
                                    <h4 class="text-gray-700 uppercase text-lg font-semibold mb-4">Utilizadores</h4>                                   
                                    
                                    <div class="overflow-x-auto">
                                      <table class="w-full divide-y divide-gray-200 rounded-lg shadow-md">
                                        <thead style='background-color: black;' class="bg-black text-white">
                                          <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Nome</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Cargo</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Data de Admissão</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Ações</th>
                                          </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-100">                                          
                                          
                                          <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap">Carlos Lima</td>
                                            <td class="px-6 py-4 whitespace-nowrap">Gerente</td>
                                            <td class="px-6 py-4 whitespace-nowrap">03/01/2020</td>
                                            <td class="px-6 py-4 whitespace-nowrap">

                                              <button onclick="toggleModal()" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                 <i class='ti ti-edit'></i>
                                              Editar
                                            </button>

                                            <button class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-sm hover:bg-red-700  focus:outline-none focus:ring-2 focus:ring-blue-500">
                                                 <i class='ti ti-trash'></i>
                                              Eliminar
                                            </button>

                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>
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


<script>
  
  document.addEventListener("livewire:navigated", () => {
        
     });  
</script>




