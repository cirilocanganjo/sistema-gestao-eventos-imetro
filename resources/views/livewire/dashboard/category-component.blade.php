@section('title', 'Categorias')
<div>

 <x-dashboard.top-bar />
  <x-dashboard.side-bar />

         <main id="main" class="main">
            <x-dashboard.modal-event-category :status="$status ?? false " />
                  <div class='card'>
                      <div class='card-header'>
                        <h5>categoryos</h5>
                      </div>

                      <div class='card-body'>
                      <div class='d-flex align-items-center gap-1 mt-3 mb-3'>
                          <button id='button-add' data-bs-target='#form-event-category' data-bs-toggle='modal' class='btn btn-dark d-flex px-2 py-2'>
                            <i class='ri-add-line'></i>
                            <span>Adicionar</span>
                          </button>
                          <input wire:model.live='searcher' type='text' placeholder="Pesquisar categoria" class='form-control px-2 py-2' />
                          <input wire:model.live='startdate' type='date'  class='form-control px-2 py-2' />
                          <input wire:model.live='enddate' type='date' class='form-control px-2 py-2' />
                      </div>

                        <div class='table-responsive'>
                          <table class='table table-hover'>
                            <thead class=''>
                              <tr>
                                  <th>Data</th>
                                  <th>Categoria</th>
                                  <th>Cadastrada por</th>
                                  <th>Opções</th>
                              </tr>
                            </thead>
                            <tbody class="">
                              @if (isset($data) and $data->count() > 0)
                                @foreach ($data as $key => $category)
                                  <tr>
                                       <td>{{ $category->created_at }}</td>
                                       <td>{{ $category->category }}</td>
                                       <td>{{ $category->user->user_name }}</td>
                                      <td>
                                        <div class='d-flex align-items-center gap-1'>
                                            <button wire:key='{{ $key }}'  wire:click="edit('{{ $category->uuid }}')" data-bs-target='#form-event-category' data-bs-toggle='modal' class='d-flex gap-1 btn btn-sm btn-primary'>
                                            <i class='ri-edit-box-line'></i>
                                            <span>Editar</span>
                                            </button>

                                            <button wire:key='{{ $key }}'  wire:click="delete('{{ $category->uuid }}')" class='d-flex gap-1 btn btn-sm btn-danger'>
                                              <i class='ri-delete-bin-4-line'></i>
                                              <span>Eliminar</span>
                                            </button>

                                        </div>
                                      </td>
                                  </tr>
                                  @endforeach
                              @else
                                <tr>
                                  <td class="text-center" colspan="12">
                                  <div class='alert alert-warning text-center'>Nenhum resultado encontrado!</div>
                                </td>
                                </tr>
                              @endif
                            </tbody>
                          </table>
                        </div>
                      </div>

                  </div>

         </main>

</div>


