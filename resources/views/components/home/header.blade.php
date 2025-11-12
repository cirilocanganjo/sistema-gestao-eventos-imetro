  
   <header wire:ignore style="background: #100c06;" id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="{{route('evently.app.home') }}" class="logo d-flex align-items-center">  
        <h1 style="font-size: 22px;" class="sitename">{{$this->get_app_name ?? "Sistema de Gestão de Eventos"}} </h1>
      </a>
      <x-home.nav-bar />
    </div>
  </header>