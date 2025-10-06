<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>@yield('title')</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('dashboard/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('dashboard/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('dashboard/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('dashboard/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
  <link href="{{ asset('dashboard/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">
  <link href="{{ asset('dashboard/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
  <link href="{{ asset('dashboard/assets/css/style.css') }}" rel="stylesheet">
</head>

<body>
<link rel="stylesheet" href="{{ asset('dashboard/assets/select2/css/select2-bootstrap-4.min.css') }}" />
<link rel="stylesheet" href="{{ asset('dashboard/assets/select2/css/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('dashboard/assets/select2/css/select2.min.css') }}" />
@vite(['resources/css/app.css', 'resources/js/app.js'])

<title>@yield('title')</title>
@livewireStyles()
</head>

<body style='background-color: white;'>

 {{ $slot }}

  <footer id="footer" class="footer">
    <div class="copyright">
    	<p class="text-base text-gray-400 font-normal p-3 text-center">
			copyright &copy; {{ now()->year ?? ''}} - Evently. Todos os direitos reservados.
		</p>
    </div>
    
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->

<script src="{{ asset('dashboard/assets/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/jquery-mask.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/sweet-alert.js') }}"></script>
<script src="{{ asset('dashboard/assets/select2/js/select2.js') }}"></script>
<script src="{{ asset('dashboard/assets/select2/js/select2-portuguese.js') }}"></script>

<script src="{{ asset('dashboard/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/chart.js/chart.umd.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/echarts/echarts.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/quill/quill.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/simple-datatables/simple-datatables.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/main.js') }}"></script>


@livewireScripts()
@stack('auth')
@stack('scripts')
@stack('user-component-scripts')
@stack('access-level-user-scripts')
@stack('side-bar-scripts')

<script>
	  
</script>

</body>
</html>
