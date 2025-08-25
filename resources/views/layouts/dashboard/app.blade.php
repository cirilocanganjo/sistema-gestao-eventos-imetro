 
<!DOCTYPE html>
<html   lang="en" >

<head>
	<!-- Required meta tags -->
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- Favicon icon-->
<link rel="shortcut icon" type="image/png" href="./assets/images/logos/favicon.png" />
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
  rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@2.44.0/tabler-icons.min.css">
<!-- Core Css -->
<link rel="stylesheet" href="{{ asset('/dashboard/assets/dist/assets/css/theme.css') }}" />
<title>@yield('title')</title>
{{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
@livewireStyles()
</head>

<body class=" bg-surface">
 {{ $slot }}
@livewireScripts()

 <script src="{{ asset('dashboard/assets/dist/assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/dist/assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/dist/assets/libs/iconify-icon/dist/iconify-icon.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/dist/assets/libs/@preline/dropdown/index.js') }}"></script>
<script src="{{ asset('dashboard/assets/dist/assets/libs/@preline/overlay/index.js') }}"></script>
<script src="{{ asset('dashboard/assets/dist/assets/js/sidebarmenu.js') }}"></script>

<!-- solar icons -->
<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
<script src="{{ asset('dashboard/assets/dist/assets/libs/preline/dist/preline.js') }}"></script>
<script src="{{ asset('dashboard/assets/dist/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/dist/assets/js/dashboard.js') }}"></script>
</body>
