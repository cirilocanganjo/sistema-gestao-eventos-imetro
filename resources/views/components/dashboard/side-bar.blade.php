  <aside wire:ignore id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
            <a wire:navigate class="nav-link {{ Route::current()->getname() == 'dashboard.home' ? 'bg-dark rounded text-light ' : '' }}" href="{{ route('dashboard.home') }}">
                  <i class="ri ri-home-3-line"></i>
                  <span>Dashboard</span>
            </a>
          </li>

          <li class="nav-item">
            <a wire:navigate class="nav-link {{ Route::current()->getname() == 'dashboard.users' ? 'bg-dark rounded text-light ' : '' }} " href="{{ route('dashboard.users') }}">
                  <i class="ri ri-user-6-line"></i>
                  <span>Utilizadores</span>
            </a>
          </li>

          <li class="nav-item">
            <a wire:navigate class="nav-link {{ Route::current()->getname() == 'dashboard.access.levels' ? 'bg-dark rounded text-light ' : '' }} " href="{{ route('dashboard.access.levels') }}">
                  <i class="ri-lock-unlock-line"></i>
                  <span>Níveis de acesso</span>
            </a>
          </li>

           <li class="nav-item">
              <a wire:navigate class="nav-link {{ Route::current()->getname() == 'dashboard.profile' ? 'bg-dark rounded text-light ' : '' }}" href="{{ route('dashboard.profile') }}">
                    <i class="ri ri-lock-line"></i>
                    <span>Meu perfil</span>
              </a>
          </li>


    </ul>

  </aside>