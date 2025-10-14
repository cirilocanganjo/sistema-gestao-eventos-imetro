@section('title', 'Eventos')
<div>

 <x-dashboard.top-bar />
  <x-dashboard.side-bar />

         <main id="main" class="main">
            <x-dashboard.modal-event :categories="$categories ?? [] " />
                  <div class='card'>
                      <div class='card-header'>
                        <h5>Eventos</h5>
                      </div>

                      <div class='card-body'>
                      <div class='d-flex align-items-center gap-1 mt-3 mb-3'>
                          <button id='button-add' data-bs-target='#form-event' data-bs-toggle='modal' class='btn btn-dark d-flex px-2 py-2'>
                            <i class='ri-add-line'></i>
                            <span>Adicionar</span>
                          </button>
                          <input wire:model.live='searcher' type='text' placeholder="Pesquisar evento" class='form-control px-2 py-2' />
                          <input wire:model.live='startdate' type='date'  class='form-control px-2 py-2' />
                          <input wire:model.live='enddate' type='date' class='form-control px-2 py-2' />
                      </div>

                        <div class='table-responsive'>
                          <table class='table table-hover'>
                            <thead class='text-center'>
                              <tr>
                                  <th>Foto</th>
                                  <th>Data</th>
                                  <th>Nome do evento</th>
                                  <th>Descrição</th>
                                  <th>Em destaque</th>
                                  <th>Categoria</th>
                                  <th>Utilizador</th>
                                  <th>Opções</th>
                              </tr>
                            </thead>
                            <tbody class="text-center">
                              @if (isset($data) and $data->count() > 0)
                                @foreach ($data as $key => $event)
                                  <tr>
                                      <td>
                                        <img style="width: 60px;" class='img-fluid rounded' src="{{ asset('storage/imgs/' . $event->event_cover_photo) }}" />
                                      </td>
                                      <td class='text-center' style="text-align: justify; width: 350px; word-break: break-word; overflow-wrap: break-word; white-space: normal;">{{ $event->created_at }}</td>
                                      <td class='text-center' style="text-align: justify; width: 350px; word-break: break-word; overflow-wrap: break-word; white-space: normal;">{{ $event->event_name }}</td>
                                      <td style="text-align: justify; width: 350px; word-break: break-word; overflow-wrap: break-word; white-space: normal;">{{ $event->event_description }}</td>
                                       <td>{{ $event->event_highlighted }}</td>
                                       <td>{{ $event->eventCategory->category }}</td>
                                       <td>{{ $event->user->user_name }}</td>
                                      <td>
                                        <div class='d-flex align-items-center gap-1'>
                                            <button wire:click='edit({{ $event->uuid }})' wire:key='{{ $key }}' data-bs-target='#user' data-bs-toggle='modal' class='d-flex gap-1 btn btn-sm btn-primary'>
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



