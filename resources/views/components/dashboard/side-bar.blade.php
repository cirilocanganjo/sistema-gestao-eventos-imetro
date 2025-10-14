  <aside wire:ignore id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

          <li class="nav-item">
            <a wire:navigate class="nav-link {{ Route::current()->getname() == 'dashboard.home' ? 'bg-dark rounded text-light ' : '' }}" href="{{ route('dashboard.home') }}">
                  <i class="ri ri-home-2-line"></i>
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
              <a wire:navigate class="nav-link {{ Route::current()->getname() == 'dashboard.categories' ? 'bg-dark rounded text-light ' : '' }}" href="{{ route('dashboard.categories') }}">
                    <i class="ri-edit-box-line"></i>
                    <span>Categorias</span>
              </a>
          </li>

           <li class="nav-item">
              <a wire:navigate class="nav-link {{ Route::current()->getname() == 'dashboard.events' ? 'bg-dark rounded text-light ' : '' }}" href="{{ route('dashboard.events') }}">
                    <i class="ri ri-calendar-2-line"></i>
                    <span>Eventos</span>
              </a>
          </li>


           <li class="nav-item">
              <a wire:navigate class="nav-link {{ Route::current()->getname() == 'dashboard.invitations' ? 'bg-dark rounded text-light ' : '' }}" href="{{ route('dashboard.invitations') }}">
                    <i class="ri ri-notification-2-line"></i>
                    <span>Convites</span>
              </a>
           </li>

           <li class="nav-item">
              <a wire:navigate class="nav-link {{ Route::current()->getname() == 'dashboard.teachers' ? 'bg-dark rounded text-light ' : '' }}" href="{{ route('dashboard.teachers') }}">
                    <i class="ri ri-contacts-line"></i>
                    <span>Docentes</span>
              </a>
           </li>

           <li class="nav-item">
              <a wire:navigate class="nav-link {{ Route::current()->getname() == 'dashboard.visitors' ? 'bg-dark rounded text-light ' : '' }}" href="{{ route('dashboard.visitors') }}">
                    <i class="ri ri-group-line"></i>
                    <span>Visitantes</span>
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
