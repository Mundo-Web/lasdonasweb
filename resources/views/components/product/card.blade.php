<style>
  /* From Uiverse.io by ferlagher */
  #btnespecial {
    position: relative;
    font-size: 1.2em;
    padding: 0.7em 1.4em;
    background-color: #336234;
    text-decoration: none;
    border: none;
    border-radius: 0.5em;
    color: #DEDEDE;

  }

  #btnespecial::before {
    position: absolute;
    content: '';
    height: 0;
    width: 0;
    top: 0;
    left: 0;
    background: linear-gradient(135deg, rgba(33, 33, 33, 1) 0%, rgba(33, 33, 33, 1) 50%, rgba(97, 51, 97, 1) 50%, rgba(97, 51, 97, 1) 60%);
    border-radius: 0 0 0.5em 0;
    box-shadow: 0.2em 0.2em 0.2em rgba(0, 0, 0, 0.3);
    transition: 0.3s;
  }

  #btnespecial:hover::before {
    width: 1.6em;
    height: 1.6em;
  }

  #btnespecial:active {

    transform: translate(0.1em, 0.1em);
  }
</style>
{{-- box-shadow: 0.2em 0.2em 0.3em rgba(0, 0, 0, 0.3); --}}
@php
  $maxPrice = 0;

  if (isset($item->componentesHijos)) {
      foreach ($item->componentesHijos as $componente) {
          // dump($componente->precio); // Esto imprimirá el precio en cada iteración
          if (isset($componente->precio) && floatval($componente->precio) > floatval($maxPrice)) {
              $maxPrice = floatval($componente->precio);
          }

          // $maxPrice = $maxPrice + 1;
      }
  }
@endphp
<div class="flex flex-col gap-7 col-span-1 font-b_slick_bold tracking-wider">
  <a class="rounded-xl bg-white shadow-lg overflow-hidden" href="{{ route('Product.jsx', $item->id) }}">
    <div class="bg-[#FFF4ED] rounded-t-xl overflow-hidden relative">
      @if ($item->descuento > 0)
        @php

          $descuento = round((1 - $item->descuento / $item->precio) * 100, 0);
        @endphp
        <div style="border-radius: 0px 5px 5px 5px"
          class="flex content-center justify-center absolute left-[4%] top-[4%] w-20 bg-[#ee141f] text-white text-end px-1 pt-1 text-sm shadow-lg items-center">
          <div> {{ $descuento }}% OFF</div>
        </div>
      @endif
      @if ($item->images->count() == 0)
        <img src="{{ asset('images/img/noimagen.jpg') }}" alt="{{ $item->producto }}"
          class="w-full aspect-square object-cover hover:scale-110 transition-transform duration-300" />
      @else
        @foreach ($item->images as $image)
          @if ($image->caratula == 1)
            @if ($image->name_imagen)
              <img src="{{ asset($image->name_imagen) }}" alt="{{ $image->name_imagen }}"
                class="w-full aspect-square object-cover hover:scale-110 transition-transform duration-300" />
            @break

          @else
            <img src="{{ asset('images/img/noimagen.jpg') }}" alt="{{ $item->producto }}"
              class="w-full aspect-square object-cover hover:scale-110 transition-transform duration-300" />
          @endif
        @endif
      @endforeach
    @endif
  </div>
  <div class="p-4">
    <h2 class="block text-xl text-[#112212] mb-1 font-bold truncate">{{ $item->producto }}</h2>
    <p
      class="text-base font-normal text-[rgba(17,34,18,0.8)] line-clamp-2 text-ellipsis h-[48px] mb-1 font-b_classic_regular tracking-wide">
      {{ $item->extract }}
    </p>
    <div class="flex items-center  space-x-2">
      @if ($maxPrice)
        <div class="flex gap-10">
          <div class="text-[#112212] font-bold flex flex-col">
            <span class="text-[#112212] opacity-80">Desde</span>
            <span>S/ {{ $item->precio }}</span>
          </div>
          <div class="text-[#112212] font-bold flex flex-col">
            <span class="text-[#112212] opacity-80">Hasta</span>
            <span>S/ {{ $maxPrice }}</span>
          </div>
        </div>
      @else
        <div class="text-[#112212] font-bold flex flex-col">
          <span class="text-[#112212] opacity-80">Precio</span>
          <span> S/ {{ $item->precio }}</span>
        </div>
      @endif
    </div>
  </div>
</a>
<div class="w-full mt-4">
  <a id='btnespecial' href="{{ route('Product.jsx', $item->id) }}" type="button"
    class="w-full py-3 rounded-full shadow-md font-medium flex items-center justify-center bg-[#336234] text-white text-base hover:bg-[#2d5228] transition-colors duration-300">
    <span>Ver producto</span>
    <i class="ml-2 fa-solid fa-arrow-right"></i>
  </a>
</div>
</div>
