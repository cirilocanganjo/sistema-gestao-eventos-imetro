@section("title" , "Sistema de Gestão de Eventos")
<div>
      <x-home.header />
      <main class="main">           
         <livewire:home.hero-component />            
         <x-home.intro :events="$this->events ?? []" /> 
      </main>
      <x-home.footer />
      <x-home.back-to-top-and-preloader />
</div>




