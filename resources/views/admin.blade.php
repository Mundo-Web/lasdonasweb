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

  <!-- DataTable -->
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.tailwindcss.css">
  <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.3/js/dataTables.tailwindcss.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>

  {{-- Alpine --}}
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

  <link href="/css/icons.min.css" rel="stylesheet" type="text/css">
  {{-- Sweet Alert --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Index</title>
  @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/' . Route::currentRouteName()])
  @inertiaHead
</head>


<body class="font-inter antialiased bg-slate-100 dark:bg-slate-900 text-slate-600 dark:text-slate-400"
  :class="{ 'sidebar-expanded': sidebarExpanded }" x-data="{ sidebarOpen: false, sidebarExpanded: localStorage.getItem('sidebar-expanded') == 'true' }" x-init="$watch('sidebarExpanded', value => localStorage.setItem('sidebar-expanded', value))">

  <script>
    if (localStorage.getItem('sidebar-expanded') == 'true') {
      document.querySelector('body').classList.add('sidebar-expanded');
    } else {
      document.querySelector('body').classList.remove('sidebar-expanded');
    }
  </script>

  <!-- Page wrapper -->
  <div class="flex h-[100dvh] overflow-hidden">

    @include('components.app.sidebar')

    <!-- Content area -->
    <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden {{-- @if ($attributes['background']) {{ $attributes['background'] }} @endif --}}"
      x-ref="contentarea">

      @include('components.app.header')


      <main class="grow">
        @inertia
      </main>

    </div>

  </div>

  @livewireScripts
  @yield('scripts_importados')

</body>

</html>
