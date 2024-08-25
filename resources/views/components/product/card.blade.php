<div class="flex flex-col gap-7 col-span-1">
  <a class="rounded-xl bg-white shadow-lg overflow-hidden" href="{{ route('Product.jsx', $item->id) }}">
    <div class="bg-[#FFF4ED] rounded-t-xl overflow-hidden">
      @if ($item->images->count() == 0)
        <img src="{{ asset('images/img/noimagen.jpg') }}" alt="{{ $item->producto }}"
          class="w-full h-[265px] object-cover hover:scale-110 transition-transform duration-300" />
      @else
        @foreach ($item->images as $image)
          @if ($image->caratula == 1)
            @if ($image->name_imagen)
              <img src="{{ asset($image->name_imagen) }}" alt="{{ $image->name_imagen }}"
                class="w-full h-[265px] object-cover hover:scale-110 transition-transform duration-300" />
            @else
              <img src="{{ asset('images/img/noimagen.jpg') }}" alt="{{ $item->producto }}"
                class="w-full h-[265px] object-cover hover:scale-110 transition-transform duration-300" />
            @endif
          @endif
        @endforeach
      @endif
    </div>
    <div class="p-4">
      <h2 class="block text-xl text-[#112212] mb-1 font-bold truncate">{{ $item->producto }}</h2>
      <p class="text-base font-normal text-[rgba(17,34,18,0.8)] line-clamp-2 text-ellipsis h-[52] mb-1">
        {{ $item->extract }}
      </p>
      <div class="flex items-center font-bold space-x-2">
        @if ($item->descuento > 0)
          <p class="text-[#112212]">S/ <span>{{ $item->descuento }}</span></p>
          <p class="text-[rgba(17,34,18,0.8)] line-through text-sm">S/ <span>{{ $item->precio }}</span></p>
        @else
          <p class="text-[#112212]">S/ <span>{{ $item->precio }}</span></p>
        @endif
      </div>
    </div>
  </a>
  <div class="w-full mt-4">
    <button type="button"
      class="w-full py-2 rounded-full shadow-md font-medium flex items-center justify-center bg-[#336234] text-white text-[13px] hover:bg-[#2d5228] transition-colors duration-300">
      <span>Agregar a mi bolsa</span>
      <i class="ms-2 fa fa-cart-plus mt-1"></i>
    </button>
  </div>
</div>
