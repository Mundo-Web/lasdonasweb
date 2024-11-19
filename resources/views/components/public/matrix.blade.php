<!DOCTYPE html>
<html lang="en">

<head>
  @viteReactRefresh
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  {{-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> --}}
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
  {{-- <link rel="stylesheet" href="{{ asset('css/style.css') }}" /> --}}


  @livewireStyles



  {{-- <script src="{{ asset('js/notify.extend.min.js') }}"></script> --}}

  <!-- Remember to include jQuery :) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>

  <!-- jQuery Modal -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

  {{-- Aqui van los CSS --}}
  @yield('css_importados')
  @stack('head')




  {{-- Swipper --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  {{-- Alpine --}}
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  {{-- Sweet Alert --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>{{ config('app.name') }}</title>
  <link rel="shortcut icon" href="/img_donas/icon.svg" type="image/x-icon">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link href="/css/icons.min.css" rel="stylesheet" type="text/css">
</head>

<body class="body">

  {{-- <div class="overlay"></div> --}}
  @include('components.public.header')

  <div class="main">
    {{-- Aqui va el contenido de cada pagina --}}
    @yield('content')

  </div>



  @include('components.public.footer')



  @yield('scripts_importados')
  {{-- @vite(['resources/js/functions.js']) --}}
  {{-- <script src="{{ asset('js/functions.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/function.js') }}"></script> --}}
  {{-- <script src="{{ asset('js/carrito.js') }}"></script> --}}

  @livewireScripts

  <script>
    document.addEventListener('click', function(event) {
      const target = event.target;

      if (target.tagName === 'BUTTON' && target.hasAttribute('href')) {
        const href = target.getAttribute('href');

        if (target.getAttribute('target') === '_blank') {
          window.open(href, '_blank');
        } else {
          window.location.href = href;
        }
      }
    });
  </script>
</body>

</html>
