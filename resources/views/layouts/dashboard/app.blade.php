 
<!DOCTYPE html>
<html   lang="en" >

<head>
	<!-- Required meta tags -->
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<link rel="stylesheet" href="{{ asset('/dashboard/assets/dist/assets/css/theme.css') }}" />
<link href="{{asset('home/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('dashboard/assets/select2/css/select2-bootstrap-4.min.css') }}" />
<link rel="stylesheet" href="{{ asset('dashboard/assets/select2/css/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('dashboard/assets/select2/css/select2.min.css') }}" />

<title>@yield('title')</title>
 {{-- @vite(['resources/css/app.css', 'resources/js/app.js'])  --}}
@livewireStyles()

</head>

<body>
 {{ $slot }}

<script src="{{ asset('dashboard/assets/dist/assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/jquery-mask.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/sweet-alert.js') }}"></script>

<script src="{{ asset('dashboard/assets/dist/assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/dist/assets/libs/iconify-icon/dist/iconify-icon.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/dist/assets/libs/@preline/dropdown/index.js') }}"></script>
<script src="{{ asset('dashboard/assets/dist/assets/libs/@preline/overlay/index.js') }}"></script>
<script src="{{ asset('dashboard/assets/dist/assets/js/sidebarmenu.js') }}"></script>
<script src="{{ asset('dashboard/assets/dist/assets/libs/preline/dist/preline.js') }}"></script>
<script src="{{ asset('dashboard/assets/dist/assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/dist/assets/js/dashboard.js') }}"></script>

<script src="{{ asset('dashboard/assets/select2/js/select2.js') }}"></script>
<script src="{{ asset('dashboard/assets/select2/js/select2-portuguese.js') }}"></script>

@livewireScripts()
@stack('auth')
@stack('scripts')
</body>
