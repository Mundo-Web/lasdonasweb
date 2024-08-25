@extends('components.public.matrix')

@section('css_importados')

@stop
<style>
  .swiper-container {
    position: relative;
  }

  .swiper-button-next,
  .swiper-button-prev {
    position: absolute;
    top: 50%;
    width: 44px;
    height: 44px;
    margin-top: -22px;
    z-index: 10;
    cursor: pointer;
  }

  .swiper-button-next {
    right: 10px;
  }

  .swiper-button-prev {
    left: 10px;
  }

  .swiper-button-next img,
  .swiper-button-prev img {
    width: 100%;
    height: 100%;
  }

  .swiper-pagination-estadisticas {
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 10;
  }
</style>


@section('content')

  <main class="flex flex-col gap-12">
    <section>
      <div class="bg-cover bg-center object-cover h-[500px] lg:h-[674px] text-white text-center flex flex-col justify-center items-center pb-20 p-2 lg:px-[15%] gap-4 font-b_slick_bold"
         style="background-image: url('{{ asset('img_donas/bannerflores.png') }}');">
        <h4 class="text-xl text-[#336234] tracking-wider">EXITOS FLORALES:</h4>
        <h2 class="text-3xl sm:text-4xl md:text-[50px] font-bold  text-[#112212] leading-tight md:!leading-snug tracking-wide">
          LAS CREACIONES QUE CONQUISTAN CORAZONES EN CADA PÉTALO
        </h2>
        <p class="!text-xl text-[#336234] font-b_classic_regular">Sed ut perspiciatis unde omnis iste natus error sit voluptatem</p>
        <button type="button" class="bg-[#336234] px-6 py-3 rounded-full  mt-0 lg:mt-5 tracking-wider">Comprar ahora</button>
      </div>
    </section>



    <section>
      <div class="px-[5%] lg:px-[8%]  space-y-10  ">
        <div class="flex flex-col text-center  pt-[3.25rem] mt-[-8rem] lg:mt-[-10rem] bg-[#FFFFFF] z-5 gap-3 px-5">
          <h3 class="text-lg font-b_slick_bold text-[#FE4A11] ">LO MEJOR DE NOSOTROS</h3>
          <h2 class="text-2xl lg:text-4xl md:text-4xl font-b_slick_bold text-[#112212]">DESCUBRE NUESTROS PRODUCTOS MAS VENDIDOS</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 px-6">
          <div class="col-span-1 sm:col-span-2 lg:col-span-3 xl:col-span-4 relative">
            <div class="swiper productos-relacionados  ">
              <div class="swiper-wrapper h-full relative">
                @foreach ($productos as $item)
                  <div class="swiper-slide w-full h-full col-span-1">
                    <div class="flex flex-col gap-7   col-span-1">
                      <a href="{{ route('Product.jsx', $item->id) }}">
                        <div class="px-2">
                          @if ($item->images->count() == 0)
                            <img src="{{ asset('images/img/noimagen.jpg') }}" alt="{{ $item->producto }}"
                              class="w-full h-[265px] object-cover hover:scale-110 transition-all duration-300" />
                          @else
                            @foreach ($item->images as $image)
                              @if ($image->caratula == 1)
                                @if ($image->name_imagen)
                                  <img src="{{ asset($image->name_imagen) }}" alt="{{ $image->name_imagen }}"
                                    class="w-full h-[265px] object-cover hover:scale-110 transition-all duration-300" />
                                @else
                                  <img src="{{ asset('images/img/noimagen.jpg') }}" alt="{{ $item->producto }}"
                                    class="w-full h-[265px] object-cover hover:scale-110 transition-all duration-300" />
                                @endif
                              @endif
                            @endforeach
                          @endif
                        </div>

                        <div class="px-4 mt-5 ">
                          <h2 class="text-xl font-bold text-black">{{ $item->producto }}</h2>
                          <p class="text-base font-normal text-black h-[48px]">{{ Str::substr($item->extract, 0, 59) }}...
                          </p>
                          <div class="flex  mt-2 font-bold ">
                            <p>S/ <span>75.00</span></p>
                            <p class="px-2">-</p>
                            <p>S/ <span>120.00</span></p>
                          </div>
                        </div>
                      </a>
                      <div class="w-full px-2">
                        <button type="button"
                          class="w-full  py-3  rounded-full shadow-md font-medium flex items-center justify-center bg-[#336234] text-white text-[13px]">Agregar
                          a mi bolsa
                          <img class="ml-2" src="{{ asset('img_donas/addcart.svg') }}" /></button>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>

            <div class="absolute flex flex-row gap-3 " style="  right: 0%;  bottom: -19%;">
              <div
                class="customprev h-10 w-10 rounded-full bg-[#FF8555] opacity-50 hover:opacity-100 transition-opacity flex content-center items-center justify-center">
                <img src="{{ asset('images\prev.png') }}" alt="Prev">
              </div>

              <div
                class="customnext h-10 w-10 rounded-full bg-[#FF8555] opacity-50 hover:opacity-100 transition-opacity flex content-center items-center justify-center">
                <img src="{{ asset('images\next.png') }}" alt="Next">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="mt-12 font-b_slick_bold py-12 lg:py-20">
      {{-- Categorias destacadas --}}
      <div class="flex flex-col px-[5%] lg:px-[8%] gap-4">
        <p class="text-base text-[#FE4A11]">CATEGORIAS</p>
        <p class="text-3xl sm:text-4xl">LO MEJOR DE NUESTRA TIENDA PARA TI</p>
      </div>

      @if (count($category->take(4)) == 4)
        <div class="grid grid-cols-1 sm:grid-cols-2 px-[5%] lg:px-[8%] gap-4 pt-10 ">


          <div class="w-full sm:row-span-2">
            <div class=" h-96  sm:h-full flex flex-col justify-end items-start pb-6 pl-6 "
              style="background-image: url('{{ $category[0]->url_image . $category[0]->name_image }}'); background-size: cover; background-position: center;"
              onerror="this.style.backgroundImage='url(/images/img/noimagen.jpg)'">
              <h3 class="text-base font-medium text-white">Categoría</h3>
              <h2 class="text-3xl font-bold text-white">{{ $category[0]->name }}</h2>
            </div>
          </div>
          <div class="w-full ">
            <div class=" h-52 sm:h-52 md:h-64 lg:h-72 xl:h-96  flex flex-col justify-end items-start pb-6 pl-6"
              style="background-image: url('{{ $category[1]->url_image . $category[1]->name_image }}'); background-size: cover; background-position: center;"
              onerror="this.style.backgroundImage='url(/images/img/noimagen.jpg)'">
              <h3 class="text-base font-medium text-white">Categoría</h3>
              <h2 class="text-3xl font-bold text-white">{{ $category[1]->name }}</h2>
            </div>
          </div>
          <div class="w-full ">
            <div class=" h-52 sm:h-52 md:h-64 lg:h-72 xl:h-96 flex flex-col justify-end items-start pb-6 pl-6"
              style="background-image: url('{{ $category[2]->url_image . $category[2]->name_image }}'); background-size: cover; background-position: center;"
              onerror="this.style.backgroundImage='url(/images/img/noimagen.jpg)'">
              <h3 class="text-base font-medium text-white">Categoría</h3>
              <h2 class="text-3xl font-bold text-white">{{ $category[2]->name }}</h2>
            </div>
          </div>
        </div>
        <div class="grid grid-cols-1 px-[5%] lg:px-[8%] pb-10 mt-4">

          <div class="w-full ">
            <div class=" h-52 sm:h-52 md:h-64 lg:h-72 xl:h-96  flex flex-col justify-end items-start pb-6 pl-6"
              style="background-image: url('{{ $category[3]->url_image . $category[3]->name_image }}'); background-size: cover; background-position: center;"
              onerror="this.style.backgroundImage='url(/images/img/noimagen.jpg)'">
              <h3 class="text-base font-medium text-white">Categoría</h3>
              <h2 class="text-3xl font-bold text-white">{{ $category[3]->name }}</h2>
            </div>
          </div>

        </div>
      @elseif (count($category->take(4)) == 3)
        <div class="grid grid-cols-1 sm:grid-cols-2 px-[5%] lg:px-[8%] gap-8 pt-10">
          <div class="w-full sm:row-span-2">
            <div class="h-full">
              <img src="{{ asset($category[0]->url_image . $category[0]->name_image) }}" alt=""
                class="h-96 sm:h-[760px] flex flex-col justify-end items-start object-cover"
                onerror="this.src='/images/img/noimagen.jpg';">
              <h3 class="text-base font-medium text-[#FE4A11] mt-4">Categoría</h3>
              <h2 class="text-3xl font-bold ">{{ $category[0]->name }}</h2>
            </div>
          </div>
          <div class="w-full">
            <div class="h-full w-full">
              <img src="{{ asset($category[1]->url_image . $category[1]->name_image) }}" alt=""
                class="h-52 sm:h-52 md:h-64 lg:h-60 xl:h-80 w-full  flex flex-col justify-end items-start object-cover"
                onerror="this.src='/images/img/noimagen.jpg';">
              <h3 class="text-base font-medium text-[#FE4A11] pt-4">Categoría</h3>
              <h2 class="text-[32px] font-bold ">{{ $category[1]->name }}</h2>
            </div>
          </div>
          <div class="w-full">
            <div class="h-full">
              <img src="{{ asset($category[2]->url_image . $category[2]->name_image) }}" alt=""
                class="h-52 sm:h-52 md:h-64 lg:h-72 xl:h-80 w-full flex flex-col justify-end items-start object-cover"
                onerror="this.src='/images/img/noimagen.jpg';">
              <h3 class="text-base font-medium text-[#FE4A11] pt-4">Categoría</h3>
              <h2 class="text-3xl font-bold ">{{ $category[2]->name }}</h2>
            </div>
          </div>
        </div>
      @elseif (count($category->take(4)) == 2)
        <div class="grid grid-cols-1 sm:grid-cols-2 px-[5%] lg:px-[8%] gap-8 pt-10">


          <div class="w-full sm:row-span-2">
             <div class="h-full">
              <img src="{{ asset($category[0]->url_image . $category[0]->name_image) }}" alt=""
                class="h-52 sm:h-52 md:h-64 lg:h-72 xl:h-80 w-full flex flex-col justify-end items-start object-cover"
                onerror="this.src='/images/img/noimagen.jpg';">
              <h3 class="text-base font-medium text-[#FE4A11] pt-4">Categoría</h3>
              <h2 class="text-3xl font-bold ">{{ $category[0]->name }}</h2>
            </div>
          </div>
          <div class="w-full ">
             <div class="h-full">
              <img src="{{ asset($category[1]->url_image . $category[1]->name_image) }}" alt=""
                class="h-52 sm:h-52 md:h-64 lg:h-72 xl:h-80 w-full flex flex-col justify-end items-start object-cover"
                onerror="this.src='/images/img/noimagen.jpg';">
              <h3 class="text-base font-medium text-[#FE4A11] pt-4">Categoría</h3>
              <h2 class="text-3xl font-bold ">{{ $category[1]->name }}</h2>
            </div>
          </div>


        </div>
      @elseif (count($category->take(4)) == 1)
        <div class="grid grid-cols-1 px-[5%] lg:px-[8%] pb-10 mt-4">

          <div class="w-full ">
             <div class="h-full">
              <img src="{{ asset($category[0]->url_image . $category[0]->name_image) }}" alt=""
                class="h-52 sm:h-52 md:h-64 lg:h-72 xl:h-96 w-full flex flex-col justify-end items-start object-cover"
                onerror="this.src='/images/img/noimagen.jpg';">
              <h3 class="text-base font-medium text-[#FE4A11] pt-4">Categoría</h3>
              <h2 class="text-3xl font-bold ">{{ $category[0]->name }}</h2>
            </div>
          </div>

        </div>
      @endif


    </section>

    <section class="bg-[#E8EDDE] font-b_slick_bold py-12 lg:py-20">
      <div class="px-[6%]">
        <div class="text-center">
          <h3 class="text-[19.5px] font-bold text-[#FE4A11] ">NOVEDADES</h3>
          <h2 class="text-4xl md:text-4xl font-bold text-black">TODAS NUESTRAS NOVEDADES</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 px-6">
          <div class="col-span-1 sm:col-span-2 lg:col-span-3 xl:col-span-4 relative">
            <div class="swiper productos-relacionados  ">
              <div class="swiper-wrapper h-full relative">
                @foreach ($recomendados as $item)
                  <div class="swiper-slide w-full h-full col-span-1">
                    <x-product.card :item="$item" />
                  </div>
                @endforeach
              </div>


            </div>
            <div class=" absolute  flex flex-row gap-3 " style="  right: 0%;  bottom: -19%;">
              <div
                class=" h-10 w-10 rounded-full bg-[#FF8555] opacity-50 hover:opacity-100 transition-opacity flex content-center items-center justify-center">
                <img src="{{ asset('images\prev.png') }}" alt="Prev">
              </div>

              <div
                class=" h-10 w-10 rounded-full bg-[#FF8555] opacity-50 hover:opacity-100 transition-opacity flex content-center items-center justify-center">
                <img src="{{ asset('images\next.png') }}" alt="Next">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    @if (count($testimonie) > 0)
      <section>
        <div class="px-[8%] py-8 space-y-10">
          <div class="text-left  space-y-2">
            <h3 class="text-lg font-bold text-rosalasdonas">Nuestros clientes</h3>
            <h2 class="text-4xl md:text-5xl font-bold text-black">Testimonios en Flor</h2>
          </div>
          <div class="grid grid-cols-1    ">
            <div class="swiper-container swipper-testimonies overflow-hidden">
              <div class="swiper-wrapper">
                @foreach ($testimonie as $item)
                  <div class="swiper-slide flex flex-row items-center">
                    <div class="flex flex-row">
                      <div class="w-1/2">
                        <img class="w-full object-contain" src="{{ asset('img_donas/splash_testimonios.png') }}" />
                      </div>
                      <div class="w-1/2 px-4">
                        <p class="text-[40px] text-black font-bold leading-snug">{{ $item->testimonie }}</p>
                      </div>
                    </div>

                  </div>
                @endforeach
              </div>
              <!-- Añadir paginación y navegación -->
              <div class="swiper-pagination"></div>
              <div class="swiper-button-next"></div>
              <div class="swiper-button-prev"></div>
            </div>
          </div>
        </div>

      </section>
    @endif



    {{-- <section>
      <div class="grid grid-cols-1  py-10 mt-4">

        <div class="w-full ">
          <div class=" h-200   flex flex-col justify-end items-start pb-[3%]  relative " id="">
            <div class=" flex justify-center items-center m-auto">
              @php
                $videoUrl = $general->url_video;
                parse_str(parse_url($videoUrl, PHP_URL_QUERY), $queryParams);
                $videoId = $queryParams['v'] ?? null;
              @endphp
              <iframe src="https://www.youtube.com/embed/{{ $videoId }}" title="YouTube video player"
                frameborder="0" referrerpolicy="strict-origin-when-cross-origin"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen class="w-[100vw] aspect-video      md:h-[282px] lg:h-[600px]  2xl:h-[750px]"></iframe>
            </div>


          </div>
        </div>

      </div>
    </section> --}}



    <section>

      @if (strlen($general->instagram) > 1)
        <div class="px-[2%] md:px-[25%] pt-8 pb-12">
          <div class="text-center  space-y-5 flex flex-col items-center ">
            <h3 class="text-lg font-bold text-rosalasdonas -mb-4">Redes sociales</h3>
            <h2 class="text-5xl font-bold text-black">Únete a nuestra comunidad floral</h2>
            <p class="text-base font-normal text-black">Descubre la frescura de cada pétalo siguiéndonos.
              Síguenos para estar al tanto de nuestras últimas creaciones y ofertas exclusivas.
              Te esperamos para compartir juntos la belleza floral.</p>
            <a href="{{ $general->instagram }}" target="_blank"
              class="w-52  py-3 rounded-lg shadow-md font-medium flex items-center justify-center bg-rosalasdonas text-white   ">
              Regálanos
              un like
              <img class="ml-2" src="{{ asset('img_donas/favorite.svg') }}" />
            </a>
          </div>
        </div>
      @endif


      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3  lg:grid-cols-4 h-">

        @foreach (array_slice($media, 0, 6) as $item)
          <div class="relative group h-80">
            @if ($item['media_type'] === 'IMAGE' || $item['media_type'] === 'CAROUSEL_ALBUM')
              <img src="{{ $item['media_url'] }}" alt="Image" class="object-cover">
              <a href="{{ $item['permalink'] }}" target="_blank"
                class="opacity-0 hover:cursor-pointer group-hover:opacity-60 duration-300 absolute inset-x-0 top-0 flex justify-center items-center h-full bg-rosalasdonas ">
              </a>
              <img
                class="opacity-0 group-hover:opacity-100 duration-300 absolute inset-x-0 top-1/2 left-1/2 flex justify-center items-center translate-x-[-50%] translate-y-[-50%]"
                src="{{ asset('img_donas/instagram.svg') }}">
            @elseif ($item['media_type'] === 'VIDEO')
              <div class="h-80 overflow-hidden">
                <video class="min-h-80 min-w-full ">
                  <source src="{{ $item['media_url'] }}" type="video/mp4">
                  Your browser does not support the video tag.
                </video>
                <a href="{{ $item['permalink'] }}" target="_blank"
                  class="opacity-0 hover:cursor-pointer group-hover:opacity-60 duration-300 absolute inset-x-0 top-0 flex justify-center items-center h-full bg-rosalasdonas ">
                </a>

                <img
                  class="opacity-0 group-hover:opacity-100 duration-300 absolute inset-x-0 top-1/2 left-1/2 flex justify-center items-center translate-x-[-50%] translate-y-[-50%]"
                  src="{{ asset('img_donas/instagram.svg') }}">

              </div>
            @endif

          </div>
        @endforeach
        {{-- 
        <div class="relative group">
          <img class="w-full" src="{{ asset('img_donas/ig1.png') }}" />
          <div
            class="opacity-0 group-hover:opacity-60 duration-300 absolute inset-x-0 top-0 flex justify-center items-center h-full bg-rosalasdonas ">
          </div>
          <img
            class="opacity-0 group-hover:opacity-100 duration-300 absolute inset-x-0 top-1/2 left-1/2 flex justify-center items-center translate-x-[-50%] translate-y-[-50%]"
            src="{{ asset('img_donas/instagram.svg') }}">
        </div>

        <div class="relative group">
          <img class="w-full" src="{{ asset('img_donas/ig2.png') }}" />
          <div
            class="opacity-0 group-hover:opacity-60 duration-300 absolute inset-x-0 top-0 flex justify-center items-center h-full bg-rosalasdonas ">
          </div>
          <img
            class="opacity-0 group-hover:opacity-100 duration-300 absolute inset-x-0 top-1/2 left-1/2 flex justify-center items-center translate-x-[-50%] translate-y-[-50%]"
            src="{{ asset('img_donas/instagram.svg') }}">
        </div>

        <div class="relative group">
          <img class="w-full" src="{{ asset('img_donas/ig3.png') }}" />
          <div
            class="opacity-0 group-hover:opacity-60 duration-300 absolute inset-x-0 top-0 flex justify-center items-center h-full bg-rosalasdonas ">
          </div>
          <img
            class="opacity-0 group-hover:opacity-100 duration-300 absolute inset-x-0 top-1/2 left-1/2 flex justify-center items-center translate-x-[-50%] translate-y-[-50%]"
            src="{{ asset('img_donas/instagram.svg') }}">
        </div>

        <div class="relative group">
          <img class="w-full" src="{{ asset('img_donas/ig4.png') }}" />
          <div
            class="opacity-0 group-hover:opacity-60 duration-300 absolute inset-x-0 top-0 flex justify-center items-center h-full bg-rosalasdonas ">
          </div>
          <img
            class="opacity-0 group-hover:opacity-100 duration-300 absolute inset-x-0 top-1/2 left-1/2 flex justify-center items-center translate-x-[-50%] translate-y-[-50%]"
            src="{{ asset('img_donas/instagram.svg') }}">
        </div> --}}

      </div>

    </section>
  </main>


@section('scripts_importados')

  <script>
    var swiper = new Swiper('.swipper-testimonies', {
      slidesPerView: 1,
      spaceBetween: 0,
      loop: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
      breakpoints: {
        0: {
          slidesPerView: 1,
          centeredSlides: true,
          loop: true,
        },
      }
    });
  </script>

  <script>
    var appUrl = '{{ env('APP_URL') }}';
  </script>

  <script src="{{ asset('js/carrito.js') }}"></script>

  <script>
    $(document).ready(function() {
      let videourl = '{{ $general->url_video }}'
      let videoId = getYTVideoId(`${videourl}`)

      console.log(videoId)
      let urlfinal = `https://i.ytimg.com/vi/${videoId}/hq720.jpg`


      $("#blockVideo").css({
        "background-image": `url(${urlfinal})`,
        "background-size": "cover",
        "background-position": "center"
      });
    })

    function getYTVideoId(url) {
      const patterns = [
        /(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)/, // URL estándar
        /(?:https?:\/\/)?(?:www\.)?youtu\.be\/([a-zA-Z0-9_-]+)/, // URL corta
        /(?:https?:\/\/)?(?:www\.)?youtube\.com\/embed\/([a-zA-Z0-9_-]+)/, // URL embebida
        /(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?v=([a-zA-Z0-9_-]+)&.+/ // URL con parámetros adicionales
      ];

      for (let pattern of patterns) {
        const matches = url.match(pattern);
        if (matches) {
          return matches[1];
        }
      }

      return null;
    }
  </script>

  <script>
    var headerServices = new Swiper(".productos-relacionados", {
      slidesPerView: 4,
      spaceBetween: 10,
      loop: true,
      centeredSlides: false,
      initialSlide: 0, 
      allowTouchMove: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: true,
        pauseOnMouseEnter: true
      }, 
      navigation: {
        nextEl: ".customnext",
        prevEl: ".customprev",

      },

      breakpoints: {
        0: {
          slidesPerView: 1,
          centeredSlides: false,
          loop: true,
        },
        640: {
          slidesPerView: 2,
          centeredSlides: false,

        },
        1024: {
          slidesPerView: 3,
          centeredSlides: false,

        },
        1280: {
          slidesPerView: 4,
          centeredSlides: false,

        },
      },
    });
  </script>
@stop

@stop
