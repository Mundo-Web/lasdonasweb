<div>
  <div class="fixed inset-0 bg-slate-900 bg-opacity-30 z-40 lg:hidden lg:z-auto transition-opacity duration-200"
    :class="sidebarOpen ? 'opacity-100' : 'opacity-0 pointer-events-none'" aria-hidden="true" x-cloak></div>

  <div id="sidebar"
    class="flex flex-col absolute z-40 left-0 top-0 lg:static lg:left-auto lg:top-auto lg:translate-x-0 h-screen overflow-y-scroll lg:overflow-y-auto no-scrollbar w-64 lg:w-20 lg:sidebar-expanded:!w-64 2xl:!w-64 shrink-0 bg-slate-800 p-4 transition-all duration-200 ease-in-out"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-64'" @click.outside="sidebarOpen = false"
    @keydown.escape.window="sidebarOpen = false" x-cloak="lg">

    <div class="flex justify-between mb-10 pr-3 sm:px-2">
      <button class="lg:hidden text-slate-500 hover:text-slate-400" @click.stop="sidebarOpen = !sidebarOpen"
        aria-controls="sidebar" :aria-expanded="sidebarOpen">
        <span class="sr-only">Close sidebar</span>
        <i class="fas fa-times w-6 h-6"></i>
      </button>
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
          <x-menu.item id="datosgenerales" href="{{ route('datosgenerales.edit', 1) }}" icon="fas fa-cog">
            Datos Generales
          </x-menu.item>

          <x-menu.item id="sales" href="{{ route('Admin/Sales.jsx') }}" icon="fa fa-solid fa-cart-shopping">
            Pedidos
            @if ($salesCount !== 0)
              <x-slot name="tag">
                {{ $salesCount }}
              </x-slot>
            @endif
          </x-menu.item>

          <x-menu.item id="slider" href="{{ route('slider.index') }}" icon="fas fa-images">
            Sliders
          </x-menu.item>

          <x-menu.item id="liquidacion" href="{{ route('liquidacion.index') }}" icon="fas fa-percentage">
            Liquidación
          </x-menu.item>
        </ul>
      </div>

      <div>
        <h3 class="text-xs uppercase text-slate-500 font-semibold pl-3">
          <span class="hidden lg:block lg:sidebar-expanded:hidden 2xl:hidden text-center w-6"
            aria-hidden="true">•••</span>
          <span class="lg:hidden lg:sidebar-expanded:block 2xl:block">PRODUCTOS</span>
        </h3>
        <ul class="mt-3">
          <x-menu.item id="categorias" href="{{ route('categorias.index') }}" icon="fas fa-list">
            Categoría
          </x-menu.item>

          <x-menu.item id="subcategories" href="{{ route('subcategories.index') }}" icon="fas fa-sitemap">
            Sub categorias
          </x-menu.item>

          <x-menu.item id="tipo-flor" href="{{ route('tipo-flor.index') }}" icon="mdi mdi-flower">
            Tipo de Flor
          </x-menu.item>

          <x-menu.item id="products" href="{{ route('products.index') }}" icon="fas fa-box">
            Productos
          </x-menu.item>

          <x-menu.item id="tipos" href="{{ route('tipos.index') }}" icon="fas fa-cubes">
            Opciones de producto
          </x-menu.item>

          <x-menu.item id="strength" href="{{ route('strength.index') }}" icon="fas fa-dumbbell">
            Beneficios
          </x-menu.item>

          <x-menu.item id="horarios" href="{{ route('horarios.index') }}" icon="fas fa-clock">
            Horarios
          </x-menu.item>
        </ul>
      </div>

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

          <x-menu.item id="testimonios" href="{{ route('testimonios.index') }}" icon="fas fa-comment-dots">
            Testimonios
          </x-menu.item>

          <x-menu.item id="tags" href="{{ route('tags.index') }}" icon="fas fa-tags">
            Etiquetas
          </x-menu.item>

          <x-menu.item id="precio-envio" href="{{ route('precio-envio.index') }}" icon="fas fa-truck">
            Costos de Envio
          </x-menu.item>

          <x-menu.item id="aboutus" href="{{ route('aboutus.index') }}" icon="fas fa-info-circle">
            Sobre nosotros
          </x-menu.item>

          <x-menu.item id="devolucion" href="{{ route('politicas-de-devolucion.edit', 1) }}" icon="fas fa-undo">
            Politicas de Devolucion
          </x-menu.item>

          <x-menu.item id="politica-sustitucion" href="{{ route('politica-sustitucion.edit', 1) }}"
            icon="fas fa-exchange-alt">
            Politica Floripuntos
          </x-menu.item>

          <x-menu.item id="reclamo" href="{{ route('reclamo.index') }}" icon="fas fa-book">
            Libro de reclamaciones
          </x-menu.item>

          <x-menu.item id="terminosycondiciones" href="{{ route('terminos-y-condiciones.edit', 1) }}"
            icon="fas fa-file-contract">
            Terminos y Condiciones
          </x-menu.item>
        </ul>
      </div>
    </div>

    <div class="pt-3 hidden lg:inline-flex 2xl:hidden justify-end mt-auto">
      <div class="px-3 py-2">
        <button @click="sidebarExpanded = !sidebarExpanded">
          <span class="sr-only">Expand / collapse sidebar</span>
          <i class="fas fa-chevron-left w-6 h-6 fill-current sidebar-expanded:rotate-180"></i>
        </button>
      </div>
    </div>
  </div>
</div>
