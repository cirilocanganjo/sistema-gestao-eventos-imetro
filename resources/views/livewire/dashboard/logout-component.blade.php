 <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">            
        @auth
        <li class="nav-item dropdown pe-3">
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            @if (auth()->user()->userPersonalData->visitor_uuid and auth()->user()->userPersonalData->gender == 'male' and !auth()->user()->userPersonalData->photo)
            <img style="width: 45px;" class='img-fluid rounded-circle' src='{{ asset('storage/img/9bce03b6e54cdf0b7b5cf85c5d9d87bc.jpg') }}' />
            @elseif (auth()->user()->userPersonalData->visitor_uuid and auth()->user()->userPersonalData->gender == 'female' and !auth()->user()->userPersonalData->photo)
            <img  class='img-fluid rounded' src='{{ asset('storage/img/592727514f8b799775df3834b591ee22.jpg') }}' />
            @else
            <img  class='img-fluid rounded-circle' src='{{ asset('storage/img/' .auth()->user()->userPersonalData->photo) }}' />
            @endif
            <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->user_name ?? '' }}</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>{{ auth()->user()->user_name ?? '' }}</h6>
              {{-- <span>Web Designer</span> --}}
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a wire:navigate class="dropdown-item d-flex align-items-center" href="{{ route('dashboard.profile') }}">
                <i class="bi bi-person"></i>
                <span>Meu Perfil</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>     

            <li>
              <a wire:click='logout' class="dropdown-item d-flex align-items-center">
                <i class="bi bi-box-arrow-right"></i>
                <span>Terminar sessão</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li>
        @endauth
      </ul>
    </nav>

