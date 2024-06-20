@extends('components.public.matrix')

@section('css_importados')

@stop


@section('content')



    <main>
        {{-- <section class="font-poppins my-12">
            <div class="flex flex-col w-11/12 mx-auto">
                <div class="flex flex-col gap-10 my-5">
                    <div class="flex gap-1">
                        <a href="index.html" class="font-normal text-[14px] text-[#6C7275]">Home</a>
                        <span>/</span>
                        <a href="#" class="font-semibold text-[14px] text-[#141718]">
                            Mi cuenta
                        </a>
                    </div>
                </div>
            </div>
        </section> --}}
        <!--  -->
        <div class="modal-mostrar z-[70]">
            <div class="modal__mostrar-info">
                <div class="w-full flex flex-col justify-center h-[500px] md:h-[700px]">
                    <div class="flex flex-col gap-5 w-full">
                        <div class="flex justify-between items-center w-full">
                            <h2 class="font-semibold text-[20px] text-[#151515]">
                                Dirección de envío
                            </h2>

                            <a href="#" class="modal__close-mostrar mr-5">
                                <img src="{{ asset('images/svg/close.svg') }}" alt="close" />
                            </a>
                        </div>

                        <div class="overflow-y-scroll h-[400px] md:h-auto md:overflow-auto flex flex-col gap-10">
                            <div class="flex flex-col gap-5">
                                <div class="flex flex-col gap-5">
                                    <div class="flex flex-col gap-2 z-[45]">
                                        <label class="font-medium text-[12px] text-[#6C7275]">Departamento</label>
                                        <div>
                                            <!-- combo -->
                                            <div class="dropdown w-full">
                                                <div
                                                    class="input-box focus:outline-none font-normal text-[16px] mr-20 text-[#6C7275] border-[1.5px] border-gray-200 rounded-xl py-3 px-4">
                                                    Selecciona un departamento
                                                </div>
                                                <div class="list overflow-y-scroll h-[200px] scroll-departamento">
                                                    <div class="w-full">
                                                        <input type="radio" name="drop1" id="id1"
                                                            class="radio" />

                                                        <label for="id1"
                                                            class="font-normal text-text18 hover:font-bold md:duration-100 hover:text-white departamento">
                                                            <span class="name inline-block w-full">Arequipa</span>
                                                        </label>
                                                    </div>

                                                    <div class="w-full">
                                                        <input type="radio" name="drop1" id="id2"
                                                            class="radio" />
                                                        <label for="id2"
                                                            class="font-normal text-text18 hover:font-bold md:duration-100 hover:text-white departamento">
                                                            <span class="name inline-block w-full">Lima</span>
                                                        </label>
                                                    </div>

                                                    <div class="w-full">
                                                        <input type="radio" name="drop1" id="id3"
                                                            class="radio" />
                                                        <label for="id3"
                                                            class="font-normal text-text18 hover:font-bold md:duration-100 hover:text-white departamento">
                                                            <span class="name inline-block w-full">Huancavelica</span>
                                                        </label>
                                                    </div>

                                                    <div class="w-full">
                                                        <input type="radio" name="drop1" id="id4"
                                                            class="radio" />
                                                        <label for="id4"
                                                            class="font-normal text-text18 hover:font-bold md:duration-100 hover:text-white departamento">
                                                            <span class="name inline-block w-full">Trujillo</span>
                                                        </label>
                                                    </div>

                                                    <div class="w-full">
                                                        <input type="radio" name="drop1" id="id5"
                                                            class="radio" />
                                                        <label for="id5"
                                                            class="font-normal text-text18 hover:font-bold md:duration-100 hover:text-white departamento">
                                                            <span class="name inline-block w-full">Huanuco</span>
                                                        </label>
                                                    </div>

                                                    <div class="w-full">
                                                        <input type="radio" name="drop1" id="id6"
                                                            class="radio" />
                                                        <label for="id6"
                                                            class="font-normal text-text18 hover:font-bold md:duration-100 hover:text-white departamento">
                                                            <span class="name inline-block w-full">Tumbes</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col gap-2 z-[40]">
                                        <label class="font-medium text-[12px] text-[#6C7275]">Provincia</label>
                                        <div>
                                            <!-- combo -->
                                            <div class="dropdown-provincia w-full">
                                                <div
                                                    class="input-box-provincia focus:outline-none font-normal text-[16px] mr-20 text-[#6C7275] border-[1.5px] border-gray-200 rounded-xl py-3 px-4">
                                                    Selecciona una provincia
                                                </div>
                                                <div class="list-provincia overflow-y-scroll h-[200px] scroll-provincia">
                                                    <div class="w-full">
                                                        <input type="radio" name="drop2" id="id7"
                                                            class="radio-provincia" />

                                                        <label for="id7"
                                                            class="font-normal text-text18 hover:font-bold md:duration-100 hover:text-white provincia">
                                                            <span
                                                                class="name-provincia inline-block w-full">Provincia1</span>
                                                        </label>
                                                    </div>

                                                    <div class="w-full">
                                                        <input type="radio" name="drop2" id="id8"
                                                            class="radio-provincia" />

                                                        <label for="id8"
                                                            class="font-normal text-text18 hover:font-bold md:duration-100 hover:text-white provincia">
                                                            <span class="name-provincia inline-block w-full">Arequipa</span>
                                                        </label>
                                                    </div>

                                                    <div class="w-full">
                                                        <input type="radio" name="drop2" id="id9"
                                                            class="radio-provincia" />

                                                        <label for="id9"
                                                            class="font-normal text-text18 hover:font-bold md:duration-100 hover:text-white provincia">
                                                            <span class="name-provincia inline-block w-full">Arequipa</span>
                                                        </label>
                                                    </div>

                                                    <div class="w-full">
                                                        <input type="radio" name="drop2" id="id10"
                                                            class="radio-provincia" />

                                                        <label for="id10"
                                                            class="font-normal text-text18 hover:font-bold md:duration-100 hover:text-white provincia">
                                                            <span
                                                                class="name-provincia inline-block w-full">Arequipa</span>
                                                        </label>
                                                    </div>

                                                    <div class="w-full">
                                                        <input type="radio" name="drop2" id="id11"
                                                            class="radio-provincia" />

                                                        <label for="id11"
                                                            class="font-normal text-text18 hover:font-bold md:duration-100 hover:text-white provincia">
                                                            <span
                                                                class="name-provincia inline-block w-full">Arequipa</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col gap-2 z-[30]">
                                        <label class="font-medium text-[12px] text-[#6C7275]">Distrito</label>

                                        <div>
                                            <!-- combo -->
                                            <div class="dropdown-distrito w-full">
                                                <div
                                                    class="input-box-distrito focus:outline-none font-normal text-[16px] mr-20 text-[#6C7275] border-[1.5px] border-gray-200 rounded-xl py-3 px-4">
                                                    Selecciona un distrito
                                                </div>
                                                <div class="list-distrito overflow-y-scroll h-[200px] scroll-distrito">
                                                    <div class="w-full">
                                                        <input type="radio" name="drop3" id="id12"
                                                            class="radio-distrito" />

                                                        <label for="id12"
                                                            class="font-normal text-text18 hover:font-bold md:duration-100 hover:text-white distrito">
                                                            <span class="name-distrito inline-block w-full">Distrito
                                                                1</span>
                                                        </label>
                                                    </div>

                                                    <div class="w-full">
                                                        <input type="radio" name="drop3" id="id13"
                                                            class="radio-distrito" />

                                                        <label for="id13"
                                                            class="font-normal text-text18 hover:font-bold md:duration-100 hover:text-white distrito">
                                                            <span class="name-distrito inline-block w-full">Arequipa</span>
                                                        </label>
                                                    </div>

                                                    <div class="w-full">
                                                        <input type="radio" name="drop3" id="id14"
                                                            class="radio-distrito" />

                                                        <label for="id14"
                                                            class="font-normal text-text18 hover:font-bold md:duration-100 hover:text-white distrito">
                                                            <span class="name-distrito inline-block w-full">Arequipa</span>
                                                        </label>
                                                    </div>

                                                    <div class="w-full">
                                                        <input type="radio" name="drop3" id="id15"
                                                            class="radio-distrito" />

                                                        <label for="id15"
                                                            class="font-normal text-text18 hover:font-bold md:duration-100 hover:text-white distrito">
                                                            <span class="name-distrito inline-block w-full">Arequipa</span>
                                                        </label>
                                                    </div>

                                                    <div class="w-full">
                                                        <input type="radio" name="drop3" id="id16"
                                                            class="radio-distrito" />

                                                        <label for="id16"
                                                            class="font-normal text-text18 hover:font-bold md:duration-100 hover:text-white distrito">
                                                            <span class="name-distrito inline-block w-full">Arequipa</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex flex-col gap-2">
                                        <label for="nombre_calle" class="font-medium text-[12px] text-[#6C7275]">Avenida
                                            / Calle / Jirón</label>
                                        <input id="nombre_calle" type="text"
                                            placeholder="Ingresa el nombre de la calle"
                                            class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl" />
                                    </div>
                                </div>
                                <div>
                                    <div class="flex flex-col md:flex-row gap-5">
                                        <div class="basis-1/2 flex flex-col gap-2">
                                            <label for="numero_calle"
                                                class="font-medium text-[12px] text-[#6C7275]">Número</label>
                                            <input id="numero_calle" type="text"
                                                placeholder="Ingresa el número de la callle"
                                                class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl" />
                                        </div>

                                        <div class="basis-1/2 flex flex-col gap-2">
                                            <label for="direccion" class="font-medium text-[12px] text-[#6C7275]">Dpto./
                                                Interior/ Piso/ Lote/ Bloque
                                                (opcional)</label>
                                            <input id="direccion" type="text" placeholder="Ejem. Casa 3, Dpto 101"
                                                class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col md:flex-row gap-5 w-full">
                                <input type="submit" value="Guardar cambios"
                                    class="text-white bg-bgBlack py-3 rounded-2xl cursor-pointer border-2 font-semibold text-[16px] text-center border-none inline-block w-full" />

                                <input type="submit" value="Cancelar"
                                    class="text-[#151515] py-3 rounded-2xl cursor-pointer font-semibold text-[16px] text-center inline-block border-[1px] border-[#151515] w-full" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  -->




        <section class="font-poppins my-8">
            <div class="flex flex-col gap-12 md:flex-row md:gap-4 w-full md:w-11/12 mx-auto">
                <!-- Sidebar -->
                <div class="bg-[#F3F5F7] md:bg-white py-5 md:py-0">
                    <div class="w-11/12 md:w-full mx-auto">
                        <div class="basis-5/12 flex flex-col gap-5">
                            <div class="flex flex-col gap-5">
                                <div class="rounded-full w-24 h-24 bg-[#E9EDEF] flex justify-center items-center relative">
                                    <img class="w-full h-full rounded-full" src="{{ Auth::user()->profile_photo_url }}"
                                        width="32" height="32" alt="{{ Auth::user()->name }}" />
                                    <label for="upload_image"
                                        class="bg-bgBlack rounded-full w-7 h-7 flex justify-center items-center absolute bottom-0 right-0 cursor-pointer">
                                        <img src="{{ asset('/images/svg/upload_photo.svg') }}" alt="upload photo" />
                                    </label>
                                    <form action="{{ route('cambiofoto') }}" id="avatarform" method="POST"
                                        enctype='multipart/form-data'>
                                        @csrf
                                        <input type="hidden" name="name" value="{{ $user->id }}">
                                        <input type="file" id="upload_image" name="imageuser" accept="image/*"
                                            class="hidden" />
                                    </form>
                                </div>

                                <div>
                                    <p class="font-semibold text-[14px] text-[#0A3054]">
                                        {{ $user->name }}
                                    </p>

                                    <p class="font-medium text-[12px] text-[#8896A8]">
                                        {{ $user->email }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex flex-col gap-4 ">
                                <a class="group" href="{{ route('micuenta') }}">
                                    <div
                                        class="text-white group-hover:bg-bgBlack py-2 px-4 rounded-2xl cursor-pointer text-[16px] border-none w-64 flex justify-between items-center">
                                        <p class="font-medium text-[16px] text-[#254678] group-hover:text-white">
                                            Mi cuenta
                                        </p>
                                        <span>
                                            <svg width="20" height="20" viewBox="0 0 14 13" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M0.332031 6.50048C0.332031 2.93378 3.3187 0.0390626 6.9987 0.0390628C10.6787 0.039063 13.6654 2.93378 13.6654 6.50048C13.6654 10.0672 10.6787 12.9619 6.9987 12.9619C3.3187 12.9619 0.332031 10.0672 0.332031 6.50048ZM8.76536 6.27433L6.90536 4.47159C6.69203 4.26483 6.33203 4.40698 6.33203 4.69774L6.33203 8.30967C6.33203 8.60044 6.69203 8.74259 6.8987 8.53582L8.7587 6.73309C8.89203 6.60386 8.89203 6.39709 8.76536 6.27433Z"
                                                    fill="#E9EDEF" />
                                            </svg>
                                        </span>
                                    </div>
                                </a>
                                <a class="group" href="{{ route('direccion') }}">
                                    <div
                                        class="text-white bg-bgBlack py-2 px-4 rounded-2xl cursor-pointer text-[16px] border-none w-64 flex justify-between items-center group-hover:bg-bgBlack">
                                        <p class="font-medium text-[16px] text-white">
                                            Dirección
                                        </p>
                                        <span>
                                            <svg width="20" height="20" viewBox="0 0 14 13" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M0.332031 6.50048C0.332031 2.93378 3.3187 0.0390626 6.9987 0.0390628C10.6787 0.039063 13.6654 2.93378 13.6654 6.50048C13.6654 10.0672 10.6787 12.9619 6.9987 12.9619C3.3187 12.9619 0.332031 10.0672 0.332031 6.50048ZM8.76536 6.27433L6.90536 4.47159C6.69203 4.26483 6.33203 4.40698 6.33203 4.69774L6.33203 8.30967C6.33203 8.60044 6.69203 8.74259 6.8987 8.53582L8.7587 6.73309C8.89203 6.60386 8.89203 6.39709 8.76536 6.27433Z"
                                                    fill="#EEEEEE" />
                                            </svg>
                                        </span>
                                    </div>
                                </a>
                                <a class="group" href="{{ route('pedidos') }}">
                                    <div
                                        class="text-white py-2 px-4 rounded-2xl cursor-pointer text-[16px] border-none w-64 flex justify-between items-center group-hover:bg-bgBlack">
                                        <p class="font-medium text-[16px] text-[#254678] group-hover:text-white">
                                            Historial de pedidos
                                        </p>
                                        <span>
                                            <svg width="20" height="20" viewBox="0 0 14 13" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M0.332031 6.50048C0.332031 2.93378 3.3187 0.0390626 6.9987 0.0390628C10.6787 0.039063 13.6654 2.93378 13.6654 6.50048C13.6654 10.0672 10.6787 12.9619 6.9987 12.9619C3.3187 12.9619 0.332031 10.0672 0.332031 6.50048ZM8.76536 6.27433L6.90536 4.47159C6.69203 4.26483 6.33203 4.40698 6.33203 4.69774L6.33203 8.30967C6.33203 8.60044 6.69203 8.74259 6.8987 8.53582L8.7587 6.73309C8.89203 6.60386 8.89203 6.39709 8.76536 6.27433Z"
                                                    fill="#E9EDEF" />
                                            </svg>
                                        </span>
                                    </div>
                                </a>
                                <form method="POST" action="{{ route('logout') }}" x-data class="group">
                                    @csrf
                                    <button type="submit" href="{{ route('logout') }}"
                                        class="rounded-2xl bg-[#F3F5F7] md:bg-[#FCFCFC] group-hover:bg-bgBlack  group-hover:text-white text-[#151515] font-medium text-[16px] py-3 px-4 flex justify-between items-center w-64 mt-0 md:mt-[200px]">
                                        <span>Cerrar Sesión</span>
                                        <svg width="20" height="18" viewBox="0 0 14 13" fill="none">
                                            <path class="group-hover:stroke-white"
                                                d="M4.8533 0.900391H2.38271C2.00829 0.900391 1.6492 1.04789 1.38444 1.31044C1.11969 1.57299 0.970947 1.92909 0.970947 2.30039V10.7004C0.970947 11.0717 1.11969 11.4278 1.38444 11.6903C1.6492 11.9529 2.00829 12.1004 2.38271 12.1004H4.8533M5.02876 6.50039H13.0288M13.0288 6.50039L9.97199 3.30039M13.0288 6.50039L9.97199 9.70039"
                                                stroke="#151515" stroke-width="1.33333" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sidebar -->

                <!-- Address -->
                <div class="basis-9/12 font-poppins w-11/12 md:w-full mx-auto">
                    <form method="POST" id="direccionForm">
                        @csrf
                        <div class="w-full flex flex-col justify-center">
                            <div class="flex flex-col gap-5 w-1/2">
                                <div class="flex justify-between items-center w-full">
                                    <h2 class="font-semibold text-[20px] text-[#151515]">
                                        Agregar dirección de envío
                                    </h2>
                                </div>
                            </div>
                            <div class="flex flex-col lg:flex-row  gap-5 mt-6">
                                <div class="flex flex-col gap-5 w-full lg:w-1/2">

                                    <div class="flex flex-col gap-5">
                                        <div class="flex flex-col gap-2 z-[45]">
                                            <label class="font-medium text-[12px] text-[#6C7275]">Departamento</label>
                                            <div>
                                                <!-- combo -->
                                                <div class="dropdown w-full">
                                                    <select name="departamento_id" id="selectDepartamento"
                                                        class="w-full focus:outline-none font-normal text-[16px] mr-20 text-[#6C7275] border-[1.5px] border-gray-200 rounded-xl py-3 px-4">
                                                        <option value="">Seleccionar un Departamento </option>
                                                        @foreach ($departamentofiltro as $item)
                                                            <option value="{{ $item->id }}">{{ $item->description }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="flex flex-col gap-2 z-[40]">
                                            <label class="font-medium text-[12px] text-[#6C7275]">Provincia</label>
                                            <div>
                                                <!-- combo -->
                                                <div class="dropdown-provincia w-full">
                                                    <select name="provincia_id" id="selectProvincia"
                                                        class="w-full focus:outline-none font-normal text-[16px] mr-20 text-[#6C7275] border-[1.5px] border-gray-200 rounded-xl py-3 px-4">
                                                        <option value="">Seleccionar provincias </option>
                                                        {{-- @foreach ($provincias as $item)
                                                            <option value="{{ $item->id }}">{{ $item->description }}
                                                            </option>
                                                        @endforeach --}}

                                                    </select>

                                                </div>

                                            </div>
                                        </div>

                                        <div class="flex flex-col gap-2 z-[30]">
                                            <label class="font-medium text-[12px] text-[#6C7275]">Distrito</label>

                                            <div>
                                                <!-- combo -->
                                                <div class="dropdown-distrito w-full">
                                                    <select name="distrito_id" id="selectDistrito"
                                                        class="w-full focus:outline-none font-normal text-[16px] mr-20 text-[#6C7275] border-[1.5px] border-gray-200 rounded-xl py-3 px-4">
                                                        <option value="">Seleccionar distritos </option>
                                                        {{-- @foreach ($distritos as $item)
                                                            <option value="{{ $item->id }}">{{ $item->description }}
                                                            </option>
                                                        @endforeach --}}

                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-col gap-5 w-full lg:w-1/2">

                                    <div class="flex flex-col gap-5">

                                        <div class="basis-1/2 flex flex-col gap-2">
                                            <label for="nombre_calle"
                                                class="font-medium text-[12px] text-[#6C7275]">Avenida
                                                / Calle / Jirón</label>
                                            <input id="nombre_calle" type="text" name="nombre_calle"
                                                placeholder="Ingresa el nombre de la calle"
                                                class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl" />
                                        </div>

                                        <div class="basis-1/2 flex flex-col gap-2">
                                            <label for="numero_calle"
                                                class="font-medium text-[12px] text-[#6C7275]">Número</label>
                                            <input id="numero_calle" type="text" name="numero_calle"
                                                placeholder="Ingresa el número de la callle"
                                                class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl" />
                                        </div>


                                        <div class="basis-1/2 flex flex-col gap-2">
                                            <label for="direccion" class="font-medium text-[12px] text-[#6C7275]">Dpto./
                                                Interior/ Piso/ Lote/ Bloque
                                                (opcional)</label>
                                            <input id="direccion" type="text" name="direccion"
                                                placeholder="Ejem. Casa 3, Dpto 101"
                                                class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl" />
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="flex flex-col md:flex-row gap-5 w-full mt-6">
                            <input type="submit" value="Guardar cambios"
                                class="text-white bg-bgBlack py-3 rounded-2xl cursor-pointer border-2 font-semibold text-[16px] text-center border-none inline-block w-full" />
                        </div>
                    </form>

                    <h2 class="text-[#151515] font-semibold text-[20px] mb-5 mt-6">
                        Mis direcciones
                    </h2>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 lg:gap-10">
                        @foreach ($direcciones as $item)
                            <div class="basis-1/2 border-[1px] border-slate-400 rounded-lg p-4 flex flex-col gap-1">
                                <div class="flex justify-between items-center">
                                    <p class="font-semibold text-[16px] text-[#000000]">
                                        Dirección de Envío
                                    </p>
                                    <p class="flex justify-between items-center cursor-pointer gap-1 mostrar-mas">
                                        <img src="{{ asset('/images/svg/edit.svg') }}" alt="editar" />
                                        <span class="font-semibold text-[16px] text-[#EB5D2C]">
                                            Editar
                                        </span>
                                    </p>
                                </div>
                                <div class="flex justify-between items-center relative">
                                    <div>
                                        <p class="font-normal text-[14px] text-[#000000]">
                                            {{ $item->dir_av_calle }}
                                        </p>
                                        <p class="font-normal text-[14px] text-[#000000]">
                                            {{ $item->distrito_id }}
                                        </p>
                                        <p class="font-normal text-[14px] text-[#000000]">
                                            {{ $item->provincia_id }} - {{ $item->departamento_id }}, Perú
                                        </p>
                                    </div>
                                    <div class="absolute bottom-0 right-0" id="favorite">
                                        @if ($item->favorite == 1)
                                            <a data-id="{{$item->id}}" data-favorite="{{ $item->favorite }}">
                                                <img src="{{ asset('images/svg/estrellaamarilla.svg') }}" />
                                            </a>
                                        @else
                                           
                                            <a class="favorite-star cursor-pointer" data-id="{{$item->id}}" data-favorite="{{ $item->favorite }}">
                                                <img src="{{ asset('images/svg/estrellablanca.svg') }}" />
                                            </a>
                                         
                                        @endif

                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
                <!-- Address -->
            </div>
        </section>


    </main>


@section('scripts_importados')
    <script>
        $(document).ready(function() {
            $('.favorite-star').on('click', function(e) {
                e.preventDefault(); 

                var favoriteStatus = $(this).data('favorite'); 
                var itemId = $(this).data('id'); 

                $.ajax({
                    type: 'POST',
                    url: '{{ route('direccionFavorita') }}',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'id': itemId,
                        'favorite': favoriteStatus
                    },
                    success: function(response) {
                        console.log(response);
                        Swal.fire({
                            title: response.message,
                            icon: "success",
                        }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload(); 
                        }
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
    <script>
        const checkbox = document.getElementById("check");
        const bag = document.querySelector(".bag");
        const bodyModalCarrito = document.querySelector(".body");
        let isMenuOpen = false; // Variable para controlar el estado del menú
        const card = document.querySelector(".cartContainer");
        checkbox.addEventListener("click", checkboxOnClick);

        // Agregar event listener al checkbox para controlar el estado del menú
        function checkboxOnClick() {
            // Cambiar el top del carrito
            const scrollTopPosition = window.scrollY;
            card.style.top = scrollTopPosition + "px";

            isMenuOpen = checkbox.checked;
            if (isMenuOpen) {
                bodyModalCarrito.classList.add("dark");
                bodyModalCarrito.classList.add("overflow-hidden");
                // Agregar el event listener al documento cuando se abre el menú
                document.addEventListener("click", handleDocumentClick);
            } else {
                bodyModalCarrito.classList.remove("dark");
                bodyModalCarrito.classList.remove("overflow-hidden");
                // Quitar el event listener del documento cuando se cierra el menú
                document.removeEventListener("click", handleDocumentClick);
            }
        }

        // Función para manejar el clic en el documento
        function handleDocumentClick(event) {
            // Verificar si el menú está abierto y si el clic no ocurrió dentro del nav ni en el checkbox
            if (isMenuOpen && !bag.contains(event.target) && event.target !== checkbox) {
                bag.classList.add("hidden"); // Ocultar el nav
                checkbox.checked = false; // Desmarcar el checkbox
                bodyModalCarrito.classList.remove("dark");
                bodyModalCarrito.classList.remove("overflow-hidden");
                isMenuOpen = false; // Actualizar el estado del menú
                // Quitar el event listener del documento después de cerrar el menú
                document.removeEventListener("click", handleDocumentClick);
            }
        }

        // Detener la propagación de clics dentro del nav para evitar cerrarlo al hacer clic dentro
        bag.addEventListener("click", function(event) {
            event.stopPropagation(); // Evitar que el clic se propague al documento
        });


        $("#upload_image").change(function() {

            const file = this.files[0];

            if (file) {
                const formData = new FormData();
                formData.append('image', file);
                formData.append('_token', $('#avatarform input[name="_token"]').val());
                formData.append('id', $('#avatarform input[name="name"]').val());
                $.ajax({

                    url: "{{ route('cambiofoto') }}",
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,

                    success: function(success) {
                        window.location.href = window.location.href;

                    },
                    error: function(error) {
                        console.log(error)
                    }

                })
            }

        });



        const openModal = document.querySelectorAll(".mostrar-mas");
        const modal = document.querySelector(".modal-mostrar");
        const closeModal = document.querySelectorAll(".modal__close-mostrar");
        const body = document.querySelector(".body");

        openModal.forEach((open) => {
            open.addEventListener("click", (e) => {
                e.preventDefault();

                modal.classList.add("modal--show");
                body.classList.add("overflow-hidden");
                modal.style.display = "flex";
            });
        });

        closeModal.forEach((close) => {
            close.addEventListener("click", (e) => {
                e.preventDefault();
                modal.classList.remove("modal--show");
                body.classList.remove("overflow-hidden");
            });
        });

        // Función para cerrar el modal
        function closeModa(event) {
            // console.log(event.target);
            if (event.target === modal) {
                modal.classList.remove("modal--show");
                body.classList.remove("overflow-hidden");
            }
        }

        window.addEventListener("click", closeModa);
    </script>

    <script>
        $(document).ready(function() {
            $('#selectDepartamento').change(function() {
                var departmentId = $(this).val();
                if (departmentId) {
                    $.ajax({
                        url: '/obtenerProvincia/' + departmentId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#selectProvincia').prop('disabled', false).empty().append(
                                '<option value="">Selecciona una provincia</option>');
                            $.each(data, function(key, value) {
                                $('#selectProvincia').append('<option value="' + value
                                    .id +
                                    '">' + value.description + '</option>');
                            });
                            $('#selectDistrito').prop('disabled', true).empty().append(
                                '<option value="">Selecciona un distrito</option>');
                        }
                    });
                } else {
                    $('#selectProvincia').prop('disabled', true).empty().append(
                        '<option value="">Selecciona una provincia</option>');
                    $('#selectDistrito').prop('disabled', true).empty().append(
                        '<option value="">Selecciona un distrito</option>');
                }
            });

            $('#selectProvincia').change(function() {
                var provinceId = $(this).val();
                if (provinceId) {
                    $.ajax({
                        url: '/obtenerDistritos/' + provinceId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#selectDistrito').prop('disabled', false).empty().append(
                                '<option value="">Selecciona un distrito</option>');
                            $.each(data, function(key, value) {
                                $('#selectDistrito').append('<option value="' + value
                                    .id +
                                    '">' + value.description + '</option>');
                            });
                        }
                    });
                } else {
                    $('#selectDistrito').prop('disabled', true).empty().append(
                        '<option value="">Selecciona un distrito</option>');
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            $('#direccionForm').submit(function(event) {

                event.preventDefault();

                $.ajax({
                    url: '{{ route('guardar.direccion') }}',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#direccionForm')[0].reset();
                        Swal.fire({
                            title: response.message,
                            icon: "success",
                        }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.reload(); 
                        }
                        });
                    },
                    error: function(error) {
                        const obj = error.responseJSON.message;
                        const keys = Object.keys(error.responseJSON.message);
                        let flag = false;
                        keys.forEach(key => {
                            if (!flag) {
                                const e = obj[key][0];
                                Swal.fire({
                                    title: error.message,
                                    text: e,
                                    icon: "error",
                                });
                                flag = true; // Marcar como mostrado
                            }
                        });
                    }
                });
            })

        });
    </script>
@stop

@stop
