@section('title', 'Utilizadores')
<div>

    
 <x-dashboard.top-bar />
  <x-dashboard.side-bar />

         <main id="main" class="main">   
         <x-dashboard.modal-user />  

                  <div class='card'>
                      <div class='card-header'>
                        <h5>Utilizadores</h5>                        
                      </div> 

                      <div class='card-body'>
                      <div class='d-flex align-items-center gap-1 mt-3 mb-3'>
                          <button data-bs-target='#user' data-bs-toggle='modal' class='btn btn-dark d-flex px-2 py-2'>
                            <i class='ri-add-line'></i>
                            <span>Adicionar</span>
                          </button>
                          <input wire:model.live='searcher' type='text' placeholder="Pesquisar utilizador" class='form-control px-2 py-2' />
                          <input wire:model.live='startdate' type='date'  class='form-control px-2 py-2' />
                          <input wire:model.live='enddate' type='date' class='form-control px-2 py-2' />
                      </div>

                        <div class='table-responsive'>
                          <table class='table table-hover'>
                            <thead>
                              <tr>
                                  <th>Foto</th>
                                  <th>Data de cadastro</th>
                                  <th>Nome de utilizador</th>
                                  <th>Email</th>
                                  <th>Tipo de utilizador</th>
                                  <th>Tipo de visitante</th>
                                  <th>Status</th>
                                  <th>Opções</th>
                              </tr>
                            </thead>       
                            <tbody>
                              @if (isset($data) and $data->isNotEmpty())
                                @foreach ($data as $key => $user)
                                  <tr>
                                      <td>
                                        @if (isset($user->userPersonalData->visitor_uuid) and $user->userPersonalData->gender == 'male' and !$user->userPersonalData->photo)
                                        <img style="width: 45px;" class='img-fluid rounded' src='{{ asset('storage/img/9bce03b6e54cdf0b7b5cf85c5d9d87bc.jpg') }}' />
                                        @elseif (isset($user->userPersonalData->visitor_uuid) and $user->userPersonalData->gender == 'female' and !$user->userPersonalData->photo)
                                        <img style="width: 45px;" class='img-fluid rounded' src='{{ asset('storage/img/592727514f8b799775df3834b591ee22.jpg') }}' />
                                        @else
                                        @endif
                                      </td>
                                      <td>{{ $user->created_at ?? '' }}</td>
                                      <td>{{ $user->user_name ?? '' }}</td>
                                      <td>{{ $user->email ?? '' }}</td>
                                      <td class='text-center'>{{ $user->userType->type ?? '' }}</td>
                                      <td class='text-center'>{{ $user->visitor->type ?? '' }}</td>
                                      <td>{{ $user->status === 'active' ? 'ativo' : 'inativo' }}</td>
                                      <td>
                                        <div class='d-flex align-items-center gap-1'>
                                            <button wire:key='{{ $key }}' data-bs-target='#user' data-bs-toggle='modal' class='d-flex gap-1 btn btn-sm btn-primary'>
                                            <i class='ri-edit-box-line'></i>
                                            <span>Editar</span>
                                            </button>

                                            <button wire:key='{{ $key }}' class='d-flex gap-1 btn btn-sm btn-danger'>
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
