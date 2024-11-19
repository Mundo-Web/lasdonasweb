<div>
  <!-- Sidebar backdrop (mobile only) -->
  <div class="fixed inset-0 bg-slate-900 bg-opacity-30 z-40 lg:hidden lg:z-auto transition-opacity duration-200"
    :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'" aria-hidden="true" x-cloak></div>

  <!-- Sidebar -->
  <div id="sidebar"
    class="flex flex-col absolute z-40 left-0 top-0 lg:static lg:left-auto lg:top-auto lg:translate-x-0 h-screen overflow-y-scroll lg:overflow-y-auto no-scrollbar w-64 lg:w-20 lg:sidebar-expanded:!w-64 2xl:!w-64 shrink-0 bg-slate-800 p-4 transition-all duration-200 ease-in-out"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'" @click.outside="sidebarOpen = false"
    @keydown.escape.window="sidebarOpen = false" x-cloak="lg">

    <!-- Sidebar header -->
    <div class="flex justify-between mb-10 pr-3 sm:px-2">
      <!-- Close button -->
      <button class="lg:hidden text-slate-500 hover:text-slate-400" @click.stop="sidebarOpen = !sidebarOpen"
        aria-controls="sidebar" :aria-expanded="sidebarOpen">
        <span class="sr-only">Close sidebar</span>
        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M10.7 18.7l1.4-1.4L7.8 13H20v-2H7.8l4.3-4.3-1.4-1.4L4 12z" />
        </svg>
      </button>
      <!-- Logo -->
      <a class="block mt-8" href="{{ route('dashboard') }}">
        <img src="{{ asset('img_donas/Logo.png') }}" alt="doomine" />
      </a>
    </div>

    <div class="space-y-8">
      <div>
        <h3 class="text-xs uppercase text-slate-500 font-semibold pl-3">
          <span class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center w-6"
            aria-hidden="true">•••</span>
          <span class="lg:hidden lg:sidebar-expanded:block 2xl:block">Dommine - Backend</span>
        </h3>
        <ul class="mt-3">
          <li
            class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(2), ['datosgenerales'])) {{ 'bg-slate-900' }} @endif">
            <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(2), ['datosgenerales'])) {{ 'hover:text-slate-200' }} @endif"
              href="{{ route('datosgenerales.edit', 1) }}">
              <div class="flex items-center">
                <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['datosgenerales'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-600' }} @endif"
                    d="M1 3h22v20H1z" />
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['datosgenerales'])) {{ 'text-indigo-300' }}@else{{ 'text-slate-400' }} @endif"
                    d="M21 3h2v4H1V3h2V1h4v2h10V1h4v2Z" />
                </svg>
                <span
                  class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Datos
                  Generales</span>
              </div>
            </a>
          </li>

          <x-menu.item id="sales" href="{{ route('Admin/Sales.jsx') }}" icon="fa fa-solid fa-cart-shopping">
            Pedidos
            @if ($salesCount !== 0)
              <x-slot name="tag">
                {{ $salesCount }}
              </x-slot>
            @endif
          </x-menu.item>



          <!-- Sliders -->
          <li
            class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(2), ['slider'])) {{ 'bg-slate-900' }} @endif">
            <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(2), ['slider'])) {{ 'hover:text-slate-200' }} @endif"
              href="{{ route('slider.index') }}">
              <div class="flex items-center">
                <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['slider'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-600' }} @endif"
                    d="M1 3h22v20H1z" />
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['slider'])) {{ 'text-indigo-300' }}@else{{ 'text-slate-400' }} @endif"
                    d="M21 3h2v4H1V3h2V1h4v2h10V1h4v2Z" />
                </svg>
                <span
                  class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Sliders</span>
              </div>
            </a>
          </li>

          <!-- Liquidación -->
          <li
            class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(2), ['liquidacion'])) {{ 'bg-slate-900' }} @endif">
            <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(2), ['liquidacion'])) {{ 'hover:text-slate-200' }} @endif"
              href="{{ route('liquidacion.index') }}">
              <div class="flex items-center">
                <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['liquidacion'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-600' }} @endif"
                    d="M1 3h22v20H1z" />
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['liquidacion'])) {{ 'text-indigo-300' }}@else{{ 'text-slate-400' }} @endif"
                    d="M21 3h2v4H1V3h2V1h4v2h10V1h4v2Z" />
                </svg>
                <span
                  class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Liquidación</span>
              </div>
            </a>
          </li>

        </ul>
      </div>


      <!-- PRODUCTOS -->
      <div>
        <h3 class="text-xs uppercase text-slate-500 font-semibold pl-3">
          <span class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center w-6"
            aria-hidden="true">•••</span>
          <span class="lg:hidden lg:sidebar-expanded:block 2xl:block">PRODUCTOS</span>
        </h3>
        <ul class="mt-3">


          <!-- Category -->
          <li
            class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(2), ['categorias'])) {{ 'bg-slate-900' }} @endif">
            <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(2), ['categorias'])) {{ 'hover:text-slate-200' }} @endif"
              href="{{ route('categorias.index') }}">
              <div class="flex items-center">
                <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['categorias'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-600' }} @endif"
                    d="M1 3h22v20H1z" />
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['categorias'])) {{ 'text-indigo-300' }}@else{{ 'text-slate-400' }} @endif"
                    d="M21 3h2v4H1V3h2V1h4v2h10V1h4v2Z" />
                </svg>
                <span
                  class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Categoría</span>
              </div>
            </a>
          </li>
          <li
            class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(2), ['subcategories'])) {{ 'bg-slate-900' }} @endif">
            <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(2), ['subcategories'])) {{ 'hover:text-slate-200' }} @endif"
              href="{{ route('subcategories.index') }}">
              <div class="flex items-center">
                <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['subcategories'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-600' }} @endif"
                    d="M1 3h22v20H1z" />
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['subcategories'])) {{ 'text-indigo-300' }}@else{{ 'text-slate-400' }} @endif"
                    d="M21 3h2v4H1V3h2V1h4v2h10V1h4v2Z" />
                </svg>
                <span
                  class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Sub
                  categorias </span>
              </div>
            </a>
          </li>

          <!-- Colecciones -->
          <li
            class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(2), ['tipo-flor'])) {{ 'bg-slate-900' }} @endif">
            <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(2), ['tipo-flor'])) {{ 'hover:text-slate-200' }} @endif"
              href="{{ route('tipo-flor.index') }}">
              <div class="flex items-center">
                <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['tipo-flor'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-600' }} @endif"
                    d="M1 3h22v20H1z" />
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['tipo-flor'])) {{ 'text-indigo-300' }}@else{{ 'text-slate-400' }} @endif"
                    d="M21 3h2v4H1V3h2V1h4v2h10V1h4v2Z" />
                </svg>
                <span
                  class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Tipo
                  de Flor</span>
              </div>
            </a>
          </li>

          <!-- Productos -->
          <li
            class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(2), ['products'])) {{ 'bg-slate-900' }} @endif">
            <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(2), ['products'])) {{ 'hover:text-slate-200' }} @endif"
              href="{{ route('products.index') }}">
              <div class="flex items-center">
                <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['products'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-600' }} @endif"
                    d="M1 3h22v20H1z" />
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['products'])) {{ 'text-indigo-300' }}@else{{ 'text-slate-400' }} @endif"
                    d="M21 3h2v4H1V3h2V1h4v2h10V1h4v2Z" />
                </svg>
                <span
                  class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Productos</span>
              </div>
            </a>
          </li>
          <li
            class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(2), ['tipos'])) {{ 'bg-slate-900' }} @endif">
            <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(2), ['tipos'])) {{ 'hover:text-slate-200' }} @endif"
              href="{{ route('tipos.index') }}">
              <div class="flex items-center">
                <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['tipos'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-600' }} @endif"
                    d="M1 3h22v20H1z" />
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['tipos'])) {{ 'text-indigo-300' }}@else{{ 'text-slate-400' }} @endif"
                    d="M21 3h2v4H1V3h2V1h4v2h10V1h4v2Z" />
                </svg>
                <span
                  class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Opciones
                  de producto</span>
              </div>
            </a>
          </li>
          <li
            class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(2), ['strength'])) {{ 'bg-slate-900' }} @endif">
            <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(2), ['strength'])) {{ 'hover:text-slate-200' }} @endif"
              href="{{ route('strength.index') }}">
              <div class="flex items-center">
                <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['strength'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-600' }} @endif"
                    d="M1 3h22v20H1z" />
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['strength'])) {{ 'text-indigo-300' }}@else{{ 'text-slate-400' }} @endif"
                    d="M21 3h2v4H1V3h2V1h4v2h10V1h4v2Z" />
                </svg>
                <span
                  class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Beneficios</span>
              </div>
            </a>
          </li>
          <li
            class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(2), ['horarios'])) {{ 'bg-slate-900' }} @endif">
            <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(2), ['horarios'])) {{ 'hover:text-slate-200' }} @endif"
              href="{{ route('horarios.index') }}">
              <div class="flex items-center">
                <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['horarios'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-600' }} @endif"
                    d="M1 3h22v20H1z" />
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['horarios'])) {{ 'text-indigo-300' }}@else{{ 'text-slate-400' }} @endif"
                    d="M21 3h2v4H1V3h2V1h4v2h10V1h4v2Z" />
                </svg>
                <span
                  class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Horarios</span>
              </div>
            </a>
          </li>

        </ul>
      </div>


      <!-- Mantenedores -->
      <div>
        <h3 class="text-xs uppercase text-slate-500 font-semibold pl-3">
          <span class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center w-6"
            aria-hidden="true">•••</span>
          <span class="lg:hidden lg:sidebar-expanded:block 2xl:block">Mantenedores</span>
        </h3>
        <ul class="mt-3">
          <x-menu.item id="cupones" href="{{ route('cupones.index') }}" icon="fa-solid fa-ticket">
            Cupones
          </x-menu.item>

          <x-menu.item id="greetings" href="{{ route('greetings.index') }}" icon="fas fa-hand-sparkles">

            Mensajes predefinidos
          </x-menu.item>

          <li
            class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(2), ['testimonios'])) {{ 'bg-slate-900' }} @endif">
            <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(2), ['testimonios'])) {{ 'hover:text-slate-200' }} @endif"
              href="{{ route('testimonios.index') }}">
              <div class="flex items-center">
                <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['testimonios'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-600' }} @endif"
                    d="M1 3h22v20H1z" />
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['testimonios'])) {{ 'text-indigo-300' }}@else{{ 'text-slate-400' }} @endif"
                    d="M21 3h2v4H1V3h2V1h4v2h10V1h4v2Z" />
                </svg>
                <span
                  class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Testimonios</span>
              </div>
            </a>
          </li>

          <li
            class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(2), ['tags'])) {{ 'bg-slate-900' }} @endif">
            <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(2), ['tags'])) {{ 'hover:text-slate-200' }} @endif"
              href="{{ route('tags.index') }}">
              <div class="flex items-center">
                <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['tags'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-600' }} @endif"
                    d="M1 3h22v20H1z" />
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['tags'])) {{ 'text-indigo-300' }}@else{{ 'text-slate-400' }} @endif"
                    d="M21 3h2v4H1V3h2V1h4v2h10V1h4v2Z" />
                </svg>
                <span
                  class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Etiquetas</span>
              </div>
            </a>
          </li>

          <li
            class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(2), ['precio-envio'])) {{ 'bg-slate-900' }} @endif">
            <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(2), ['precio-envio'])) {{ 'hover:text-slate-200' }} @endif"
              href="{{ route('precio-envio.index') }}">
              <div class="flex items-center">
                <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['precio-envio'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-600' }} @endif"
                    d="M1 3h22v20H1z" />
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['precio-envio'])) {{ 'text-indigo-300' }}@else{{ 'text-slate-400' }} @endif"
                    d="M21 3h2v4H1V3h2V1h4v2h10V1h4v2Z" />
                </svg>
                <span
                  class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Costos
                  de Envio</span>
              </div>
            </a>
          </li>

          <li
            class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(2), ['aboutus'])) {{ 'bg-slate-900' }} @endif">
            <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(2), ['aboutus'])) {{ 'hover:text-slate-200' }} @endif"
              href="{{ route('aboutus.index') }}">
              <div class="flex items-center">
                <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['aboutus'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-600' }} @endif"
                    d="M1 3h22v20H1z" />
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['aboutus'])) {{ 'text-indigo-300' }}@else{{ 'text-slate-400' }} @endif"
                    d="M21 3h2v4H1V3h2V1h4v2h10V1h4v2Z" />
                </svg>
                <span
                  class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Sobre
                  nosotros </span>
              </div>
            </a>
          </li>
          <!-- Politicas de devolucion -->
          <li
            class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(2), ['devolucion'])) {{ 'bg-slate-900' }} @endif">
            <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(2), ['devolucion'])) {{ 'hover:text-slate-200' }} @endif"
              href="{{ route('politicas-de-devolucion.edit', 1) }}">
              <div class="flex items-center">
                <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['devolucion'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-600' }} @endif"
                    d="M1 3h22v20H1z" />
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['devolucion'])) {{ 'text-indigo-300' }}@else{{ 'text-slate-400' }} @endif"
                    d="M21 3h2v4H1V3h2V1h4v2h10V1h4v2Z" />
                </svg>
                <span
                  class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Politicas
                  de Devolucion</span>
              </div>
            </a>
          </li>
          <li
            class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(2), ['politica-sustitucion'])) {{ 'bg-slate-900' }} @endif">
            <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(2), ['politica-sustitucion'])) {{ 'hover:text-slate-200' }} @endif"
              href="{{ route('politica-sustitucion.edit', 1) }}">
              <div class="flex items-center">
                <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['politica-sustitucion'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-600' }} @endif"
                    d="M1 3h22v20H1z" />
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['politica-sustitucion'])) {{ 'text-indigo-300' }}@else{{ 'text-slate-400' }} @endif"
                    d="M21 3h2v4H1V3h2V1h4v2h10V1h4v2Z" />
                </svg>
                <span
                  class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Politica
                  Floripuntos</span>
              </div>
            </a>
          </li>
          <li
            class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(2), ['reclamo'])) {{ 'bg-slate-900' }} @endif">
            <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(2), ['reclamo'])) {{ 'hover:text-slate-200' }} @endif"
              href="{{ route('reclamo.index') }}">
              <div class="flex items-center">
                <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['reclamo'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-600' }} @endif"
                    d="M1 3h22v20H1z" />
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['reclamo'])) {{ 'text-indigo-300' }}@else{{ 'text-slate-400' }} @endif"
                    d="M21 3h2v4H1V3h2V1h4v2h10V1h4v2Z" />
                </svg>
                <span
                  class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">
                  Libro de reclamaciones</span>
              </div>
            </a>
          </li>

          <!-- Terminos y Condiciones -->
          <li
            class="px-3 py-2 rounded-sm mb-0.5 last:mb-0 @if (in_array(Request::segment(2), ['terminosycondiciones'])) {{ 'bg-slate-900' }} @endif">
            <a class="block text-slate-200 hover:text-white truncate transition duration-150 @if (in_array(Request::segment(2), ['terminosycondiciones'])) {{ 'hover:text-slate-200' }} @endif"
              href="{{ route('terminos-y-condiciones.edit', 1) }}">
              <div class="flex items-center">
                <svg class="shrink-0 h-6 w-6" viewBox="0 0 24 24">
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['terminosycondiciones'])) {{ 'text-indigo-500' }}@else{{ 'text-slate-600' }} @endif"
                    d="M1 3h22v20H1z" />
                  <path
                    class="fill-current @if (in_array(Request::segment(2), ['terminosycondiciones'])) {{ 'text-indigo-300' }}@else{{ 'text-slate-400' }} @endif"
                    d="M21 3h2v4H1V3h2V1h4v2h10V1h4v2Z" />
                </svg>
                <span
                  class="text-sm font-medium ml-3 lg:opacity-0 lg:sidebar-expanded:opacity-100 2xl:opacity-100 duration-200">Terminos
                  y Condiciones</span>
              </div>
            </a>
          </li>


        </ul>
      </div>

    </div>

    <!-- Expand / collapse button -->
    <div class="pt-3 hidden lg:inline-flex 2xl:hidden justify-end mt-auto">
      <div class="px-3 py-2">
        <button @click="sidebarExpanded = !sidebarExpanded">
          <span class="sr-only">Expand / collapse sidebar</span>
          <svg class="w-6 h-6 fill-current sidebar-expanded:rotate-180" viewBox="0 0 24 24">
            <path class="text-slate-400" d="M19.586 11l-5-5L16 4.586 23.414 12 16 19.414 14.586 18l5-5H7v-2z" />
            <path class="text-slate-600" d="M3 23H1V1h2z" />
          </svg>
        </button>
      </div>
    </div>

  </div>
</div>
