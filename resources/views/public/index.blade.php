@extends('components.public.matrix')

@section('css_importados')

@stop


@section('content')

  <main class="flex flex-col gap-12">
    <section>
      <div
        class="banner_section2 lg:banner_sec h-128 lg:h-200 text-white text-center flex flex-col justify-center items-center space-y-4 p-5 lg:px-[20%]">
        <h1 class="text-4xl md:text-6xl font-bold">Éxitos Florales: Las Creaciones que Conquistan Corazones en Cada Pétalo
        </h1>
        <p class="text-lg font-normal">Sed ut perspiciatis unde omnis iste natus error sit voluptatem</p>
        <button type="button" class="bg-rosalasdonas px-6 py-3 rounded-lg ">Comprar ahora</button>
      </div>
    </section>

    <section>
      <div class="px-[5%] py-16 space-y-10">
        <div class="text-center  space-y-2">
          <h3 class="text-lg font-bold text-rosalasdonas">Lo Mejor de Nosotros</h3>
          <h2 class="text-4xl md:text-5xl font-bold text-black">Descubre Nuestros Productos Más Vendidos</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

          <div class="space-y-2 max-w-96 m-auto">
            <a href="/producto.html">
              <img class="w-96 h-96 object-contain" src="{{ asset('img_donas/productolasdonas.png') }}" />
              <h2 class="text-xl font-bold text-black">Ramo Primaveral</h2>
              <p class="text-base font-normal text-black">Estallido de colores primaverales. Ideal para alegrar el día.
              </p>
              <div class="flex font-medium">
                <p>S/ <span>75.00</span></p>
                <p class="px-2">-</p>
                <p>S/ <span>120.00</span></p>
              </div>
            </a>
            <button type="button"
              class="w-full  py-3 rounded-lg shadow-md font-medium flex items-center justify-center">Agregar a mi bolsa
              <img class="ml-2" src="{{ asset('img_donas/addcart.svg') }}" /></input>
          </div>

          <div class="space-y-2 max-w-96 m-auto">
            <a href="/producto.html">
              <img class="w-96 h-96 object-contain" src="{{ asset('img_donas/productolasdonas.png') }}" />
              <h2 class="text-xl font-bold text-black">Ramo Primaveral</h2>
              <p class="text-base font-normal text-black">Estallido de colores primaverales. Ideal para alegrar el día.
              </p>
              <div class="flex font-medium">
                <p>S/ <span>75.00</span></p>
                <p class="px-2">-</p>
                <p>S/ <span>120.00</span></p>
              </div>
            </a>
            <button type="button"
              class="w-full  py-3 rounded-lg shadow-md font-medium flex items-center justify-center">Agregar a mi bolsa
              <img class="ml-2" src="{{ asset('img_donas/addcart.svg') }}" /></input>
          </div>

          <div class="space-y-2 max-w-96 m-auto">
            <a href="/producto.html">
              <img class="w-96 h-96 object-contain" src="{{ asset('img_donas/productolasdonas.png') }}" />
              <h2 class="text-xl font-bold text-black">Ramo Primaveral</h2>
              <p class="text-base font-normal text-black">Estallido de colores primaverales. Ideal para alegrar el día.
              </p>
            </a>
            <div class="flex font-medium">
              <p>S/ <span>75.00</span></p>
              <p class="px-2">-</p>
              <p>S/ <span>120.00</span></p>
            </div>
            <button type="button"
              class="w-full  py-3 rounded-lg shadow-md font-medium flex items-center justify-center">Agregar a mi bolsa
              <img class="ml-2" src="{{ asset('img_donas/addcart.svg') }}" /></input>
          </div>

          <div class="space-y-2 max-w-96 m-auto">
            <a href="/producto.html">
              <img class="w-96 h-96 object-contain" src="{{ asset('img_donas/productolasdonas.png') }}" />
              <h2 class="text-xl font-bold text-black">Ramo Primaveral</h2>
              <p class="text-base font-normal text-black">Estallido de colores primaverales. Ideal para alegrar el día.
              </p>
            </a>
            <div class="flex font-medium">
              <p>S/ <span>75.00</span></p>
              <p class="px-2">-</p>
              <p>S/ <span>120.00</span></p>
            </div>
            <button type="button"
              class="w-full  py-3 rounded-lg shadow-md font-medium flex items-center justify-center">Agregar a mi bolsa
              <img class="ml-2" src="{{ asset('img_donas/addcart.svg') }}" /></input>
          </div>

        </div>
      </div>
    </section>

    <section>
      {{-- Categorias destacadas --}}

      @if (count($category->take(4)) == 4)
        <div class="grid grid-cols-1 sm:grid-cols-2 px-[5%] lg:px-[7%] gap-4 pt-10">


          <div class="w-full sm:row-span-2">
            <div class=" h-96  sm:h-full flex flex-col justify-end items-start pb-6 pl-6 "
              style="background-image: url('{{ $category[0]->url_image . $category[0]->name_image }}'); background-size: cover; background-position: center;">
              <h3 class="text-base font-medium text-white">Categoría</h3>
              <h2 class="text-3xl font-bold text-white">{{ $category[0]->name }}</h2>
            </div>
          </div>
          <div class="w-full ">
            <div class=" h-52 sm:h-52 md:h-64 lg:h-72 xl:h-96  flex flex-col justify-end items-start pb-6 pl-6"
              style="background-image: url('{{ $category[1]->url_image . $category[1]->name_image }}'); background-size: cover; background-position: center;">
              <h3 class="text-base font-medium text-white">Categoría</h3>
              <h2 class="text-3xl font-bold text-white">{{ $category[1]->name }}</h2>
            </div>
          </div>
          <div class="w-full ">
            <div class=" h-52 sm:h-52 md:h-64 lg:h-72 xl:h-96 flex flex-col justify-end items-start pb-6 pl-6"
              style="background-image: url('{{ $category[2]->url_image . $category[2]->name_image }}'); background-size: cover; background-position: center;">
              <h3 class="text-base font-medium text-white">Categoría</h3>
              <h2 class="text-3xl font-bold text-white">{{ $category[2]->name }}</h2>
            </div>
          </div>
        </div>
        <div class="grid grid-cols-1 px-[5%] lg:px-[7%] pb-10 mt-4">

          <div class="w-full ">
            <div class=" h-52 sm:h-52 md:h-64 lg:h-72 xl:h-96  flex flex-col justify-end items-start pb-6 pl-6"
              style="background-image: url('{{ $category[3]->url_image . $category[3]->name_image }}'); background-size: cover; background-position: center;">
              <h3 class="text-base font-medium text-white">Categoría</h3>
              <h2 class="text-3xl font-bold text-white">{{ $category[3]->name }}</h2>
            </div>
          </div>

        </div>
      @elseif (count($category->take(4)) == 3)
        <div class="grid grid-cols-1 sm:grid-cols-2 px-[5%] lg:px-[7%] gap-4 pt-10">


          <div class="w-full sm:row-span-2">
            <div class=" h-96  sm:h-full flex flex-col justify-end items-start pb-6 pl-6 "
              style="background-image: url('{{ $category[0]->url_image . $category[0]->name_image }}'); background-size: cover; background-position: center;">
              <h3 class="text-base font-medium text-white">Categoría</h3>
              <h2 class="text-3xl font-bold text-white">{{ $category[0]->name }}</h2>
            </div>
          </div>
          <div class="w-full ">
            <div class=" h-52 sm:h-52 md:h-64 lg:h-72 xl:h-96  flex flex-col justify-end items-start pb-6 pl-6"
              style="background-image: url('{{ $category[1]->url_image . $category[1]->name_image }}'); background-size: cover; background-position: center;">
              <h3 class="text-base font-medium text-white">Categoría</h3>
              <h2 class="text-3xl font-bold text-white">{{ $category[1]->name }}</h2>
            </div>
          </div>
          <div class="w-full ">
            <div class=" h-52 sm:h-52 md:h-64 lg:h-72 xl:h-96 flex flex-col justify-end items-start pb-6 pl-6"
              style="background-image: url('{{ $category[2]->url_image . $category[2]->name_image }}'); background-size: cover; background-position: center;">
              <h3 class="text-base font-medium text-white">Categoría</h3>
              <h2 class="text-3xl font-bold text-white">{{ $category[2]->name }}</h2>
            </div>
          </div>
        </div>
      @elseif (count($category->take(4)) == 2)
        <div class="grid grid-cols-1 sm:grid-cols-2 px-[5%] lg:px-[7%] gap-4 pt-10">


          <div class="w-full sm:row-span-2">
            <div class=" md:h-96   flex flex-col justify-end items-start pb-6 pl-6 "
              style="background-image: url('{{ $category[0]->img }}'); background-size: cover; background-position: center;">
              <h3 class="text-base font-medium text-white">Categoría</h3>
              <h2 class="text-3xl font-bold text-white">{{ $category[0]->name }}</h2>
            </div>
          </div>
          <div class="w-full ">
            <div class=" h-96  md:h-96   flex flex-col justify-end items-start pb-6 pl-6"
              style="background-image: url('{{ $category[0]->img }}'); background-size: cover; background-position: center;">
              <h3 class="text-base font-medium text-white">Categoría</h3>
              <h2 class="text-3xl font-bold text-white">{{ $category[1]->name }}</h2>
            </div>
          </div>


        </div>
      @elseif (count($category->take(4)) == 1)
        <div class="grid grid-cols-1 px-[5%] lg:px-[7%] pb-10 mt-4">

          <div class="w-full ">
            <div class=" h-52 sm:h-52 md:h-64 lg:h-72 xl:h-96  flex flex-col justify-end items-start pb-6 pl-6"
              style="background-image: url('{{ $category[0]->img }}'); background-size: cover; background-position: center;">
              <h3 class="text-base font-medium text-white">Categoría</h3>
              <h2 class="text-3xl font-bold text-white">{{ $category[0]->name }}</h2>
            </div>
          </div>

        </div>
      @endif


    </section>


    @if (count($testimonie) > 0)
      <section>
        <div class="px-[5%] py-8 space-y-10">
          <div class="text-left  space-y-2">
            <h3 class="text-lg font-bold text-rosalasdonas">Nuestros clientes</h3>
            <h2 class="text-4xl md:text-5xl font-bold text-black">Testimonios en Flor</h2>
            <p class="text-base font-normal text-black">Clientes felices, historias encantadoras. Descubre por qué
              florecemos juntos.</p>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3  gap-6">

            @foreach ($testimonie as $item)
              <div class="space-y-4 w-full m-auto p-6 bg-griscard rounded-xl">

                <div class="flex flex-row justify-end items-end">
                  <div class="w-[80%]">
                    <h2 class="text-xl font-bold text-black">{{ $item->name }}</h2>
                    <p class="text-base font-normal text-black">Comprado el 20 de julio de 2024</p>
                  </div>
                  <div class="w-[20%]">
                    <img class="w-14 rounded-full  object-contain" src="{{ asset('img_donas/usericon.png') }}" />
                  </div>
                </div>

                <div>
                  <ul class="flex flex-row space-x-1">
                    <li><img class="rounded-full w-6" src="{{ asset('img_donas/estrellacompleta.svg') }}"> </li>
                    <li><img class="rounded-full w-6" src="{{ asset('img_donas/estrellacompleta.svg') }}"> </li>
                    <li><img class="rounded-full w-6" src="{{ asset('img_donas/estrellacompleta.svg') }}"> </li>
                    <li><img class="rounded-full w-6" src="{{ asset('img_donas/estrellacompleta.svg') }}"> </li>
                    <li><img class="rounded-full w-6" src="{{ asset('img_donas/mediaestrella.svg') }}"> </li>
                  </ul>
                </div>

                <div>
                  <p class="text-base font-normal text-black">{{ $item->testimonie }}</p>
                </div>

              </div>
            @endforeach





          </div>
        </div>

      </section>
    @endif



    <section>
      <div class="grid grid-cols-1  py-10 mt-4">

        <div class="w-full ">
          <div class="block_video h-200   flex flex-col justify-end items-start pb-[3%] pl-[5%] ">
            <div class=" flex justify-center items-center m-auto">
              <img class="rounded-full w-20" src="{{ asset('img_donas/buttonplay.svg') }}">
            </div>

            <div class="w-[60%] md:w-[40%] lg:w-[30%] space-y-4  md:absolute ">
              <h2 class="text-5xl font-bold text-white">Descubre la Magia Floral en Movimiento</h2>
              <p class="text-lg font-normal text-white">Sed ut perspiciatis unde omnis iste natus error sit voluptatem
              </p>
            </div>
          </div>
        </div>

      </div>
    </section>


    <section>
      <div class="px-[2%] md:px-[25%] pt-8 pb-12">
        <div class="text-center  space-y-5 flex flex-col items-center ">
          <h3 class="text-lg font-bold text-rosalasdonas -mb-4">Redes sociales</h3>
          <h2 class="text-5xl font-bold text-black">Únete a nuestra comunidad floral</h2>
          <p class="text-base font-normal text-black">Descubre la frescura de cada pétalo siguiéndonos.
            Síguenos para estar al tanto de nuestras últimas creaciones y ofertas exclusivas.
            Te esperamos para compartir juntos la belleza floral.</p>
          <button type="button"
            class="w-52  py-3 rounded-lg shadow-md font-medium flex items-center justify-center bg-rosalasdonas text-white   ">Regálanos
            un like<img class="ml-2" src="{{ asset('img_donas/favorite.svg') }}" /></input>
        </div>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3  lg:grid-cols-4 h-">

        @foreach (array_slice($media, 0, 4) as $item)
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
  <script></script>
  <script>
    var appUrl = '{{ env('APP_URL') }}';

    // Agrega más variables de entorno aquí según sea necesario
  </script>


  <script src="{{ asset('js/carrito.js') }}"></script>
@stop

@stop
