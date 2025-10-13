@section('title', 'Eventos')
<div>

 <x-dashboard.top-bar />
  <x-dashboard.side-bar />

         <main id="main" class="main">
         <x-dashboard.modal-user :visitor_types="$visitor_types ?? []" :access_levels="$access_levels ?? []" />

                  <div class='card'>
                      <div class='card-header'>
                        <h5>Eventos</h5>
                      </div>

                      <div class='card-body'>
                      <div class='d-flex align-items-center gap-1 mt-3 mb-3'>
                          <button id='button-add' data-bs-target='#user' data-bs-toggle='modal' class='btn btn-dark d-flex px-2 py-2'>
                            <i class='ri-add-line'></i>
                            <span>Adicionar</span>
                          </button>
                          <input wire:model.live='searcher' type='text' placeholder="Pesquisar utilizador" class='form-control px-2 py-2' />
                          <input wire:model.live='startdate' type='date'  class='form-control px-2 py-2' />
                          <input wire:model.live='enddate' type='date' class='form-control px-2 py-2' />
                      </div>

                        <div class='table-responsive'>
                          <table class='table table-hover'>
                            <thead class='text-center'>
                              <tr>
                                  <th>Foto</th>
                                  <th>Data</th>
                                  <th>Nome</th>
                                  <th>Email</th>
                                  <th>Acesso</th>
                                  <th>Tipo visitante</th>
                                  <th>Status</th>
                                  <th>Opções</th>
                              </tr>
                            </thead>
                            <tbody class="text-center">
                              @if (isset($data) and $data->count() > 0)
                                @foreach ($data as $key => $user)
                                  <tr>
                                      <td>
                                    
                                       @if (!isset($user->userPersonalData->photo))
                                             @if($user->userPersonalData->gender === 'male')
                                              <img style="width: 45px;" class='img-fluid rounded' src="{{ asset('dashboard/assets/img/9bce03b6e54cdf0b7b5cf85c5d9d87bc.png') }}" />
                                              @elseif ($user->userPersonalData->gender === 'female')
                                              <img style="width: 45px;" class='img-fluid rounded' src="{{ asset('dashboard/assets/img/592727514f8b799775df3834b591ee22.png') }}" />
                                              @endif

                                        @else
                                        <img style="width: 45px;" class='img-fluid rounded' src="{{ asset('storage/imgs/' . $user->userPersonalData->photo) }}" />
                                        @endif 

                                       
                                      </td>
                                      <td>{{ $user->created_at ?? '' }}</td>
                                      <td>{{ $user->user_name ?? '' }}</td>
                                      <td>{{ $user->email ?? '' }}</td>
                                      <td class='text-center'>{{ $user->userType->type ?? '' }}</td>
                                      <td  style="text-align: justify; width: 350px;word-break: break-word; overflow-wrap: break-word; white-space: normal;" class='text-center'>{{ $user->visitorForVisitorType->visitorType->type ?? '' }}</td>
                                      <td>{{ $user->status === 'active' ? 'ativo' : 'inativo' }}</td>
                                      <td>
                                        <div class='d-flex align-items-center gap-1'>
                                            <button wire:click='edit({{ $user->id }})' wire:key='{{ $key }}' data-bs-target='#user' data-bs-toggle='modal' class='d-flex gap-1 btn btn-sm btn-primary'>
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


@push('user-component-scripts')
<script>
document.addEventListener('livewire:initialized', () => {
    const fullName = document.getElementById('name');
    const email = document.getElementById('email'); // supondo que exista este campo
    const buttonAdd = document.getElementById('button-add');

    if (buttonAdd) {
        buttonAdd.addEventListener('click', () => {  //Clean inputs when button add is clicked
            fullName.value = '';
            email.value = '';
        });
    }

    Livewire.on('edit-user', ({ user }) => {  //Receive Livewire data and fill the form
        fullName ? fullName.value = user.user_name : '';
        email ? email.value = user.email : '';
    });
});
</script>
@endpush
