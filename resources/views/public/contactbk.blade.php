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
                    <h2 class="font-semibold text-[48px] leading-none md:leading-tight">
                        Contáctanos Para Más Información
                    </h2>
                    <p class="font-normal text-[18px]">
                        Deco Tab se encuentra interesado en ti. Si deseas tener más información sobre nuestros productos y promociones, entonces completa el siguiente formulario para contactarte o ten en cuenta nuestra ubicación, número telefónico y dirección de correo electrónico.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div>
                        <img src="./images/img/sobre_nosotros.png" alt="sobre nosotros" class="w-full h-full" />
                    </div>
                    <div class="bg-[#F3F5F7] p-4 md:p-24">
                        <div class="flex flex-col justify-center items-start h-full gap-8">
                            <h2 class="font-medium text-[40px] leading-none md:leading-tight">
                                Sobre Nosotros
                            </h2>

                            <div class="flex flex-col gap-5 font-normal text-[16px]">
                                <p>
                                    @foreach ($general as $item)
                                        {{ $item->aboutus }}
                                    @endforeach
                                </p>
                            </div>
                            <div class="border-b-[2px] border-[#121212] inline-block">
                                <a href="{{route('catalogo', 0)}}" class="flex">
                                    <span class="">Comprar ahora </span>
                                    <img src="{{asset('images/svg/comprar_ahora_arrow.svg')}}" alt="comprar" />
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

<script>
    $(document).ready(function() {


      function capitalizeFirstLetter(string) {
        string = string.toLowerCase()
        return string.charAt(0).toUpperCase() + string.slice(1);
      }
    })
    $('#disminuir').on('click', function() {
      console.log('disminuyendo')
      let cantidad = Number($('#cantidadSpan span').text())
      if (cantidad > 0) {
        cantidad--
        $('#cantidadSpan span').text(cantidad)
      }


    })
    // cantidadSpan
    $('#aumentar').on('click', function() {
      console.log('aumentando')
      let cantidad = Number($('#cantidadSpan span').text())
      cantidad++
      $('#cantidadSpan span').text(cantidad)

    })
  </script>
  <script>
    let articulosCarrito = [];


    function deleteOnCarBtn(id, operacion) {
      console.log('Elimino un elemento del carrito');
      console.log(id, operacion)
      const prodRepetido = articulosCarrito.map(item => {
        if (item.id === id && item.cantidad > 0) {
          item.cantidad -= Number(1);
          return item; // retorna el objeto actualizado 
        } else {
          return item; // retorna los objetos que no son duplicados 
        }

      });
      Local.set('carrito', articulosCarrito)
      limpiarHTML()
      PintarCarrito()


    }

    function calcularTotal() {
      let articulos = Local.get('carrito')
      console.log(articulos)
      let total = articulos.map(item => {
        let monto
        if (Number(item.descuento) !== 0) {
          monto = item.cantidad * Number(item.descuento)
        } else {
          monto = item.cantidad * Number(item.precio)

        }
        return monto

      })
      const suma = total.reduce((total, elemento) => total + elemento, 0);

      $('#itemsTotal').text(`S/. ${suma} `)

    }

    function addOnCarBtn(id, operacion) {
      console.log('agrego un elemento del cvarrio');
      console.log(id, operacion)

      const prodRepetido = articulosCarrito.map(item => {
        if (item.id === id) {
          item.cantidad += Number(1);
          return item; // retorna el objeto actualizado 
        } else {
          return item; // retorna los objetos que no son duplicados 
        }

      });
      console.log(articulosCarrito)
      Local.set('carrito', articulosCarrito)
      // localStorage.setItem('carrito', JSON.stringify(articulosCarrito));
      limpiarHTML()
      PintarCarrito()


    }

    function deleteItem(id) {
      console.log('borrando elemento')
      articulosCarrito = articulosCarrito.filter(objeto => objeto.id !== id);

      Local.set('carrito', articulosCarrito)
      limpiarHTML()
      PintarCarrito()
    }

    var appUrl = <?php echo json_encode($url_env); ?>;
    console.log(appUrl);
    $(document).ready(function() {
      articulosCarrito = Local.get('carrito') || [];

      PintarCarrito();
    });

    function limpiarHTML() {
      //forma lenta 
      /* contenedorCarrito.innerHTML=''; */
      $('#itemsCarrito').html('')


    }



    function PintarCarrito() {
      console.log('pintando carrito ')

      let itemsCarrito = $('#itemsCarrito')

      articulosCarrito.forEach(element => {
        let plantilla = `<div class="flex justify-between bg-white font-poppins border-b-[1px] border-[#E8ECEF] pb-5">
            <div class="flex justify-center items-center gap-5">
              <div class="bg-[#F3F5F7] rounded-md p-4">
                <img src="${appUrl}/${element.imagen}" alt="producto" class="w-24" />
              </div>
              <div class="flex flex-col gap-3 py-2">
                <h3 class="font-semibold text-[14px] text-[#151515]">
                  ${element.producto}
                </h3>
                <p class="font-normal text-[12px] text-[#6C7275]">
                  
                </p>
                <div class="flex w-20 justify-center text-[#151515] border-[1px] border-[#6C7275] rounded-md">
                  <button type="button" onClick="(deleteOnCarBtn(${element.id}, '-'))" class="  w-8 h-8 flex justify-center items-center ">
                    <span  class="text-[20px]">-</span>
                  </button>
                  <div class="w-8 h-8 flex justify-center items-center">
                    <span  class="font-semibold text-[12px]">${element.cantidad }</span>
                  </div>
                  <button type="button" onClick="(addOnCarBtn(${element.id}, '+'))" class="  w-8 h-8 flex justify-center items-center ">
                    <span class="text-[20px]">+</span>
                  </button>
                </div>
              </div>
            </div>
            <div class="flex flex-col justify-start py-2 gap-5 items-center pr-2">
              <p class="font-semibold text-[14px] text-[#151515]">
                S/ ${Number(element.descuento) !== 0 ? element.descuento : element.precio}
              </p>
              <div class="flex items-center">
                <button type="button" onClick="(deleteItem(${element.id}))" class="  w-8 h-8 flex justify-center items-center ">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
                </button>

              </div>
            </div>
          </div>`

        itemsCarrito.append(plantilla)

      });

      calcularTotal()
    }






    $('#btnAgregarCarrito').on('click', function() {
      let url = window.location.href;
      let partesURl = url.split('/')
      let item = partesURl[partesURl.length - 1]
      let cantidad = Number($('#cantidadSpan span').text())
      item = item.replace('#', '')



      // id='nodescuento'


      $.ajax({

        url: `{{ route('carrito.buscarProducto') }}`,
        method: 'POST',
        data: {
          _token: $('input[name="_token"]').val(),
          id: item,
          cantidad

        },
        success: function(success) {
          console.log(success)
          let {
            producto,
            id,
            descuento,
            precio,
            imagen,
            color
          } = success.data
          let cantidad = Number(success.cantidad)
          let detalleProducto = {
            id,
            producto,
            descuento,
            precio,
            imagen,
            cantidad,
            color

          }
          let existeArticulo = articulosCarrito.some(item => item.id === detalleProducto.id)
          if (existeArticulo) {
            //sumar al articulo actual 
            const prodRepetido = articulosCarrito.map(item => {
              if (item.id === detalleProducto.id) {
                item.cantidad += Number(detalleProducto.cantidad);
                return item; // retorna el objeto actualizado 
              } else {
                return item; // retorna los objetos que no son duplicados 
              }

            });
          } else {
            articulosCarrito = [...articulosCarrito, detalleProducto]

          }

          Local.set('carrito', articulosCarrito)
          let itemsCarrito = $('#itemsCarrito')
          let ItemssubTotal = $('#ItemssubTotal')
          let itemsTotal = $('#itemsTotal')
          limpiarHTML()
          PintarCarrito()

        },
        error: function(error) {
          console.log(error)
        }

      })



      // articulosCarrito = {...articulosCarrito , detalleProducto }
    })
    $('#openCarrito').on('click', function() {
      console.log('abriendo carrito ');
      $('.main').addClass('blur')
    })
    $('#closeCarrito').on('click', function() {
      console.log('cerrando  carrito ');

      $('.cartContainer').addClass('hidden')
      $('#check').prop('checked', false);
      $('.main').removeClass('blur')


    })
  </script>

  <script src="{{ asset('js/storage.extend.js') }}"></script>
@stop

@stop
