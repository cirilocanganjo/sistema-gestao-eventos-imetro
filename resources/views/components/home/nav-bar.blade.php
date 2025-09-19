

<nav id="navmenu" class="navmenu">
        <ul class='text-uppercase'>
          <li><a id='nav-item-home' href="{{route('home') }}" class="{{ request()->route()->getname() == 'home' ? 'active' : '' }}">Home</a></li>
          <li><a href="about.html">Sobre</a></li>
          <li><a href="/#footer">Contactos</a></li>
          <li>
           @if (auth()->guest()) 
            <a  class="{{ request()->route()->getname() == 'user.login' ? 'active' : '' }}" href="{{ route('user.login') }}">Login</a>
           @else 
           <a>{{ auth()->user()->user_name }}</a>
           @endif
          </li>          
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

