<!DOCTYPE html>
<html  lang="en" >

<head>
	<!-- Required meta tags -->
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
 <link href="{{ asset('home/assets/css/main.css') }}" rel="stylesheet" />
 <link href="{{ asset('home/assets/css/styles.css') }}" rel="stylesheet" />
<link href="{{ asset('home/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" /> 
<link href="{{asset('home/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet" />

<title>@yield('title')</title>
@livewireStyles()
</head>


<body class=" bg-surface">
 {{ $slot }}
<script src="{{ asset('dashboard/assets/dist/assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/jquery-mask.js') }}"></script>

@livewireScripts()
@stack('scripts')
</body>