@php
  use SoDe\Extend\Text;
@endphp

<footer class="bg-[#ff8555] p-[10%] sm:p-[7%] md:p-[5%] lg:p-[5%] font-b_slick_regular !tracking-wider">
  <div class="footer_main pb-10 border-b">
    <div class="grid grid-cols-1 sm:grid-cols-12 md:grid-cols-12 gap-7">
      <div
        class="flex flex-col justify-center items-center  sm:col-span-12 md:col-span-12 lg:col-span-4 lg:justify-start lg:items-start">
        <img class="md:w-64 lg:max-w-64" src="{{ asset('img_donas/logoblancodonas.png') }}">
      </div>

      <div class="text-white sm:col-span-3 lg:col-span-2">
        <nav>
          <h2 class="text-lg font-b_slick_bold">Sobre nosotros</h2>
          <ul class="text-base space-y-1 mt-2">
            <li>Pellentesque</li>
            <li>Suspendisse</li>
            <li>Curabitur</li>
            <li>Etiam fringilla</li>
          </ul>
        </nav>
      </div>

      <div class="text-white sm:col-span-3 lg:col-span-2">
        <nav>
          <h2 class="text-lg font-b_slick_bold">Categorías</h2>
          <ul class="text-base space-y-1 mt-2">
            @foreach ($categories as $item)
              <li>
                <a href="/catalogo/{{$item->id}}">{{Text::toTitleCase($item->name)}}</a>
              </li>
            @endforeach
          </ul>
        </nav>
      </div>


      <div class="text-white sm:col-span-3 lg:col-span-2">
        <nav>
          <h2 class="text-lg font-b_slick_bold">¿Necesitas ayuda para comprar?</h2>
          <ul class="text-base space-y-1 mt-2">
            <li>Pellentesque</li>
            <li>Suspendisse</li>
            <li>Curabitur</li>
            <li>Etiam fringilla</li>
          </ul>
        </nav>
      </div>


      <div class="text-white sm:col-span-3 lg:col-span-2">
        <nav>
          <h2 class="text-lg font-b_slick_bold">Políticas</h2>
          <ul class="text-base  space-y-1 mt-2">
            <li>Pellentesque</li>
            <li>Suspendisse</li>
          </ul>
        </nav>
      </div>

    </div>
  </div>

  <div class="footer_bottom ">

    <div class="py-10">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-7 ">
        <div class="lg:col-span-7">
          <p class="text-sm  text-white">© 2024 Las Doñas. Todos los derechos reservados. Las imágenes,
            textos y diseños
            florales son propiedad exclusiva deLas Doñas.
            Prohibida su reproducción total o parcial sin autorización previa por escrito.</p>
        </div>
        <div class="flex flex-row items-center justify-center lg:justify-end lg:col-span-5">
          <img src="{{ asset('img_donas/pagos.svg') }}" />
        </div>
      </div>
    </div>

    <div class="flex flex-row ">
      <img class="pr-3" src="{{ asset('img_donas/reclamaciones.svg') }}" />
      <p class="text-base  text-white">Libro de reclamaciones</p>
    </div>

  </div>


</footer>
