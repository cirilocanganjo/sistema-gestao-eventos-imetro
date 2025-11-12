<!DOCTYPE html>
<html  lang="en">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="{{ asset('dashboard/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
<link href="{{ asset('auth/assets/css/theme.css') }}" rel="stylesheet" />
 @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
 @vite(['resources/css/app.css', 'resources/js/app.js'])
 @endif
<title>@yield('title')</title>
@livewireStyles()
</head>
<body>
{{ $slot }}
<script src="{{ asset('dashboard/assets/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/sweet-alert.js') }}"></script>
@livewireScripts()
@stack('auth')
@stack('recover-password')
</body>
</html>