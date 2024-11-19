@php
  $maxPrice = 0;
  $componentMedio = null;

  if (isset($item->componentesHijos)) {
      foreach ($item->componentesHijos as $componente) {
          $precio = floatval($componente->precio ?? 0);
          $descuento = floatval($componente->descuento ?? 0);

          if ($descuento > 0 && $descuento > $maxPrice) {
              $maxPrice = $descuento;
          } elseif ($precio > $maxPrice) {
              $maxPrice = $precio;
          }
      }

      foreach ($item->componentesHijos as $componente) {
          if ($componente->descuento != $maxPrice || $componente->precio != $maxPrice) {
              $componentMedio = $componente;
              break;
          }
      }
  }

  $descuento = $item->descuento > 0 ? round((1 - $item->descuento / $item->precio) * 100, 0) : 0;
@endphp

<div class="flex flex-col gap-7 col-span-1 font-b_slick_bold tracking-wider">
  <!-- Tarjeta del producto -->
  <a class="rounded-xl bg-white shadow-lg overflow-hidden" href="{{ route('Product.jsx', $item->slug) }}">
    <div class="bg-[#FFF4ED] rounded-t-xl overflow-hidden relative">
      <!-- Descuento -->
      @if ($descuento > 0)
        <div
          class="absolute left-[4%] top-[4%] w-20 bg-[#ee141f] text-white text-sm shadow-lg rounded-b-xl flex justify-center items-center px-1 py-1">
          <div>{{ $descuento }}% OFF</div>
        </div>
      @endif

      <!-- Imagen -->
      @if ($item->images->isEmpty())
        <img src="{{ asset('images/img/noimagen.jpg') }}" alt="{{ $item->producto }}"
          class="w-full aspect-square object-cover hover:scale-110 transition-transform duration-300" />
      @else
        @php
          $image =
              count($item->componentesHijos) == 2
                  ? optional($componentMedio?->images->firstWhere('caratula', 1))
                  : $item->images->firstWhere('caratula', 1);
        @endphp
        <img src="{{ $image->name_imagen ? asset($image->name_imagen) : asset('images/img/noimagen.jpg') }}"
          alt="{{ $item->producto }}"
          class="w-full aspect-square object-cover hover:scale-110 transition-transform duration-300" />
      @endif
    </div>

    <!-- Detalles del producto -->
    <div class="p-4">
      <h2 class="block text-xl text-[#112212] mb-1 font-bold md:truncate">{{ $item->producto }}</h2>
      <p
        class="text-base font-normal text-[rgba(17,34,18,0.8)] line-clamp-2 text-ellipsis h-[48px] mb-1 font-b_classic_regular tracking-wide">
        {{ $item->extract }}
      </p>
      <div class="flex items-center space-x-2">
        @if ($maxPrice)
          <div class="flex gap-10">
            <div class="text-[#112212] font-bold flex flex-col">
              <span class="text-[#112212] opacity-80">Desde</span>
              <span>S/ {{ $item->descuento > 0 ? intval($item->descuento) : intval($item->precio) }}</span>
            </div>
          </div>
        @else
          <div class="text-[#112212] font-bold flex flex-col">
            <span class="text-[#112212] opacity-80">Precio</span>
            <span>S/ {{ intval($item->precio) }}</span>
          </div>
        @endif
      </div>
    </div>
  </a>

  <!-- Botón de acción -->
  <div class="w-full mt-4">
    <a id='btnespecial' href="{{ route('Product.jsx', $item->slug) }}"
      class="w-full py-3 rounded-full shadow-md font-medium flex items-center justify-center bg-[#336234] text-white text-base hover:bg-[#2d5228] transition-colors duration-300">
      <span>Ver Producto</span>
    </a>
  </div>
</div>
