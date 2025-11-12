<footer style="{{ $this->events->isEmpty() ? 'margin-top: 18rem;' : '' }}"  id="footer" class="footer position-relative dark-background">
  <div class="container footer-top">
    <div class="row gy-4">
      <div class="col-lg-4 col-md-6 footer-about">
        <a href="/" class="logo d-flex align-items-center">
          <span style="font-size: 18px;" class="sitename">{{$this->get_app_name ?? "Sistema de Gestão de Eventos"}}</span>
        </a>
        <div class="footer-contact pt-3">        
          <p class="mt-3"><strong>Telefone:</strong> <span>+244 923 456 213</span></p>
          <p><strong>Email:</strong> <span>info@gmail.com</span></p>
        </div>
        <div class="social-links d-flex mt-4">
          <a href=""><i class="bi bi-twitter-x"></i></a>
          <a href=""><i class="bi bi-facebook"></i></a>
          <a href=""><i class="bi bi-instagram"></i></a>
          <a href=""><i class="bi bi-linkedin"></i></a>
        </div>
      </div>

      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Links Úteis</h4>
        <ul>
          <li><a href="#">Início</a></li>
          <li><a href="#">Sobre Nós</a></li>
          <li><a href="#">Serviços</a></li>
          <li><a href="#">Termos de Serviço</a></li>
          <li><a href="#">Política de Privacidade</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Nossos Serviços</h4>
        <ul>
          <li><a href="#">Design de Sites</a></li>
          <li><a href="#">Desenvolvimento Web</a></li>
          <li><a href="#">Gestão de Produtos</a></li>
          <li><a href="#">Marketing</a></li>
          <li><a href="#">Design Gráfico</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Hic solutasetp</h4>
        <ul>
          <li><a href="#">Molestiae accusamus iure</a></li>
          <li><a href="#">Excepturi dignissimos</a></li>
          <li><a href="#">Suscipit distinctio</a></li>
          <li><a href="#">Dilecta</a></li>
          <li><a href="#">Sit quas consectetur</a></li>
        </ul>
      </div>

      <div class="col-lg-2 col-md-3 footer-links">
        <h4>Nobis illum</h4>
        <ul>
          <li><a href="#">Ipsam</a></li>
          <li><a href="#">Laudantium dolorum</a></li>
          <li><a href="#">Dinera</a></li>
          <li><a href="#">Trodelas</a></li>
          <li><a href="#">Flexo</a></li>
        </ul>
      </div>

    </div>
  </div>

  <div  class="container copyright text-center mt-4">
    <p>© {{ now()->year ?? "" }} <span>Todos os direitos reservados</span> </p>
   
  </div>

</footer>
