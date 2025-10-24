
    <section id="intro" class="intro section">

   
      <div class="container-fluid">

        <h2 class='text-center'>Eventos</h2>

      <div class="container input-group flex-nowrap mb-3 my-3">
          <input wire:model.live='searcher' type="text" class="form-control px-2 py-2" placeholder="Pesquisar evento ..." aria-label="Username" aria-describedby="addon-wrapping">
          <span class="input-group-text" id="addon-wrapping">
            <i class="bi bi-search"></i>
          </span>
      </div>

        <div class='col-md-12 d-flex align-items-center justify-content-center flex-wrap gap-2'>
          @if (isset($this->events) && $this->events->count() > 0)
                @foreach($this->events as $key => $event)
                        <div class="col-md-3 card-selected ">            
                        
                                  <div data-uuid='{{ $event->uuid }}' class='card'>
                                    <div class="card-body">
                                      <img class='card-img-top img-fluid img-hover-effect' 
                                        style='border-radius: 9px; height:30vh;' 
                                        src='{{ asset('storage/imgs/' . $event->event_cover_photo) }}' 
                                      />
                                   <h4  class='text-color-default my-2'>{{ $event->event_name }}</h4>

                                   <div class='d-flex flex-column align-items-start my-4'>
                                      
                                           <div class='d-flex-align-items-center'>
                                              <i class="bi bi-calendar-event-fill"></i>
                                              <span>Data: {{ \Carbon\Carbon::parse($event->event_date)->format("d/m/Y") }}</span>              
                                            </div>

                                            <div class='d-flex-align-items-center'>
                                              <i class="bi bi-clock-fill"></i>
                                              <span>Hora: {{ $event->event_time}}</span>              
                                            </div>


                                             <div class='d-flex-align-items-center'>
                                                <i class="bi bi-geo-alt-fill"></i>
                                                <span>Local: {{ $event->location }}</span>
                                             </div>
                                       </div>

                                      <div class='container'>
                                        <h6>{{ $event->event_description }}</h6>
                                      </div>
                                      
                                    </div>
                                  </div>
                        </div>
                @endforeach
          @else
          <div class="text-center my-2">Nenhum evento encontrado ...</div>
          @endif
        </div>

      </div>

    </section>

    @push('intro')
    <script>      
      const cards = document.querySelectorAll('.card-selected');  
        if (cards.length > 0) {
            cards[0].querySelector('.card').classList.add('border-default'); // Apply effect to the first card
        }       
        cards.forEach(cardWrapper => {
            cardWrapper.addEventListener('click', function () {                
                cards.forEach(card => {
                    card.querySelector('.card').classList.remove('border-default'); // Remove class of all cards
                });
                this.querySelector('.card').classList.add('border-default'); // Add effect to clicked card
            });
        });
    </script>
@endpush
