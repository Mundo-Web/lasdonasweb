@extends('components.public.matrix')

@section('css_importados')

@stop


@section('content')


    <main>
        <section class="font-poppins my-12">
            {{-- <div class="flex flex-col w-11/12 mx-auto">
                <div class="flex flex-col gap-10 mt-10">
                    <div class="flex gap-1">
                        <a href="index.html" class="font-normal text-[14px] text-[#6C7275]">Home</a>
                        <span>/</span>
                        <a href="contacto.html" class="font-semibold text-[14px] text-[#141718]">Contacto</a>
                    </div>
                </div>
            </div> --}}
        </section>

        <section class="w-11/12 mx-auto">
            <div class="font-poppins text-[#151515] flex flex-col gap-16">
                <div class="md:w-8/12 flex flex-col gap-5">
                    <h1 class="font-semibold text-[48px] leading-none md:leading-tight">
                        Vestibulum molestie massa nec est hendrerit, nec commodo nulla
                    </h1>
                    <p class="font-normal text-[18px]">
                        Pellentesque convallis eu tortor id condimentum. Etiam cursus
                        semper odio non consectetur. Pellentesque et molestie risus.
                        Aliquam eu nibh pulvinar.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div>
                        <img src="./images/img/sobre_nosotros.png" alt="sobre nosotros" class="w-full h-full" />
                    </div>
                    <div class="bg-[#F3F5F7] p-4 md:p-24">
                        <div class="flex flex-col justify-center items-start h-full gap-8">
                            <h2 class="font-medium text-[40px] leading-none md:leading-tight">
                                Sobre nosotros
                            </h2>

                            <div class="flex flex-col gap-5 font-normal text-[16px]">
                                <p>
                                    @foreach ($general as $item)
                                        {{ $item->aboutus }}
                                    @endforeach
                                </p>
                            </div>
                            <div class="border-b-[2px] border-[#121212] inline-block">
                                <a href="#" class="flex">
                                    <span class="">Comprar ahora </span>
                                    <img src="./images/svg/comprar_ahora_arrow.svg" alt="comprar" />
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="w-11/12 mx-auto my-16">
            <div class="font-poppins">
                <h2 class="font-semibold text-[40px] text-center my-10 leading-none md:leading-tight">
                    Contacta Con Nosotros
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <div class="flex flex-col gap-1 justify-center items-center bg-[#F3F5F7] py-5">
                        <div class="flex justify-center items-center">
                            <img src="{{ asset('/images/svg/icon_direccion.svg') }}" alt="direccion" />
                        </div>
                        <p class="text-[#6C7275] font-bold text-[16px]">Dirección</p>
                        <p class="font-semibold text-[16px] text-[#141718]">
                            @foreach ($general as $item)
                                {{ $item->address }}
                            @endforeach
                        </p>
                        <p class="font-semibold text-[16px] text-[#141718]">
                            @foreach ($general as $item)
                                {{ $item->district }} - {{ $item->city }}
                            @endforeach
                        </p>
                    </div>

                    <div class="flex flex-col gap-1 justify-center items-center bg-[#F3F5F7] py-5">
                        <div class="flex justify-center items-center">
                            <img src="{{ asset('/images/svg/icon_celular.svg') }}" alt="celular" />
                        </div>
                        <p class="text-[#6C7275] font-bold text-[16px]">Teléfono</p>
                        <p class="font-semibold text-[16px] text-[#141718]">
                            @foreach ($general as $item)
                                {{ $item->cellphone }}
                            @endforeach
                        </p>
                        <p class="font-semibold text-[16px] text-[#141718]">
                            @foreach ($general as $item)
                                {{ $item->office_phone }}
                            @endforeach
                        </p>

                    </div>

                    <div class="flex flex-col gap-1 justify-center items-center bg-[#F3F5F7] py-5">
                        <div class="flex justify-center items-center">
                            <img src="{{ asset('/images/svg/icon_email.svg') }}" alt="email" />
                        </div>
                        <p class="text-[#6C7275] font-bold text-[16px]">Email</p>
                        <p class="font-semibold text-[16px] text-[#141718]">
                            @foreach ($general as $item)
                                {{ $item->email }}
                            @endforeach
                        </p>

                    </div>
                </div>
            </div>

            <div class="my-16 grid grid-cols-1 md:grid-cols-2 gap-16 justify-center items-center">
                <form  class="flex flex-col gap-5" id="formContactos">
                    @csrf
                    <div class="flex flex-col gap-2">
                        <label for="nombre_completo" class="font-medium text-[12px] text-[#6C7275]">Nombre</label>
                        <input id="name" type="text" placeholder="Nombre Completo" required  name="name"
                            class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl text-[#6C7275]" />
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="correo_electronico" class="font-medium text-[12px] text-[#6C7275]">Correo
                            Electrónico</label>
                        <input  type="email" placeholder="hola@gmail.com" required name="email" id="email"
                            class="w-full py-3 px-4 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-[1.5px] border-gray-200 rounded-xl" />
                    </div>

                    <div class="flex flex-col gap-2">
                        <label for="mensaje" class="font-medium text-[12px] text-[#6C7275]">Mensaje</label>
                        <textarea name="message" id="mensaje" cols="30" rows="5" 
                            class="border-gray-200 border-[1.5px] rounded-xl focus:outline-none"></textarea>
                    </div>

                    <div>
                        <input type="submit" value="Enviar Mensaje" id="btnAjax"
                            class="text-white bg-[#74A68D] py-3 rounded-2xl cursor-pointer border-2 font-semibold text-[16px] text-center border-none w-full md:w-auto px-10 inline-block" />
                    </div>
                </form>
                <div class="flex justify-center items-center">
                    <img src="{{asset('images/img/imagen_ubicacion.png')}}" alt="ubicacion" />
                </div>
            </div>
        </section>

        <section class="bg-[#F3F5F7] -mb-12">
            <div class="w-11/12 mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
                    <div class="group py-14 md:p-14">
                        <div class="pb-5 flex items-center justify-start">
                            <svg width="44" height="40" viewBox="0 0 44 40" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M26 34V10M26 34H30M26 34H16M26 10C26 5.58172 22.4183 2 18 2H10C5.58172 2 2 5.58172 2 10V26C2 29.7304 4.55333 32.8645 8.00769 33.7499M26 10H32.4182C33.4344 10 34.4126 10.3868 35.154 11.0819L40.7358 16.3148C41.5424 17.071 42 18.1273 42 19.2329V30C42 32.2091 40.2091 34 38 34M38 34C38 36.2091 36.2091 38 34 38C31.7909 38 30 36.2091 30 34M38 34C38 31.7909 36.2091 30 34 30C31.7909 30 30 31.7909 30 34M16 34C16 36.2091 14.2091 38 12 38C9.79086 38 8 36.2091 8 34C8 33.916 8.00259 33.8326 8.00769 33.7499M16 34C16 31.7909 14.2091 30 12 30C9.87484 30 8.13677 31.6573 8.00769 33.7499"
                                    stroke="#151515" stroke-width="2.5" />
                            </svg>
                        </div>
                        <div class="font-poppins text-left">
                            <h3 class="text-[#151515] font-semibold text-[24px]">
                                Envío gratis
                            </h3>
                            <p class="text-[#151515] font-normal text-[16px]">
                                compras superior a s/200
                            </p>
                        </div>
                    </div>
                    <div class="group py-14 md:p-14">
                        <div class="pb-5 flex items-center justify-start">
                            <svg width="49" height="48" viewBox="0 0 49 48" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="4.33398" y="8" width="40" height="32" rx="4" stroke="#151515"
                                    stroke-width="2.5" />
                                <circle cx="4" cy="4" r="4" transform="matrix(1 0 0 -1 20.334 28)"
                                    stroke="#151515" stroke-width="2.5" />
                                <circle cx="2" cy="2" r="2" transform="matrix(1 0 0 -1 34.334 26)"
                                    fill="white" stroke="#151515" />
                                <circle cx="2" cy="2" r="2" transform="matrix(1 0 0 -1 10.334 26)"
                                    fill="white" stroke="#151515" />
                            </svg>
                        </div>
                        <div class="font-poppins text-left">
                            <h3 class="text-[#151515] font-semibold text-[24px]">
                                Devolución de dinero
                            </h3>
                            <p class="text-[#group-hover:text-colorTextBlack] font-normal text-[16px]">
                                Garantía de 30 días
                            </p>
                        </div>
                    </div>

                    <div class="group py-14 md:p-14">
                        <div class="pb-5 flex items-center justify-start">
                            <svg width="49" height="48" viewBox="0 0 49 48" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M32.666 16H16.666M32.666 16C37.0843 16 40.666 19.5817 40.666 24V36C40.666 40.4183 37.0843 44 32.666 44H16.666C12.2477 44 8.66602 40.4183 8.66602 36V24C8.66602 19.5817 12.2477 16 16.666 16M32.666 16V12C32.666 7.58172 29.0843 4 24.666 4C20.2477 4 16.666 7.58172 16.666 12V16M24.666 32V28"
                                    stroke="#151515" stroke-width="2.5" stroke-linecap="round" />
                            </svg>
                        </div>
                        <div class="font-poppins text-left">
                            <h3 class="text-[#151515] font-semibold text-[24px]">
                                Pagos seguros
                            </h3>
                            <p class="text-[#151515] font-normal text-[16px]">
                                Asegurado por...
                            </p>
                        </div>
                    </div>

                    <div class="group py-14 md:p-14">
                        <div class="pb-5 flex items-center justify-start">
                            <svg width="48" height="48" viewBox="0 0 48 48" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M42 38V34.7081C42 33.0725 41.0042 31.6017 39.4856 30.9942L35.4173 29.3669C33.4857 28.5943 31.2844 29.4312 30.354 31.292L30 32C30 32 25 31 21 27C17 23 16 18 16 18L16.708 17.646C18.5688 16.7156 19.4057 14.5143 18.6331 12.5827L17.0058 8.51444C16.3983 6.99581 14.9275 6 13.2919 6H10C7.79086 6 6 7.79086 6 10C6 27.6731 20.3269 42 38 42C40.2091 42 42 40.2091 42 38Z"
                                    stroke="#151515" stroke-width="2.5" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <div class="font-poppins text-left">
                            <h3 class="text-[#151515] font-semibold text-[24px]">
                                Soporte 24/7
                            </h3>
                            <p class="text-[#151515] font-normal text-[16px]">
                                Soporte telefónico y por correo electrónico
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>


@section('scripts_importados')
<script>
    function alerta(message) {
        Swal.fire({
            title: message,
            icon: "error",
        });
    }

    function validarEmail(value) {
        console.log(value)
        const regex =
            /^(([^<>()\[\]\\.,;:\s@”]+(\.[^<>()\[\]\\.,;:\s@”]+)*)|(“.+”))@((\[[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}\.[0–9]{1,3}])|(([a-zA-Z\-0–9]+\.)+[a-zA-Z]{2,}))$/

        if (!regex.test(value)) {
            alerta("El campo email no es válido");
            return false;
        }
        return true;
    }

    $('#formContactos').submit(function(event) {
        // Evita que se envíe el formulario automáticamente
        //console.log('evcnto')

        event.preventDefault();
        let formDataArray = $(this).serializeArray();

        if (!validarEmail($('#email').val())) {
            return;
        };

        /* console.log(formDataArray); */
        $.ajax({
            url: '{{ route('guardarContactos') }}',
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                $('#formContactos')[0].reset();
                Swal.fire({
                    title: response.message,
                    icon: "success",
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
</script>
@stop

@stop
