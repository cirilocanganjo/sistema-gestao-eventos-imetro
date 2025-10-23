
<div  style="{{ !$highlighted_event ? "margin-bottom: 5rem;" : ''}}" >
     <section style="background-image: url({{ asset('storage/imgs/' . ($highlighted_event->event_cover_photo ?? null)) }}" id="hero" class="{{ $highlighted_event ? 'd-block' : 'd-none' }} hero section dark-background">

      <div class="background-overlay"></div>

      <div class="hero-content">
          <div class="container">

            <div class="row justify-content-center text-center">

              <div class="col-lg-10">

                <div class="hero-text">

                  <h1 class="hero-title">{{ $highlighted_event->event_name ?? ''}}</h1>

                  <p class="hero-subtitle">{{ $highlighted_event->event_description ?? ''}}</p>

                  <div class="event-details">
                    <div class="detail-item">
                      <i class="bi bi-calendar-event"></i>
                      <span>{{ \Carbon\Carbon::parse($highlighted_event->event_date)->format('d/m/Y') ?? ''}}</span>
                    </div>
                    <div class="detail-item">
                      <i class="bi bi-geo-alt"></i>
                      <span>{{ $highlighted_event->location ?? ''}}</span>
                    </div>
                  </div>

                </div>

                <div class="countdown-section">

                  <h2 style='font-size: 25px;' class="fw-bold text-color-default countdown-label">Dias restantes</h2>

                  <div class="countdown d-flex justify-content-center" data-count="{{ $highlighted_event->event_date ?? '' }}">
                    <div>
                      <h3 class="count-days">1</h3>
                      <h4>Dias</h4>
                    </div>
                    <div>
                      <h3 class="count-hours">8</h3>
                      <h4>Horas</h4>
                    </div>
                    <div>
                      <h3 class="count-minutes">53</h3>
                      <h4>Minutoss</h4>
                    </div>
                    <div>
                      <h3 class="count-seconds">23</h3>
                      <h4>Segundos</h4>
                    </div>
                  </div>

                </div>

                

              </div>

            </div>

           
          </div>
      </div>

    </section>
</div>
