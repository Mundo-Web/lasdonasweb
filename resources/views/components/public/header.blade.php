{{-- <img src="{{ asset('img_donas/Carrito.png') }}" class="absolute top-0 left-0 w-full z-[99999] opacity-30"></img> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />

@php
  $pagina = Route::currentRouteName();
  $isIndex = $pagina == 'index';
@endphp

<style>
body {
    overflow-x: hidden;
}
  #header_top {
    transition: height 0.6s ease, opacity 0.6s ease;
  }

  .fixed-header {
    position: sticky;
    top: 0;
    left: 0;
    right: 0;
    z-index: 1;
  }

  #header-mid.fixed-header {
    transition: height 0.6s ease; 
  }

  .header_bottom.fixed-header {
    top: 80px; 
  }

  #cart-modal {
      z-index: 10000; 
  }
  

  .submenu {
    display: none; /* Oculto por defecto */
    position: absolute;
    background-color: white;
    padding: 1rem;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    z-index: 1000;
}

.subcategories {
    margin-right: 2rem;
}

.category-image img {
    max-width: 100px;
    height: auto;
    object-fit: cover;
}
</style>


  <div id="header_top"
    class="bg-[#FF8555] h-[50px] text-white flex justify-center w-full px-[5%] xl:px-[8%] py-3 text-base items-center">
    Producto | Categoría <span class="ml-1 font-b_classic_bold mt-1"> más vendida </span> <img
      class="w-6 ml-2" src="{{ asset('img_donas/spa.svg') }}">
  </div>

<header class="font-b_classic_regular sticky top-0" style="z-index:1">
  
      <div id="header-mid"  class="h-[100px] flex flex-row items-center bg-white">
        <div class="flex flex-row items-center justify-between gap-5 w-full px-[5%] xl:px-[8%]   text-[17px] relative bg-white ">

          {{-- <div id="menu-burguer" class="lg:hidden z-10 w-max">
              <img class="h-10 w-10 cursor-pointer" src="{{ asset('images/img/menu_hamburguer.png') }}"
                alt="menu hamburguesa" onclick="show()" />
          </div> --}}

          <div class="w-auto min-w-[110px] flex items-center justify-center">
            <a href="{{route('index')}}">
              {{-- <img id="logo-lasdonas" class="w-[250px]  " src="{{ asset($isIndex ? 'img_donas/Logo.png' : 'img_donas/Logo.png') }}" alt="lasdonas" /> --}}
              <img id="logo-lasdonas" class="w-[250px]  " src="/img_donas/Logo_donas.svg" alt="lasdonas" />
            </a>
          </div>

          <div class="hidden lg:flex items-center justify-center ">
            {{-- <div>
                <nav id="menu-items"
                  class=" text-[#333] text-base font-Inter_Medium flex gap-5 xl:gap-6 items-center justify-center "
                  x-data="{ openCatalogo: false, openSubMenu: null }">
                
                  <a href="/" class="font-medium hover:opacity-75 other-class">
                    <span class="underline-this">INICIO</span>
                  </a>

                  <a href="/nosotros" class="font-medium hover:opacity-75 other-class">
                    <span class="underline-this">NOSOTROS</span>
                  </a>

                  <a id="productos-link" href="{{ route('Catalogo.jsx') }}" class="font-medium ">
                    <span class="underline-this">PRODUCTOS</span>
                    <div id="productos-link-h" class="w-0"></div>
                  </a>

                  <a href="/contacto" class="font-medium hover:opacity-75  other-class">
                    <span class="underline-this">CONTACTO</span>
                  </a>
                </nav>
              </div> --}}
          </div>

          <div class="flex justify-end md:w-auto md:justify-center items-center gap-2">

            <div
              class="relative w-full lg:w-80 lg:py-0 border-b lg:border-0 border-[#082252] mr-3 hidden lg:flex font-b_classic_bold">
              <input id="buscarproducto" type="text" placeholder="Buscar..."
                class="w-full pl-12 pr-10 py-3 border lg:border-[#F8F8F8] bg-[#F8F8F8] rounded-3xl focus:outline-none focus:ring-0 text-gray-400 placeholder:text-gray-400 focus:border-transparent">
              <span
                class="absolute inset-y-0 left-0 flex items-start lg:items-center bg-[#336234] rounded-full my-[7px] px-2 ml-2">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="#336234" xmlns="http://www.w3.org/2000/svg"
                  class="">
                  <path
                    d="M14.6851 13.6011C14.3544 13.2811 13.8268 13.2898 13.5068 13.6206C13.1868 13.9514 13.1955 14.4789 13.5263 14.7989L14.6851 13.6011ZM16.4206 17.5989C16.7514 17.9189 17.2789 17.9102 17.5989 17.5794C17.9189 17.2486 17.9102 16.7211 17.5794 16.4011L16.4206 17.5989ZM15.2333 9.53333C15.2333 12.6814 12.6814 15.2333 9.53333 15.2333V16.9C13.6018 16.9 16.9 13.6018 16.9 9.53333H15.2333ZM9.53333 15.2333C6.38531 15.2333 3.83333 12.6814 3.83333 9.53333H2.16667C2.16667 13.6018 5.46484 16.9 9.53333 16.9V15.2333ZM3.83333 9.53333C3.83333 6.38531 6.38531 3.83333 9.53333 3.83333V2.16667C5.46484 2.16667 2.16667 5.46484 2.16667 9.53333H3.83333ZM9.53333 3.83333C12.6814 3.83333 15.2333 6.38531 15.2333 9.53333H16.9C16.9 5.46484 13.6018 2.16667 9.53333 2.16667V3.83333ZM13.5263 14.7989L16.4206 17.5989L17.5794 16.4011L14.6851 13.6011L13.5263 14.7989Z"
                    fill="#ffffff" class="fill-fillAzulPetroleo lg:fill-fillPink" />
                </svg>
              </span>
              <div class="bg-white z-60 shadow-2xl top-12 w-full absolute overflow-y-auto max-h-[200px]" id="resultados">
              </div>
            </div>


            @if (Auth::user() == null)
              <a class="flex" href="{{ route('login') }}"><img class="bg-white rounded-lg"
                  src="{{ asset('img_donas/Group11.png') }}" alt="user" /></a>
            @else
              <div class="relative  hidden md:inline-flex" x-data="{ open: false }">
                <button class="px-3 py-5 inline-flex justify-center items-center group" aria-haspopup="true"
                  @click.prevent="open = !open" :aria-expanded="open">
                  <div class="flex items-center truncate">
                    <span id="username"
                      class="truncate ml-2 text-sm font-medium dark:text-slate-300 group-hover:opacity-75 dark:group-hover:text-slate-200 text-[#272727] ">
                      {{ explode(' ', Auth::user()->name)[0] }}</span>
                    <svg class="w-3 h-3 shrink-0 ml-1 fill-current text-slate-400" viewBox="0 0 12 12">
                      <path d="M5.9 11.4L.5 6l1.4-1.4 4 4 4-4L11.3 6z" />
                    </svg>
                  </div>
                </button>
                <div
                  class="origin-top-right z-10 absolute top-full min-w-44 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 py-1.5 rounded shadow-lg overflow-hidden mt-1"
                  @click.outside="open = false" @keydown.escape.window="open = false" x-show="open">
                  <ul>
                    <li class="hover:bg-gray-100">
                      <a class="font-medium text-sm text-black flex items-center py-1 px-3" href="{{ route('micuenta') }}"
                        @click="open = false" @focus="open = true" @focusout="open = false">Mi Cuenta</a>
                    </li>

                    <li class="hover:bg-gray-100">
                      <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                        <button type="submit" class="font-medium text-sm text-black flex items-center py-1 px-3"
                          @click.prevent="$root.submit(); open = false">
                          {{ __('Cerrar sesión') }}
                        </button>
                      </form>
                    </li>
                  </ul>
                </div>
              </div>
            @endif


            <div class="flex justify-center items-center min-w-[38px]" >
              <div id="open-cart" class="relative inline-block cursor-pointer pr-3">
                <span id="itemsCount"
                  class="bg-[#EB5D2C] text-xs font-medium text-white text-center px-[7px] py-[2px]  rounded-full absolute bottom-0 right-0 ml-3">0</span>
                <img src="{{ asset('img_donas/Group10.png') }}"
                  class="bg-white rounded-lg p-1 max-w-full h-auto cursor-pointer" style="z-index:3" />
              </div>
            </div>

          </div>

        </div>
      </div>

      <div class="header_bottom h-12 bg-[#336234] px-[5%]">
        <div class="text-base font-b_classic_bold">
          <nav>
            <div class="swiper menu !overflow-visible">
              <div class="swiper-wrapper relative ">
                
                  <div x-data="{ openCatalogo: false }" class="swiper-slide py-3" id="slide-1" @mouseenter="openCatalogo = true" @mouseleave="openCatalogo = false" >
                    <ul class="menu flex flex-row justify-center items-center text-center text-white tracking-wider">
                      <li><a href="#">Para ellas</a></li>
                    </ul>
                    <div x-show="openCatalogo" @click.outside="openCatalogo = false" @keydown.escape.window="openCatalogo = false"
                     :class="{
                          'left-0': $el.getBoundingClientRect().left < 300,
                          'right-0': $el.getBoundingClientRect().right > (window.innerWidth - 300),
                          'transform -translate-x-1/2': $el.getBoundingClientRect().left >= 300 && $el.getBoundingClientRect().right <= (window.innerWidth - 300)
                      }"
                     class="z-10 fixed top-full  transform -translate-x-1/2 bg-black w-[600px] h-96 mt-0 border p-8 shadow-lg overflow-hidden" >
                      <div class="flex flex-row">
                          <ul class="subcategories text-left">
                              <li class="mb-1"><a href="#" class="hover:text-blue-500">Categoría 1</a></li>
                              <li class="mb-1"><a href="#" class="hover:text-blue-500">Categoría 2</a></li>
                              <li class="mb-1"><a href="#" class="hover:text-blue-500">Categoría 3</a></li>
                            </ul>
                          <div class="category-image ml-4">
                              <img src="{{ asset('img_donas/spa.svg') }}" class="w-40 h-40 object-cover">
                          </div>
                      </div>
                    </div>         
                  </div>

                  <div x-data="{ openCatalogo: false }" class="swiper-slide py-3" id="slide-1" @mouseenter="openCatalogo = true" @mouseleave="openCatalogo = false" >
                    <ul class="menu flex flex-row justify-center items-center text-center text-white tracking-wider">
                      <li><a href="#">Para Categoría Categoría</a></li>
                    </ul>
                    <div x-show="openCatalogo" @click.outside="openCatalogo = false" @keydown.escape.window="openCatalogo = false"
                    :class="{
                          'left-0': $el.getBoundingClientRect().left < 300,
                          'right-0': $el.getBoundingClientRect().right > (window.innerWidth - 300),
                          'transform -translate-x-1/2': $el.getBoundingClientRect().left >= 300 && $el.getBoundingClientRect().right <= (window.innerWidth - 300)
                      }"
                     class="z-10 fixed top-full left-1/2 transform -translate-x-1/2 bg-black w-[600px] h-96 mt-0 border p-8 shadow-lg overflow-hidden" >
                      <div class="flex flex-row">
                          <ul class="subcategories text-left">
                              <li class="mb-1"><a href="#" class="hover:text-blue-500">Categoría 1</a></li>
                              <li class="mb-1"><a href="#" class="hover:text-blue-500">Categoría 2</a></li>
                              <li class="mb-1"><a href="#" class="hover:text-blue-500">Categoría 3</a></li>
                            </ul>
                          <div class="category-image ml-4">
                              <img src="{{ asset('img_donas/spa.svg') }}" class="w-40 h-40 object-cover">
                          </div>
                      </div>
                    </div>         
                  </div>

                  <div x-data="{ openCatalogo: false }" class="swiper-slide py-3" id="slide-1" @mouseenter="openCatalogo = true" @mouseleave="openCatalogo = false" >
                    <ul class="menu flex flex-row justify-center items-center text-center text-white tracking-wider">
                      <li><a href="#">Categoría ellas</a></li>
                    </ul>
                    <div x-show="openCatalogo" @click.outside="openCatalogo = false" @keydown.escape.window="openCatalogo = false"
                    :class="{
                          'left-0': $el.getBoundingClientRect().left < 300,
                          'right-0': $el.getBoundingClientRect().right > (window.innerWidth - 300),
                          'transform -translate-x-1/2': $el.getBoundingClientRect().left >= 300 && $el.getBoundingClientRect().right <= (window.innerWidth - 300)
                      }"
                     class="z-10 fixed top-full left-1/2 transform -translate-x-1/2 bg-black w-[600px] h-96 mt-0 border p-8 shadow-lg overflow-hidden" >
                      <div class="flex flex-row">
                          <ul class="subcategories text-left">
                              <li class="mb-1"><a href="#" class="hover:text-blue-500">Categoría 1</a></li>
                              <li class="mb-1"><a href="#" class="hover:text-blue-500">Categoría 2</a></li>
                              <li class="mb-1"><a href="#" class="hover:text-blue-500">Categoría 3</a></li>
                            </ul>
                          <div class="category-image ml-4">
                              <img src="{{ asset('img_donas/spa.svg') }}" class="w-40 h-40 object-cover">
                          </div>
                      </div>
                    </div>         
                  </div>

              </div>
            </div>
          </nav>
        </div>
      </div>

            
      
</header>

 {{-- <div class="swiper-slide menu-item relative group py-3 " id="slide-{{$item->id}}">
    <ul class="menu flex flex-row justify-center items-center text-center text-white tracking-wider">
      <li><a href="/catalogo/{{ $item->id }}">{{ $item->name }}</a></li>
    </ul>
    <div id="popup" class="absolute top-0 bg-white text-black p-4 shadow-lg z-50 h-56 w-96">
      <div class="flex flex-row">
          <ul class="subcategories text-left">
              <li class="mb-1"><a href="#" class="hover:text-blue-500">Categoría 1</a></li>
              <li class="mb-1"><a href="#" class="hover:text-blue-500">Categoría 2</a></li>
              <li class="mb-1"><a href="#" class="hover:text-blue-500">Categoría 3</a></li>
            </ul>
          <div class="category-image ml-4">
              <img src="{{ asset('img_donas/spa.svg') }}" class="w-40 h-40 object-cover">
          </div>
      </div>
    </div>         
 </div> --}}


<div id="cart-modal" 
  class="bag !absolute top-0 right-0 md:w-[450px] cartContainer border shadow-2xl  !rounded-md !p-0"
  style="display: none">
  <div class="p-4 flex flex-col h-[90vh] justify-between gap-2">
    <div class="flex flex-col">
      <div class="flex justify-between ">
        <h2 class="font-semibold font-Inter_Medium text-[28px] text-[#151515] pb-5">Carrito</h2>
        <div id="close-cart" class="cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-6 h-6">
            <path stroke="#272727" stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
          </svg>
        </div>
      </div>
      <div class="overflow-y-scroll h-[calc(90vh-200px)] scroll__carrito">
        <table class="w-full">
          <tbody id="itemsCarrito">
          </tbody>
        </table>
      </div>
    </div>
    <div class="flex flex-col gap-2 pt-2">
      <div class="text-[#336234]  text-xl flex justify-between items-center">
        <p class="font-Inter_Medium font-semibold">Total</p>
        <p class="font-Inter_Medium font-semibold" id="itemsTotal">S/ 0.00</p>
      </div>
      <div>
        <a href="/carrito"
          class="font-normal font-Inter_Medium text-lg bg-[#336234] py-3 px-5 rounded-2xl text-white cursor-pointer w-full inline-block text-center">Ver
          Carrito</a>
      </div>
    </div>
  </div>
</div>

<script src="{{ asset('js/storage.extend.js') }}"></script>

<script>
  const appUrl = "{{ env('APP_URL') }}"
  var articulosCarrito = Local.get('carrito') || [];
  $(document).ready(() => {
    mostrarTotalItems()
    PintarCarrito()
  })

  $('#open-cart').on('click', () => {
    $('#cart-modal').modal({
      showClose: false,
      fadeDuration: 100
    })
    $('#cart-modal').css('z-index', 10000);
  })

  $('#close-cart').on('click', () => {
    $('.jquery-modal.blocker.current').trigger('click')
  })

  function mostrarTotalItems() {
    let articulos = Local.get('carrito')
    let contarArticulos = articulos.reduce((total, articulo) => {
      return total + articulo.cantidad;
    }, 0);

    $('#itemsCount').text(contarArticulos)
  }

  function addOnCarBtn(id, isCombo) {
    let prodRepetido = articulosCarrito.map(item => {
      if (item.id === id && item.isCombo == isCombo) {

        item.cantidad += 1;
      }
      return item;
    });

    Local.set('carrito', articulosCarrito);
    limpiarHTML();
    PintarCarrito();
  }

  function deleteOnCarBtn(id, isCombo) {
    let prodRepetido = articulosCarrito.map(item => {
      if (item.id === id && item.isCombo == isCombo && item.cantidad > 0) {

        item.cantidad -= 1;
      }
      return item;
    });

    Local.set('carrito', articulosCarrito);
    limpiarHTML();
    PintarCarrito();
  }

  function deleteItem(id, isCombo) {

    let idCount = {};
    let duplicates = [];
    articulosCarrito.forEach(item => {
      if (idCount[item.id]) {
        idCount[item.id]++;
      } else {
        idCount[item.id] = 1;
      }
    });



    for (let id in idCount) {
      if (idCount[id] > 1) {
        duplicates.push(id);
      }
    }

    if (duplicates.length > 0) {

      let index = articulosCarrito.findIndex(item => item.id === id);
      if (index > -1) {
        articulosCarrito.splice(index, 1);
      }
    } else {
      articulosCarrito = articulosCarrito.filter(objeto => objeto.id !== id);

    }

    // return



    Local.set('carrito', articulosCarrito)
    limpiarHTML()
    PintarCarrito()
  }

  function limpiarHTML() {
    //forma lenta 
    /* contenedorCarrito.innerHTML=''; */
    $('#itemsCarrito').html('')
    $('#itemsCarritoCheck').html('')


  }

  function PintarCarrito() {

    let articulosCarrito = Local.get('carrito') || [];

    let itemsCarrito = $('#itemsCarrito')
    let itemsCarritoCheck = $('#itemsCarritoCheck')

    articulosCarrito.forEach(element => {

      let plantilla = `<tr class=" font-poppins border-b">
          <td class="p-2">
            <img src="${appUrl}/${element.imagen}" class="block bg-[#F3F5F7] rounded-md p-0 " alt="producto" onerror="this.onerror=null;this.src='/images/img/noimagen.jpg';"  style="width: 100px; height: 75px; object-fit: contain; object-position: center;" />
          </td>
          <td class="p-2">
            <p class="font-semibold text-[14px] text-[#151515] mb-1">
              ${element.producto} - ${element.tipo}
            </p>
            <div class="flex w-20 justify-center text-[#151515] border-[1px] border-[#6C7275] rounded-md">
              <button type="button" onClick="(deleteOnCarBtn(${element.id}))" class="w-6 h-6 flex justify-center items-center ">
                <span  class="text-[20px]">-</span>
              </button>
              <div class="w-6 h-6 flex justify-center items-center">
                <span  class="font-semibold text-[12px]">${element.cantidad}</span>
              </div>
              <button type="button" onClick="(addOnCarBtn(${element.id}))" class="w-6 h-6 flex justify-center items-center ">
                <span class="text-[20px]">+</span>
              </button>
            </div>
          </td>
          <td class="p-2 text-end">
            <p class="font-semibold text-[14px] text-[#151515] w-max">
              S/${Number(element.precio)} 
              
            </p>
            <button type="button" onClick="(deleteItem(${element.id} ))" class="w-6 h-6 flex justify-center items-center mx-auto">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#272727" class="w-6 h-6">
                <path stroke="#272727" stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
              </svg>
            </button>

          </td>
        </tr>`

      itemsCarrito.append(plantilla)
      itemsCarritoCheck.append(plantilla)

    });

    mostrarTotalItems()
    calcularTotal()
  }

  function calcularTotal() {
    let articulos = Local.get('carrito')
    let total = articulos.map(item => {
      let total = 0
      total += item.cantidad * Number(item.precio)
      /* if (item.complementos.length > 0) {
        item.complementos.forEach(complemento => {
          total += Number(complemento.preciofiltro)
        })
      } */
      return total


    }).reduce((total, elemento) => total + elemento, 0);

    // const suma = total.

    $('#itemsTotal').text(`S/. ${total} `)

  }
</script>

<script>
  var menu = new Swiper(".menu", {
    slidesPerView: 5,
    spaceBetween: 10,
    loop: true,
    centeredSlides: false,
    initialSlide: 0,
    allowTouchMove: true,
    autoplay: {
      delay: 5500,
      disableOnInteraction: true,
      pauseOnMouseEnter: true
    },
    breakpoints: {
      0: {
        slidesPerView: 2,
        centeredSlides: false,
        loop: true,
      },
      640: {
        slidesPerView: 3,
        centeredSlides: false,

      },
      1024: {
        slidesPerView: 5,
        centeredSlides: false,

      },
      1280: {
        slidesPerView: 6,
        centeredSlides: false,

      },
    },
  });
</script>
<script>
window.addEventListener('scroll', function() {
  const headerMid = document.getElementById('header-mid');
  const headerBottom = document.querySelector('.header_bottom');
  const portada = document.getElementById('portada'); 
  const main = document.querySelector('.main');
  
  const scrollPosition = window.scrollY;
  const documentHeight = document.documentElement.scrollHeight;
  const viewportHeight = window.innerHeight;

 
  const scrollPercentage = (scrollPosition / (documentHeight - viewportHeight)) * 100;

  
  if (scrollPercentage >= 1) {
    headerMid.classList.add('fixed-header', 'h-[80px]');
    headerMid.classList.remove('h-[100px]');
    headerBottom.classList.add('fixed-header', 'shadow-lg', 'shadow-black/40');
    portada.classList.add('mt-[150px]'); 
    //main.classList.add('mt-[128px]'); 
  } else {
    headerMid.classList.remove('fixed-header', 'h-[80px]');
    headerMid.classList.add('h-[100px]');
    headerBottom.classList.remove('fixed-header');
    //portada.classList.remove('mt-[150px]'); 
  }
});
</script>

