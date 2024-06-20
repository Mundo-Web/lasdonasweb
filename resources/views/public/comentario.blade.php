@extends('components.public.matrix')

@section('css_importados')

@stop


@section('content')

    <div class="w-full">
        <div style="background-image: url('{{ asset('images/img/header_comentar.png') }}')"
            class="bg-cover bg-center bg-no-repeat min-h-[600px]  flex flex-col justify-center items-center">
        </div>
    </div>

    <main class="my-16">



        <section class="font-poppins flex flex-col gap-5">
            <div class="w-11/12 mx-auto flex flex-col gap-3">
                <h2 class="font-medium text-[28px]">Comentarios de los usuarios</h2>
                {{-- <div class="flex items-center gap-2">
                    <div class="flex gap-2 py-2">
                        <img src="./images/svg/start.svg" alt="estrella" />
                        <img src="./images/svg/start.svg" alt="estrella" />
                        <img src="./images/svg/start.svg" alt="estrella" />
                        <img src="./images/svg/start_sin_color.svg" alt="estrella" />
                        <img src="./images/svg/start_sin_color.svg" alt="estrella" />
                    </div>
                    <p class="font-normal text-[12px] text-[#141718]">@if ($contarcomentarios = 1)
                      {{$contarcomentarios}}  Comentario
                    @else
                      {{$contarcomentarios}}  Comentarios
                    @endif</p>
                </div> --}}
            </div>

            <div class="w-11/12 mx-auto">
                <form action="{{ route('nuevocomentario') }}" method="POST">
                    @csrf
                    <div
                        class="flex flex-col gap-5 md:flex-row md:justify-between md:items-center md:border-2 md:border-[#E8ECEF] md:p-2 md:rounded-2xl">
                        <textarea placeholder="Comparte tus pensamientos" name="testimonie"
                            class="w-full border-[1px] md:border-none focus:outline-none focus:ring-0 border-gray-400 rounded-2xl py-4 px-2">{{ old('testimonie') }}</textarea>

                        <input type="submit" value="Comentar"
                            class="font-semibold text-base bg-[#74A68D] py-3 px-5 rounded-2xl text-white cursor-pointer" />
                    </div>
                </form>

                @error('testimonie')
                    <span class="text-red-500 text-base p-3">{{ $message }}</span>
                @enderror

                @if (session('mensaje'))
                    <div class="w-auto h-10 @if (session('alerta') == 2){ bg-red-400 }@else{ bg-green-600 } @endif my-5 rounded-xl text-white flex flex-row items-center pl-5">
                        {{ session('mensaje') }}
                    </div>
                @endif
            </div>

            <div class="w-11/12 mx-auto">
                <div class="flex flex-col gap-10">
                    <div class="flex flex-col md:flex-row items-start md:justify-between md:items-center gap-5">
                        <p class="font-medium text-[28px]">
                            @if ($contarcomentarios == 1)
                                {{ $contarcomentarios }} Comentario
                            @else
                                {{ $contarcomentarios }} Comentarios
                            @endif
                        </p>
                        <div class="w-full md:w-auto">
                            <div>
                                <!-- cmombo -->
                                <div class="dropdown w-full">
                                    <div class="input-box focus:outline-none font-medium text-[16px] mr-20 shadow-md px-2">
                                        Selecciona el orden
                                    </div>
                                    <div class="list">
                                        <div class="w-full">
                                            <input type="radio" name="drop1" id="id11" class="radio" />

                                            <label for="id11"
                                                class="font-normal text-text18 hover:font-bold md:duration-100 hover:text-white comentar">
                                                <span class="name inline-block w-full">Lo más reciente</span>
                                            </label>
                                        </div>

                                        <div class="w-full">
                                            <input type="radio" name="drop1" id="id12" class="radio" />
                                            <label for="id12"
                                                class="font-normal text-text18 hover:font-bold md:duration-100 hover:text-white comentar">
                                                <span class="name inline-block w-full">Lo más antiguo</span>
                                            </label>
                                        </div>   
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-10">
                        @foreach ($comentarios as $item)
                            <div class="flex flex-col md:flex-row gap-5 border-b-[1px] border-[#DDDDDD] pb-5">
                                <div class="">
                                    <img src="./images/img/perfil_user_2.png" alt="perfil" class="md:w-32 lg:w-20" />
                                </div>
                                <div class="flex flex-col gap-5">
                                    <h2 class="font-semibold text-[20px] text-[#141718]">
                                        {{ $item->name }}
                                    </h2>
                                    <div class="flex flex-col gap-1">
                                        {{-- <div class="flex gap-2 py-2">
                                        <img src="./images/svg/start.svg" alt="estrella" />
                                        <img src="./images/svg/start.svg" alt="estrella" />
                                        <img src="./images/svg/start.svg" alt="estrella" />
                                        <img src="./images/svg/start_sin_color.svg" alt="estrella" />
                                        <img src="./images/svg/start_sin_color.svg" alt="estrella" />
                                    </div> --}}
                                        <p class="font-normal text-[16px] text-[#353945]">
                                            {{ $item->testimonie }}
                                        </p>
                                    </div>
                                    <div class="flex flex-col md:flex-row gap-5 md:items-center">
                                        <span
                                            class="font-normal text-[12px] text-slate-400 inline-block">{{ $item->created_at }}
                                        </span>
                                        {{-- <div class="flex gap-5">
                                        <a href="#" class="font-semibold text-[12px] text-[#23262F]">Me gusta</a>
                                        <a href="#" class="font-semibold text-[12px] text-[#23262F]">Responder</a>
                                    </div> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex justify-center items-center">
                        {{-- <a href="#"
                            class="font-semibold text-[16px] bg-white md:duration-500 py-4 px-5 rounded-3xl border-[1px] border-colorBorder flex-initial text-center w-full md:w-56">
                            Cargar más
                        </a> --}}
                        {{$comentarios->links()}}
                    </div>
                </div>
            </div>
        </section>
    </main>

@section('scripts_importados')
    <script></script>
@stop

@stop
