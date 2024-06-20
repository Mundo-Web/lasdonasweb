{{-- <div class="flex flex-col gap-5 relative">
   
    @foreach ($productos[0]->images as $image)
        @if ($image->caratula == 1)
            <img src="{{ asset($image->name_imagen) }}" alt="{{ $image->name_imagen }}"
                class="w-full object-cover " />
        @endif
    @endforeach

    <div class="absolute top-[10px] left-[10px] md:top-[20px] md:left-[20px]">
        <div class="flex gap-3 flex-wrap">
            @foreach ($productos[0]->tags as $tag)
                <div class="bg-white  rounded-md py-1 px-2">
                    <p class="font-regularDisplay text-[8px] md:text-text16 text-textBlack ">
                        {{ $tag->name }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>

</div>

@foreach ($productos[0]->images as $image)
    @if ($image->caratula == 0 && $image->color_id == 1)
        <img src="{{ asset($image->name_imagen) }}" alt="{{ $image->name_imagen }}"
            class="w-full object-cover " />
    @endif
@endforeach --}}
{{-- <script>
    console.log(response.images);
</script> --}}