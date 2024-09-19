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

    <section class="z-0">
      <div class="swiper slider-portada">
        <div class="swiper-wrapper">
          @foreach ($slider as $slide)
            <div class="swiper-slide">
              <div
                class="hidden bg-cover bg-center object-cover h-[500px] lg:h-[674px] text-white text-center md:flex flex-col justify-center items-center pb-20 p-2 lg:px-[15%] gap-4 font-b_slick_bold"
                style="background-image:  @if ($slide->name_image) url('{{ asset($slide->url_image . $slide->name_image) }}')
                            @else url('{{ asset('images/img/noimagenslider.jpg') }}') @endif">
                <h4 class="text-xl text-[#336234] tracking-wider">{{ $slide->subtitle }}</h4>
                <h2
                  class="text-3xl sm:text-4xl md:text-[50px] font-bold  text-[#112212] leading-tight md:!leading-snug tracking-wide uppercase">
                  {{ $slide->title2 }}
                </h2>
                <p class="!text-xl text-[#336234] font-b_classic_regular md:line-clamp-none line-clamp-3">
                  {{ $slide->description }}</p>
                <a href="{{ $slide->link1 }}" type="button"
                  class="bg-[#336234] px-6 py-3 rounded-full  mt-0 lg:mt-5 tracking-wider">{{ $slide->botontext1 }}</a>
              </div>

              <div
                class="flex bg-cover bg-center object-cover h-[500px] lg:h-[674px] text-white text-center md:hidden flex-col justify-center items-center pb-20 p-2 lg:px-[15%] gap-4 font-b_slick_bold"
                style="background-image:  @if ($slide->name_image) url('{{ asset($slide->img_mobile) }}')
                            @else url('{{ asset('images/img/noimagenslider.jpg') }}') @endif">
                <h4 class="text-xl text-[#336234] tracking-wider">{{ $slide->subtitle }}</h4>
                <h2
                  class="text-3xl sm:text-4xl md:text-[50px] font-bold  text-[#112212] leading-tight md:!leading-snug tracking-wide uppercase">
                  {{ $slide->title2 }}
                </h2>
                <p class="!text-xl text-[#336234] font-b_classic_regular md:line-clamp-none line-clamp-3">
                  {{ $slide->description }}</p>
                <a href="{{ $slide->link1 }}" type="button"
                  class="bg-[#336234] px-6 py-3 rounded-full  mt-0 lg:mt-5 tracking-wider">{{ $slide->botontext1 }}</a>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </section>

    <section class="z-0">
      <div class="px-[5%] lg:px-[8%]  space-y-10">
        <div class="flex flex-col text-center  pt-[3.25rem] mt-[-8rem] lg:mt-[-10rem] bg-[#FFFFFF] gap-3 px-5">
          <h3 class="text-lg font-b_slick_bold text-[#FE4A11] ">LO MEJOR DE NOSOTROS</h3>
          <h2 class="text-2xl lg:text-4xl md:text-4xl font-b_slick_bold text-[#112212]">DESCUBRE NUESTROS PRODUCTOS MAS
            VENDIDOS</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 px-6">
          <div class="col-span-1 sm:col-span-2 lg:col-span-3 xl:col-span-4 relative">
            <div class="swiper productos-relacionados  ">
              <div class="swiper-wrapper h-full relative">
                @foreach ($productos as $item)
                  <div class="swiper-slide w-full h-full col-span-1">
                    <x-product.card :item="$item" />
                  </div>
                @endforeach
              </div>
            </div>

            <div class="flex flex-row justify-end gap-3 ">
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

    <section class="mt-12 font-b_slick_bold py-12 lg:py-20 z-0">
      {{-- Categorias destacadas --}}
      <div class="flex flex-col px-[5%] lg:px-[8%] gap-4">
        <p class="text-base text-[#FE4A11]">CATEGORIAS</p>
        <p class="text-3xl sm:text-4xl">LO MEJOR DE NUESTRA TIENDA PARA TI</p>
      </div>
      @php
        $categories = $categoriasindex;
        $chunks = $categories->chunk(4);
        $processedCategories = collect();
      @endphp

      @foreach ($chunks as $chunk)
        @if ($chunk->count() == 4)
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 px-[5%] lg:px-[8%] gap-8 pt-10">
            @foreach ($chunk as $category)
              @if ($loop->first)
                <div class="w-full lg:row-span-2 lg:col-span-2">
                  <a href="{{ route('Catalogo.jsx', $category->id) }}">
                    <div class="h-full">
                      <img src="{{ asset($category->url_image . $category->name_image) }}" alt=""
                        class="hidden h-52 sm:h-52 md:h-64 lg:h-[660px] xl:h-[760px] md:flex md:flex-col justify-end items-start object-cover w-full"
                        onerror="this.src='/images/img/noimagen.jpg';">
                      <img src="{{ asset($category->img_miniatura) }}" alt=""
                        class="h-[24rem]  flex md:hidden  object-cover w-full"
                        onerror="this.src='/images/img/noimagen.jpg';">
                      <h3 class="text-base font-medium text-[#FE4A11] mt-4 mb-[5%]"></h3>
                      <h2 class="text-3xl font-bold ">{{ $category->name }}</h2>
                    </div>
                  </a>
                </div>
              @elseif ($loop->iteration == 2)
                <div class="w-full lg:col-span-2">
                  <a href="{{ route('Catalogo.jsx', $category->id) }}">
                    <div class="h-full w-full">
                      <img src="{{ asset($category->url_image . $category->name_image) }}" alt=""
                        class="hidden h-52 sm:h-52 md:h-64 lg:h-60 xl:h-80 w-full md:flex md:flex-col justify-end items-start object-cover"
                        onerror="this.src='/images/img/noimagen.jpg';">
                      <img src="{{ asset($category->img_miniatura) }}" alt=""
                        class="h-[24rem]  flex md:hidden  object-cover w-full"
                        onerror="this.src='/images/img/noimagen.jpg';">
                      <h3 class="text-base font-medium text-[#FE4A11] pt-4 mb-[5%]"></h3>
                      <h2 class="text-[32px] font-bold ">{{ $category->name }}</h2>
                    </div>
                  </a>
                </div>
              @else
                <div class="w-full">
                  <a href="{{ route('Catalogo.jsx', $category->id) }}">
                    <div class="h-full">
                      <img src="{{ asset($category->url_image . $category->name_image) }}" alt=""
                        class="hidden h-52 sm:h-52 md:h-64 lg:h-72 xl:h-80 w-full md:flex md:flex-col justify-end items-start object-cover"
                        onerror="this.src='/images/img/noimagen.jpg';">
                      <img src="{{ asset($category->img_miniatura) }}" alt=""
                        class="h-[24rem]  flex md:hidden  object-cover w-full"
                        onerror="this.src='/images/img/noimagen.jpg';">
                      <h3 class="text-base font-medium text-[#FE4A11] pt-4 mb-[5%]"></h3>
                      <h2 class="text-3xl font-bold ">{{ $category->name }}</h2>
                    </div>
                  </a>
                </div>
              @endif
            @endforeach
          </div>
        @endif

        @php
          $processedCategories = $processedCategories->merge($chunk); // Guardamos las categorías procesadas.
        @endphp
      @endforeach

      {{-- Manejo de categorías restantes si no son múltiplos de 4 --}}
      @php
        $remainder = $categories->count() % 4;
        $remainderCategories = $categories->diff($processedCategories);
      @endphp

      @php
        $remainderCategories = $categories->slice(-$remainder);
      @endphp


      @if ($remainder > 0)
        @if ($remainder == 1)

          @foreach ($remainderCategories as $category)
            <div class="grid grid-cols-1 px-[5%] lg:px-[8%] pb-10 mt-10">
              <div class="w-full">
                <a href="{{ route('Catalogo.jsx', $category->id) }}">
                  <div class="h-full">
                    <img src="{{ asset($category->url_image . $category->name_image) }}" alt=""
                      class="hidden h-52 sm:h-52 md:h-64 lg:h-72 xl:h-96 w-full md:flex md:flex-col justify-end items-start object-cover"
                      onerror="this.src='/images/img/noimagen.jpg';">
                    <img src="{{ asset($category->img_miniatura) }}" alt=""
                      class="h-[24rem]  flex md:hidden  object-cover w-full"
                      onerror="this.src='/images/img/noimagen.jpg';">
                    <h3 class="text-base font-medium text-[#FE4A11] pt-4 mb-[5%]"></h3>
                    <h2 class="text-3xl font-bold ">{{ $category->name }}</h2>
                  </div>
                </a>
              </div>
            </div>
          @endforeach
        @elseif ($remainder == 2)
          <div class="grid grid-cols-1 sm:grid-cols-2 px-[5%] lg:px-[8%] gap-8 pt-10">
            @foreach ($remainderCategories as $category)
              <div class="w-full">
                <a href="{{ route('Catalogo.jsx', $category->id) }}">
                  <div class="h-full">
                    <img src="{{ asset($category->url_image . $category->name_image) }}" alt=""
                      class="hidden h-52 sm:h-52 md:h-64 lg:h-72 xl:h-80 w-full md:flex md:flex-col justify-end items-start object-cover"
                      onerror="this.src='/images/img/noimagen.jpg';">
                    <img src="{{ asset($category->img_miniatura) }}" alt=""
                      class="h-[24rem]  flex md:hidden  object-cover w-full"
                      onerror="this.src='/images/img/noimagen.jpg';">
                    <h3 class="text-base font-medium text-[#FE4A11] pt-4 mb-[5%]"></h3>
                    <h2 class="text-3xl font-bold ">{{ $category->name }}</h2>
                  </div>
                </a>
              </div>
            @endforeach
          </div>
        @elseif ($remainder == 3)
          <div class="grid grid-cols-1 sm:grid-cols-2 px-[5%] lg:px-[8%] gap-8 pt-10">
            @foreach ($remainderCategories as $category)
              <div class="w-full {{ $loop->first ? 'sm:row-span-2' : '' }}">
                <a href="{{ route('Catalogo.jsx', $category->id) }}">
                  <div class="h-full">
                    <img src="{{ asset($category->url_image . $category->name_image) }}" alt=""
                      class="{{ $loop->first ? 'h-96 sm:h-[760px]' : 'h-52 sm:h-52 md:h-64 lg:h-72 xl:h-80' }} hidden w-full md:flex md:flex-col justify-end items-start object-cover"
                      onerror="this.src='/images/img/noimagen.jpg';">
                    <img src="{{ asset($category->img_miniatura) }}" alt=""
                      class="h-[24rem]  flex md:hidden  object-cover w-full"
                      onerror="this.src='/images/img/noimagen.jpg';">
                    <h3 class="text-base font-medium text-[#FE4A11] pt-4 mb-[5%]"></h3>
                    <h2 class="text-3xl font-bold ">{{ $category->name }}</h2>
                  </div>
                </a>
              </div>
            @endforeach
          </div>
        @endif
      @endif
    </section>


    <section class="bg-[#E8EDDE] font-b_slick_bold pt-16 pb-20 lg:pt-20 lg:pb-28 z-0">
      <div class="w-full px-[5%] lg:px-[8%] flex flex-col gap-10">
        <div class="flex flex-col gap-3 text-center">
          <h3 class="text-xl font-bold text-[#FE4A11] ">NOVEDADES</h3>
          <h2 class="text-4xl md:text-4xl font-bold text-black">TODAS NUESTRAS NOVEDADES</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 px-6">
          <div class="col-span-1 sm:col-span-2 lg:col-span-3 xl:col-span-4 relative">
            <div class="swiper productos-novedades">
              <div class="swiper-wrapper h-full relative">
                @foreach ($recomendados as $item)
                  <div class="swiper-slide w-full h-full col-span-1">
                    <x-product.card :item="$item" />
                  </div>
                @endforeach
              </div>
            </div>
            <div class="flex flex-row justify-end gap-3">
              <div
                class="prevnovedades h-10 w-10 rounded-full bg-[#FF8555] opacity-50 hover:opacity-100 transition-opacity flex content-center items-center justify-center">
                <img src="{{ asset('images\prev.png') }}" alt="Prev">
              </div>

              <div
                class="nextnovedades h-10 w-10 rounded-full bg-[#FF8555] opacity-50 hover:opacity-100 transition-opacity flex content-center items-center justify-center">
                <img src="{{ asset('images\next.png') }}" alt="Next">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    @if (count($testimonie) > 0)
      <section class="pt-10 pb-12  lg:py-20 flex flex-col w-full gap-12 relative px-[5%] lg:px-[8%] z-0">
        <div class="w-full">
          <div class="flex flex-col gap-3 text-left font-b_slick_bold">
            <h3 class="text-xl text-[#FE4A11] ">NUESTROS CLIENTES</h3>
            <h2 class="text-4xl md:text-4xl text-black">TESTIMONIO EN FLOR</h2>
          </div>
        </div>

        <div class="swiper testimonios flex flex-row w-full px-[5%]">
          <div class="swiper-wrapper">
            @foreach ($testimonie as $item)
              <div class="swiper-slide">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-20">

                  <div class="flex flex-col lg:col-span-5 justify-center items-center">
                    <div
                      class="w-full h-[500px] 2xl:h-[700px] overflow-hidden relative bg-cover bg-center flex justify-center items-center"
                      {{-- style="background-image: url('{{ asset('img_donas/testimonios.png') }}');" --}}>

                      <img src="{{ asset($item->img) }}"
                        class="rounded-none bg-cover w-full h-full object-cover md:object-contain"
                        onerror="this.onerror=null; this.src='{{ asset('img_donas/testimonios.png') }}';" />
                    </div>
                  </div>

                  <div class="flex flex-col lg:col-span-7 gap-10 justify-center items-start w-full font-b_slick_bold">
                    <h2 class="text-3xl lg:text-4xl 2xl:text-5xl leading-none  text-black  text-left line-clamp-6">
                      {{ $item->testimonie }}
                    </h2>
                    <div class="flex flex-col justify-start items-center">
                      <div class="flex flex-row items-center gap-3">
                        <img class="rounded-full w-20 h-20 object-cover"
                          src="https://ui-avatars.com/api/?name={{ $item->name }}&color=FFF&background=FE4A11" />
                        <div>
                          <h3 class="text-lg font-outfitSemiBold">{{ $item->name }}</h3>
                          <p class="text-base font-outfitLight">{{ $item->ocupation }}</p>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            @endforeach
          </div>
        </div>

        <div class="flex flex-row justify-start gap-3 ">
          <div
            class="prevtestimonio h-10 w-10 rounded-full bg-[#336234] opacity-50 hover:opacity-100 transition-opacity flex content-center items-center justify-center">
            <img src="{{ asset('images\prev.png') }}" alt="Prev">
          </div>
          <div
            class="nexttestimonio h-10 w-10 rounded-full bg-[#336234] opacity-50 hover:opacity-100 transition-opacity flex content-center items-center justify-center">
            <img src="{{ asset('images\next.png') }}" alt="Next">
          </div>
        </div>
      </section>
    @endif

    <section class="z-0">
      <div class="grid grid-cols-1 ">
        @php
          $videoUrl = $general->url_video;
          parse_str(parse_url($videoUrl, PHP_URL_QUERY), $queryParams);
          $videoId = $queryParams['v'] ?? null;
        @endphp

        <div
          class="contenedorvideo w-full h-[500px] lg:h-[600px] border border-gray-200 rounded-none overflow-hidden relative bg-cover bg-center"
          style="background-image: url('{{ asset('img_donas/Video.png') }}');">
          <div class="absolute inset-0 flex items-center justify-center disparo bg-opacity-50 cursor-pointer"
            onclick="showVideo(this)">
            <button class="text-white text-2xl"><img class="w-20 hover:scale-125 transition-transform duration-300"
                src="{{ asset('img_donas/botonplay.png') }}" /></button>
          </div>
          <iframe id="videoIframe" class="videoIframe w-full h-full hidden"
            src="https://www.youtube.com/embed/{{ $videoId }}" referrerpolicy="strict-origin-when-cross-origin"
            frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
        </div>
      </div>
    </section>

    <section class="z-0">
      @if (strlen($general->instagram) > 1)
        <div class="px-[5%] lg:px-[8%] pt-8 pb-12 flex flex-col">
          <div class="text-center flex flex-col gap-6 items-center max-w-4xl mx-auto">
            <h3 class="font-b_slick_bold text-xl text-[#FE4A11] tracking-wider">REDES SOCIALES</h3>
            <h2 class="text-4xl md:text-4xl font-b_slick_bold text-[#112212] uppercase tracking-wider">Únete a nuestra
              comunidad floral</h2>
            <p class="text-xl font-b_classic_regular text-[#112212CC]">Descubre la frescura de cada pétalo siguiéndonos.
              Síguenos para estar al tanto de nuestras últimas creaciones y ofertas exclusivas.
              Te esperamos para compartir juntos la belleza floral.</p>
            <a href="{{ $general->instagram }}" target="_blank"
              class="px-6 py-3 rounded-3xl shadow-md font-b_slick_bold flex items-center justify-center bg-[#336234] text-white cursor-pointer mt-4">
              Regálanos
              un like
              <img class="ml-2" src="{{ asset('img_donas/favorite.svg') }}" />
            </a>
          </div>
        </div>
      @endif


      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3  lg:grid-cols-4 -z-10">

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
      spaceBetween: 30,
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
          slidesPerView: 2,
          centeredSlides: false,
          loop: true,
          spaceBetween: 10
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


    var headerServices = new Swiper(".productos-novedades", {
      slidesPerView: 4,
      spaceBetween: 30,
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
        nextEl: ".nextnovedades",
        prevEl: ".prevnovedades",

      },

      breakpoints: {
        0: {
          slidesPerView: 2,
          centeredSlides: false,
          loop: true,
          spaceBetween: 10
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

    var swiper = new Swiper(".testimonios", {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      grabCursor: true,
      centeredSlides: false,
      initialSlide: 0,
      navigation: {
        nextEl: ".nexttestimonio",
        prevEl: ".prevtestimonio",
      },
      breakpoints: {
        0: {
          slidesPerView: 1,
          spaceBetween: 30,
        },
        768: {
          slidesPerView: 1,
          spaceBetween: 30,
        },
        1024: {
          slidesPerView: 1,
          spaceBetween: 30,
        },
      },

    });

    var swiper = new Swiper(".slider-portada", {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      grabCursor: true,
      centeredSlides: false,
      initialSlide: 0,
      breakpoints: {
        0: {
          slidesPerView: 1,
          spaceBetween: 30,
        },
        768: {
          slidesPerView: 1,
          spaceBetween: 30,
        },
        1024: {
          slidesPerView: 1,
          spaceBetween: 30,
        },
      },

    });
  </script>
  <script>
    function showVideo(element) {
      const slide = element.closest('.contenedorvideo');
      const videoIframe = slide.querySelector('.videoIframe');
      videoIframe.classList.remove('hidden');
      videoIframe.src += "?autoplay=1";
      element.style.display = 'none';
    }
  </script>
  <script>
    const ref = localStorage.getItem('ref');
    if (ref && ref === 'pago') {
      localStorage.removeItem('ref');
      window.location.href = `/pago`;
    }
  </script>
@stop

@stop
