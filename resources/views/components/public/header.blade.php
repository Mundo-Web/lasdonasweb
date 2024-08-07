{{-- <img src="{{ asset('img_donas/Home_V0507.png ') }}" class="absolute top-0 left-0 w-full z-[99999] opacity-30"></img> --}}
<header>
  <div class="header_top bg-rosalasdonas w-full h-12 text-white flex flex-row items-center justify-center"> Producto |
    Categoría <span class="ml-1 font-bold"> más vendida </span> <img class="w-6 ml-2"
      src="{{ asset('img_donas/spa.svg') }}">
  </div>
  <div class="header_middle grid grid-cols-12 h-28 md:border-b">
    <div class="block_left col-span-3 flex items-center justify-center ">
      <div class="md:hidden">
        <button class="hamburger" onclick="show()">
          <div id="bar1" class="bar"></div>
          <div id="bar2" class="bar"></div>
          <div id="bar3" class="bar"></div>
        </button>
      </div>
      <div class='max-w-md mx-auto hidden md:block  bg-rosasuave py-1 px-3 rounded-full '>
        <div class="relative flex items-center w-full h-12 rounded-xl   overflow-hidden">
          <div class="grid place-items-center w-12 h-10  text-white bg-rosalasdonas rounded-full ">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </div>

          <input
            class="peer focus:outline-none focus:ring-0 h-full w-full outline-none text-base  pl-2 text-rosalasdonas bg-rosasuave placeholder-rosaplaceholder"
            type="text" id="search" placeholder="Buscar.." />
        </div>
      </div>
    </div>
    <div class="block_center col-span-6 flex items-center justify-center ">
      <a href="/"><img class="w-48" src="{{ asset('img_donas/logo_lasdonas.svg') }}" /></a>
    </div>
    <div class="block_right col-span-3 flex flex-row items-center justify-center pl-2 ">

      <div class="bg-rosalasdonas rounded-full p-2 mr-6 hidden md:block">
        <img class="w-6" src=" {{ asset('img_donas/user.svg') }}" />
      </div>

      <div class="bg-rosalasdonas rounded-full p-2">
        <img class="w-6" src="{{ asset('img_donas/cart.svg') }}" />
      </div>


    </div>
  </div>
  <div class="header_bottom  md:px-[5%] lg:px-[10%] h-12 py-3 hidden md:block bg-[#336234]">
    <div class="text-colorgris font-medium text-base">
      <nav>
        <ul class="menu flex flex-row justify-between">
          @foreach ($submenucategorias->take(7) as $item)
            <li><a href="/catalogo/{{ $item->id }}">{{ $item->name }}</a></li>
          @endforeach

        </ul>
      </nav>
    </div>
  </div>
</header>
