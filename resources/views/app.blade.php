<!DOCTYPE html>
<html lang="en">

<head>
  @viteReactRefresh
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
  {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}" /> --}}

  @stack('head')

  {{-- Aqui van los CSS --}}
  @yield('css_importados')

  {{-- Swipper --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  {{-- Alpine --}}
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  {{-- Sweet Alert --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{config('app.name')}}</title>
  @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/' . Route::currentRouteName()])
  <link rel="shortcut icon" href="https://ui-avatars.com/api/?name=L+D&color=fff&background=ff8555&rounded=true" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  @inertiaHead
</head>

<body class="body">
  {{-- <div class="overlay"></div> --}}
  @include('components.public.header')


  <i id="gift-icon" class="absolute fa fa-gift border-1 bg-red-500 " style="display: none"></i>

  {{-- Aqui va el contenido de cada pagina --}}
  @inertia





  @include('components.public.footer')



  @yield('scripts_importados')
  {{-- @vite(['resources/js/functions.js']) --}}
  {{-- <script src="{{ asset('js/functions.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/function.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/carrito.js') }}"></script> --}}


</body>

</html>
