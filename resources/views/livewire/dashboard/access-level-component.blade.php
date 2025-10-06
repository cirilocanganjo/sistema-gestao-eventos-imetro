@section('title', 'Níveis de acesso')
<div>

 <x-dashboard.top-bar />
  <x-dashboard.side-bar />

         <main id="main" class="main">
                <x-dashboard.modal-access-level :status='$status' />

                  <div class='card'>
                      <div class='card-header'>
                        <h5>Utilizadores</h5>
                      </div>

                      <div class='card-body'>
                      <div class='d-flex align-items-center gap-1 mt-3 mb-3'>
                          <button id='button-add' data-bs-target='#access-level-user' data-bs-toggle='modal' class='btn btn-dark d-flex px-2 py-2'>
                            <i class='ri-add-line'></i>
                            <span>Adicionar</span>
                          </button>
                          <input wire:model.live='searcher' type='text' placeholder="Pesquisar utilizador" class='form-control px-2 py-2' />

                      </div>

                        <div class='table-responsive'>
                          <table class='table table-hover'>
                            <thead>
                              <tr>

                                  <th>Data de cadastro</th>
                                  <th>Nível de acesso</th>
                                  <th>Opções</th>
                              </tr>
                            </thead>
                            <tbody>
                              @if (isset($data) and $data->isNotEmpty())
                                @foreach ($data as $key => $access_level)
                                  <tr>
                                      <td>{{ $access_level->created_at ?? '' }}</td>
                                      <td>{{ $access_level->type ?? '' }}</td>
                                      <td>
                                        <div class='d-flex align-items-center gap-1'>
                                            <button wire:click="edit('{{ $access_level->uuid }}')" wire:key='{{ $key }}' data-bs-target='#access-level-user' data-bs-toggle='modal'   class='d-flex gap-1 btn btn-sm btn-primary'>
                                            <i class='ri-edit-box-line'></i>
                                            <span>Editar</span>
                                            </button>

                                            <button wire:click="delete('{{  $access_level->uuid }}')" wire:key='{{ $key }}' class='d-flex gap-1 btn btn-sm btn-danger'>
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



