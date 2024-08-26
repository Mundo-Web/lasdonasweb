<a href="{{ route('Catalogo.jsx', $item->id) }}" x-data="{ showAmbiente: false }" @mouseenter="showAmbiente = true" @mouseleave="showAmbiente = false"
  class="flex flex-col relative" data-aos="zoom-in-left">
  <div class="bg-colorBackgroundProducts rounded-sm product_container basis-4/5 flex flex-col justify-center relative">
    <div>
      <div class="relative flex justify-center items-center h-[500px] bg-cover object-cover">
        @if ($item->url_image)
          <img x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-100 scale-100" x-transition:enter-end="opacity-100 scale-105"
            x-transition:leave="transition ease-in duration-300 transform"
            x-transition:leave-start="opacity-100 scale-105" x-transition:leave-end="opacity-100 scale-100"
            :class="{ 'scale-105': showAmbiente, 'scale-100': !showAmbiente }"
            src="{{ asset($item->url_image) }}/{{ $item->name_image }}" alt="{{ $item->name }}"
            class="w-full h-full object-cover absolute inset-0 transition-transform duration-300" />
        @else
          <img x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-100 scale-100" x-transition:enter-end="opacity-100 scale-105"
            x-transition:leave="transition ease-in duration-300 transform"
            x-transition:leave-start="opacity-100 scale-105" x-transition:leave-end="opacity-100 scale-100"
            :class="{ 'scale-105': showAmbiente, 'scale-100': !showAmbiente }"
            src="{{ asset('images/img/noimagen.jpg') }}" alt="imagen_alternativa"
            class="w-full  h-full object-cover absolute inset-0 transition-transform duration-300" />
        @endif
        <span class="h4 absolute bottom-2 left-2 right-2 flex justify-start items-center text-white font-bold" style="text-shadow: 0 0 8px rgba(0, 0, 0, .25)">
          {{ $item->name }}
        </span>
      </div>
    </div>
  </div>
</a>
