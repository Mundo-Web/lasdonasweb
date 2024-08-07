@extends('components.public.matrix')
@section('css_importados')
@stop
@section('content')
  <?php
  
  function capitalizeFirstLetter($string)
  {
      return ucfirst($string);
  }
  ?>

  <style>
    /* Estilo por defecto del SVG */
    .svg-icon {
      fill: #d1d5db;
      /* Color por defecto */
    }

    /* Cambiar el color cuando el radio esté seleccionado */
    .radio-option:checked~.radio-option-label .svg-icon {
      fill: #df3876;
      /* Nuevo color */
    }
  </style>

  <main class="flex flex-col gap-12 mt-12">
    <section>

      <div class="grid grid-cols-1 lg:grid-cols-2 px-[5%] lg:px-[7%] gap-5 lg:gap-10 pt-10">

        <div class="grid grid-cols-2 sm:grid-cols-3  gap-8 " id="containerImagenesP">

          @if ($productos->images->count() > 0)
            {{-- Verifica si hay imágenes antes del foreach --}}
            @foreach ($productos->images as $image)
              @if ($image->caratula == 1)
                <div class="col-span-2 sm:col-span-3 relative ">
                  <img id="imagePreview" src="#" alt="Image preview"
                    class="h-24 w-36 absolute bottom-[8%] right-[25%] rounded-lg shadow-2xl object-cover rotate-12"
                    style="display: none;" />
                  <img class="size-full object-cover"
                    src="{{ $image->name_imagen ? asset($image->name_imagen) : asset('images/img/noimagen.jpg') }}" />
                </div>


                {{-- Añade un break para detener el bucle después de encontrar la carátula --}}
              @endif
            @endforeach
          @else
            <img class="size-full object-cover " src="{{ asset('images/img/noimagen.jpg') }}" />
          @endif

          {{-- agregar el swipper --}}

          <div class="col-span-3 h-full" data-aos="fade-up" data-aos-offset="150">
            <!-- Asegúrate de que este div tome todo el alto disponible -->
            <div class="swiper img-complementarias h-full"> <!-- Asegura que el swiper tome todo el alto -->
              <div class="swiper-wrapper gap-2 h-full"> <!-- Asegura que el wrapper tome todo el alto -->
                @foreach ($productos->images as $image)
                  <div class="swiper-slide w-full h-full"> <!-- Asegura que cada slide tome todo el alto -->
                    <div class="flex gap-2 items-center justify-start h-full">
                      <!-- Asegura que este div tome todo el alto -->
                      <div class="flex justify-center items-center h-full">
                        <!-- Asegura que este div tome todo el alto -->
                        @if ($image->caratula !== 1)
                          {{-- Verifica si la imagen no es la carátula --}}
                          <img class="size-full object-cover h-full w-full"
                            src="{{ $image->name_imagen ? asset($image->name_imagen) : asset('images/img/noimagen.jpg') }}" />
                        @endif
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>





        </div>


        <div>

          <h2 class="text-4xl md:text-5xl font-bold text-black pb-8">{{ $productos->producto }}</h2>
          <p class="text-2xl  font-bold text-black pb-6">Paso 1: Selecciona un horario</p>
          <div class="flex flex-row justify-between  gap-3 md:gap-7 lg:gap-5 xl:gap-7 pb-8">

            <div
              class="flex flex-col justify-center items-center text-rosalasdonas text-center w-1/3 border-rosalasdonas border-2 p-3 rounded-xl">
              <p class="text-lg font-bold">Hoy</p>
              <p class="text-sm font-normal">No disponible</p>
            </div>

            <div
              class="flex flex-col justify-center items-center text-rosalasdonas text-center w-1/3 border-rosalasdonas border-2 p-3 rounded-xl">
              <p class="text-lg font-bold">Mañana</p>
              <p class="text-sm font-normal">07 de Enero de 2024 </p>
            </div>

            <div
              class="flex flex-col justify-center items-center text-rosalasdonas text-center w-1/3 border-rosalasdonas border-2 p-3 rounded-xl ">
              <p class="text-lg font-bold m-auto">Más fechas</p>
            </div>

          </div>

          <p class="text-2xl  font-bold text-black pb-6">Paso 2: Elige tu opcion favorita</p>
          {{-- colocarlo por precios  --}}


          <div class="flex flex-row justify-between  gap-3 md:gap-7 lg:gap-5 xl:gap-7 pb-8">
            <ul class="grid w-full gap-6 md:grid-cols-3">
              <li>
                <input type="radio" id="react-option" name="framework" value="{{ $tipoDefault->name }}"
                  class="hidden peer radio-option" required="">
                <label for="react-option"
                  class="radio-option-label inline-flex items-center justify-between w-full p-5 text-rosalasdonas  border-2 border-gray-300 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-4 peer-checked:border-[#df3876] hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">

                  <div class="flex flex-col justify-center items-center">
                    @if ($tipoDefault->name == 'Premium')
                      {{-- <img src="{{ asset('img_donas/premiun.svg') }}" /> --}}
                      <x-svgFlorPremium class="svg-icon" />
                    @elseif ($tipoDefault->name == 'Deluxe')
                      <x-svgFlorDeluxe class="svg-icon" />
                      {{-- <img src=" {{ asset('img_donas/deluxe.svg') }}" /> --}}
                    @else
                      {{-- <img src=" {{ asset('img_donas/clasico.svg') }}" /> --}}
                      <x-svgFlorClasic class="svg-icon" />
                    @endif
                  </div>

                  <div class="flex flex-col justify-center items-center">
                    <p class="text-base font-semibold">{{ $tipoDefault->name }}</p>
                    <p class="text-base font-normal">S/ <span>{{ $productos->precio }}</span></p>
                    <p class="text-base font-bold">S/ <span>{{ $productos->descuento }}</span></p>
                  </div>
                </label>
              </li>
              @foreach ($subproductos as $item)
                <li>
                  <input type="radio" id="{{ $item->tipos->name }}-option" name="framework"
                    value="{{ $item->tipos->name }}" class="hidden peer radio-option">
                  <label for="{{ $item->tipos->name }}-option"
                    class="radio-option-label inline-flex items-center justify-between w-full p-5 text-rosalasdonas  border-2 border-gray-300 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 peer-checked:border-4 peer-checked:border-[#df3876] hover:text-gray-600 dark:peer-checked:text-gray-300 peer-checked:text-gray-600 hover:bg-gray-50 dark:text-gray-400 dark:bg-gray-800 dark:hover:bg-gray-700">
                    <div class="flex flex-col justify-center items-center">
                      @if ($item->tipos->name == 'Premium')
                        {{-- <img src="{{ asset('img_donas/premiun.svg') }}" /> --}}
                        <x-svgFlorPremium class="svg-icon" />
                      @elseif ($item->tipos->name == 'Deluxe')
                        <x-svgFlorDeluxe class="svg-icon" />
                        {{-- <img src=" {{ asset('img_donas/deluxe.svg') }}" /> --}}
                      @else
                        {{-- <img src=" {{ asset('img_donas/clasico.svg') }}" /> --}}
                        <x-svgFlorClasic class="svg-icon" />
                      @endif
                    </div>

                    <div class="flex flex-col justify-center items-center">
                      <p class="text-base font-semibold">{{ $item->tipos->name }}</p>
                      <p class="text-base font-normal">S/ <span>{{ $item->precio }}</span></p>
                      <p class="text-base font-bold">S/ <span>{{ $item->descuento }}</span></p>
                    </div>
                  </label>
                </li>
              @endforeach


            </ul>

          </div>

          <p class="text-2xl  font-bold text-black pb-2">Paso 3: Personalizar</p>
          <p class="text-lg  font-normal text-black pb-4 ">Personaliza con una foto:</p>


          <div class="flex items-center justify-center w-full pb-8">
            <label for="dropzone-file"
              class="flex flex-col items-center justify-center w-full py-3 border-2 border-rosalasdonas border-dashed rounded-lg cursor-pointer bg-white">
              <div class="flex flex-col items-center justify-center pt-5 pb-6">
                <img src="{{ asset('img_donas/image-up.svg') }}" />
                <p class="mb-2 text-base text-rosalasdonas text-center"><span>Agregar fotografía</span> <br> o <br>
                  Arrastre aquí su fotografía</p>

                <p></p>

              </div>
              <input id="dropzone-file" type="file" class="hidden" />
            </label>
          </div>









        </div>

      </div>

    </section>
    <section class="px-[5%] pt-2 pb-0 ">
      <p class="text-2xl  font-bold text-black pb-2">Complementar al pedido (opcional)</p>
      <ul class="grid w-full gap-6 grid-cols-1 md:grid-cols-6">
        @foreach ($complementos as $item)
          <li class="m-auto">
            <label for="react-option-{{ $item->id }}"
              class="inline-flex items-center justify-between w-full  bg-white  rounded-lg cursor-pointer  ">
              <div class="block relative">
                <input type="checkbox" id="react-option-{{ $item->id }}" value="" name="complementos[]"
                  class="peer absolute top-3 left-3 w-5 h-5 accent-rosalasdonas" required="">
                @if ($item->images->count() > 0)
                  {{-- Verifica si hay imágenes antes del foreach --}}
                  @foreach ($item->images as $image)
                    @if ($image->caratula == 1)
                      {{-- Verifica si la imagen es la carátula --}}
                      <img class="size-full w-48 h-56"
                        src="{{ $image->name_imagen ? asset($image->name_imagen) : asset('images/img/noimagen.jpg') }}" />
                    @break

                    {{-- Añade un break para detener el bucle después de encontrar la carátula --}}
                  @endif
                @endforeach
              @else
                <img class="size-full w-48 h-56" src="{{ asset('images/img/noimagen.jpg') }}" />
              @endif

            </div>
          </label>
          <h2 class="text-base font-normal text-black text-center">{{ $item->producto }}</h2>
          <div class="flex font-medium justify-center">
            <p>S/ <span>75.00</span></p>
            <p class="px-2">-</p>
            <p>S/ <span>120.00</span></p>
          </div>
        </li>
      @endforeach

      <li>
        <div
          class="flex flex-col justify-center items-center text-rosalasdonas text-center w-48 m-auto h-56 border-rosalasdonas border-2 p-3 rounded-xl ">

          <div class="grid grid-cols-1 gap-3 xl:gap-5">
            <div class="flex flex-col justify-center items-center">
              <img src="{{ asset('img_donas/regalo.svg') }}" />
            </div>

            <button type="button" class="flex flex-col justify-center items-center"
              onclick="openModalComplementos()">
              Ver más
            </button>

          </div>
        </div>
      </li>

    </ul>
  </section>

  <section>
    <div class="px-[5%] pt-16 pb-0 space-y-10">
      <div class="text-left  space-y-4">

        <div class="text-white font-semibold pb-6 md:space-x-6 space-y-3">
          <button type="button" class="bg-rosalasdonas px-6 py-3 rounded-full ">Descripción del producto</button>
          <button type="button" class="bg-rosalasdonas px-6 py-3 rounded-full ">Políticas de envío</button>
          <button type="button" class="bg-rosalasdonas px-6 py-3 rounded-full ">Políticas de sustitución</button>
        </div>

        <div id="containerDetalles">
          {!! $productos->description !!}


        </div>
      </div>
    </div>

  </section>

  <section>
    <div class="px-[5%] py-16 pb-20 space-y-10">
      <div class="text-center  space-y-2">
        <h3 class="text-lg font-bold text-rosalasdonas ">Más productos</h3>
        <h2 class="text-4xl md:text-5xl font-bold text-black">También te puede interesar</h2>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

        <div class="space-y-2 max-w-96 m-auto">
          <img class="w-96 h-96 object-contain" src="{{ asset('img_donas/productolasdonas.png') }}" />
          <h2 class="text-xl font-bold text-black">Ramo Primaveral</h2>
          <p class="text-base font-normal text-black">Estallido de colores primaverales. Ideal para alegrar el día.</p>
          <div class="flex font-medium">
            <p>S/ <span>75.00</span></p>
            <p class="px-2">-</p>
            <p>S/ <span>120.00</span></p>
          </div>
          <button type="button"
            class="w-full  py-3 rounded-lg shadow-md font-medium flex items-center justify-center">Agregar a mi bolsa
            <img class="ml-2" src="{{ asset('img_donas/addcart.svg') }}" /></input>
        </div>

        <div class="space-y-2 max-w-96 m-auto">
          <img class="w-96 h-96 object-contain" src="{{ asset('img_donas/productolasdonas.png') }}" />
          <h2 class="text-xl font-bold text-black">Ramo Primaveral</h2>
          <p class="text-base font-normal text-black">Estallido de colores primaverales. Ideal para alegrar el día.</p>
          <div class="flex font-medium">
            <p>S/ <span>75.00</span></p>
            <p class="px-2">-</p>
            <p>S/ <span>120.00</span></p>
          </div>
          <button type="button"
            class="w-full  py-3 rounded-lg shadow-md font-medium flex items-center justify-center">Agregar a mi bolsa
            <img class="ml-2" src="{{ asset('img_donas/addcart.svg') }}" /></input>
        </div>

        <div class="space-y-2 max-w-96 m-auto">
          <img class="w-96 h-96 object-contain" src="{{ asset('img_donas/productolasdonas.png') }}" />
          <h2 class="text-xl font-bold text-black">Ramo Primaveral</h2>
          <p class="text-base font-normal text-black">Estallido de colores primaverales. Ideal para alegrar el día.</p>
          <div class="flex font-medium">
            <p>S/ <span>75.00</span></p>
            <p class="px-2">-</p>
            <p>S/ <span>120.00</span></p>
          </div>
          <button type="button"
            class="w-full  py-3 rounded-lg shadow-md font-medium flex items-center justify-center">Agregar a mi bolsa
            <img class="ml-2" src="{{ asset('img_donas/addcart.svg') }}" /></input>
        </div>

        <div class="space-y-2 max-w-96 m-auto">
          <img class="w-96 h-96 object-contain" src="{{ asset('img_donas/productolasdonas.png') }}" />
          <h2 class="text-xl font-bold text-black">Ramo Primaveral</h2>
          <p class="text-base font-normal text-black">Estallido de colores primaverales. Ideal para alegrar el día.</p>
          <div class="flex font-medium">
            <p>S/ <span>75.00</span></p>
            <p class="px-2">-</p>
            <p>S/ <span>120.00</span></p>
          </div>
          <button type="button"
            class="w-full  py-3 rounded-lg shadow-md font-medium flex items-center justify-center">Agregar a mi bolsa
            <img class="ml-2" src="{{ asset('img_donas/addcart.svg') }}" /></input>
        </div>

      </div>
    </div>
  </section>
</main>
<div id="modalComplementos" class="hidden">
  <div class=" fixed inset-0 z-30 bg-gray-500 bg-opacity-75 transition-opacity"></div>


  <div class=" fixed inset-0 z-30 w-screen overflow-y-auto">
    <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
      <div
        class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl">
        <div class="bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
          <div class="sm:flex sm:items-start w-full">

            <div class="mt-3 text-center sm:ml-4 sm:mt-0 sm:text-left w-full">
              <div class="flex flex-row justify-between">
                <h2 class="text-lg font-bold leading-6 text-gray-900 mb-2" id="modal-title">Complementa tu pedido</h2>


                <img src="{{ asset('images\img\xcoral.png') }}" alt="" class="h-5 cursor-pointer"
                  onclick="closeModalComplementos()">
              </div>
              <div class="mt-5 gap-4 " id="containerComplementos" data-accordion="collapse">
                {{--  @foreach ($imagenes as $item)
                    <img src="{{ asset($item['name_imagen']) }}" alt="{{ asset($item['name_imagen']) }}"
                      class="w-10 h-10 object-cover">
                  @endforeach --}}
              </div>
            </div>
          </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse content-between justify-between  sm:px-6 ">


          <button onclick="closeModalComplementos()" type="button"
            class="inline-flex w-full justify-center rounded-md  bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:ml-3 sm:w-auto">Cerrar</button>
        </div>
      </div>
    </div>
  </div>




  @section('scripts_importados')

    <script>
      var appUrl = '{{ env('APP_URL') }}';
      var firstLoading = []
      var firstloadingModal = true
      $(document).on('click', '#modalComplementos', function(event) {
        // Verificar si el clic fue directamente sobre el contenedor
        if (event.target.id === 'modalComplementos') {
          closeModalComplementos(); // Llamar a la función que cierra el modal
        }
      });
      $(document).on('click', '[id^="accordion-collapse-heading-"]', function(event) {
        // Verificar si el clic fue directamente sobre el contenedor
        let id = $(this).attr('id');


        const existe = firstLoading.includes(id);

        id = id[id.length - 1];

        if (!existe) {
          $.ajax({
            url: "{{ route('productos.buscaSubComplementosDetalle') }}",
            method: 'POST',
            data: {
              id
            },
            success: function(data) {
              console.log(data);

              firstLoading.push(id)

              let datos = data.productos;
              let container = document.getElementById('accordion-collapse-body-' + id);
              let divContainer = document.createElement('div');
              divContainer.classList.add('flex', 'flex-col', 'gap-1');
              let divPadre = document.createElement('div');
              divPadre.className =
                "grid w-full gap-4 grid-cols-1 md:grid-cols-4 mt-6"

              datos.forEach((complemento, index) => {
                // Crear el botón del acordeón
                let divAuto = document.createElement('div');
                divAuto.className = 'm-auto  ';

                let label = document.createElement('label');
                label.setAttribute('for', `react-option-${complemento.id}`);
                label.className =
                  "inline-flex items-center justify-between w-full  bg-white  rounded-lg cursor-pointer  ";

                let divBlock = document.createElement('div');
                divBlock.className = 'block relative';

                let input = document.createElement('input');
                input.type = 'checkbox';
                input.id = `react-option-${complemento.id}`;
                input.value = '';
                input.name = 'complementos[]';
                input.className =
                  'peer absolute top-3 left-3 w-5 h-5 accent-rosalasdonas border-[#FF8555] rounded-md peer-checked:accent-[#73B473]';
                input.required = '';

                divBlock.appendChild(input);

                if (complemento.images.length > 0) {
                  for (let i = 0; i < complemento.images.length; i++) {
                    const image = complemento.images[i];
                    if (image.caratula == 1) {
                      // Añade la carátula
                      let img = document.createElement('img');
                      img.className = 'size-full w-48 h-56 rounded-lg object-cover';
                      img.src = image.name_imagen ? appUrl + '/' + image.name_imagen :
                        'path/to/default.jpg';
                      divBlock.appendChild(img);
                    }
                  }

                } else {
                  let img = document.createElement('img');
                  img.className = 'size-full w-48 h-56 rounded-lg object-cover';
                  img.src = `${appUrl}/images/img/noimagen.jpg`;
                  divBlock.appendChild(img);
                }

                label.appendChild(divBlock);

                let h2 = document.createElement('h2');
                h2.className = 'text-base font-normal text-black text-center';
                // Asignar el texto al elemento h2
                h2.textContent = complemento.producto;
                // Añadir el elemento h2 como hijo del elemento label
                // label.appendChild(h2);

                let divFlex = document.createElement('div');
                divFlex.className = 'flex font-medium justify-center';

                let p1 = document.createElement('p');
                p1.textContent = 'S/ ';
                let span1 = document.createElement('span');
                span1.textContent = '75.00';
                let p2 = document.createElement('p');
                p2.textContent = '-';
                let p3 = document.createElement('p');
                p3.textContent = 'S/ ';
                let span2 = document.createElement('span');
                span2.textContent = '120.00';
                divFlex.appendChild(p1);
                divFlex.appendChild(span1);
                divFlex.appendChild(p2);
                divFlex.appendChild(p3);
                divFlex.appendChild(span2);
                // label.appendChild(divFlex);
                divAuto.appendChild(label);
                divAuto.appendChild(h2);
                divAuto.appendChild(divFlex);

                divPadre.appendChild(divAuto);
                // divContainer.appendChild(divPadre);





                //appendchild accordion-collapse-body-${id}
              })
              //borra lo que tiene el container 
              container.innerHTML = '';
              container.appendChild(divPadre)
            }
          });

        }



      })

      function closeModalComplementos() {
        $('#modalComplementos').addClass('hidden');
      }


      function openModalComplementos() {
        if (!firstloadingModal) {
          $('#modalComplementos').removeClass('hidden');

          return
        }

        $.ajax({
          url: "{{ route('productos.buscaComplementos') }}",
          method: 'GET',

          success: function(data) {
            console.log(data);
            firstloadingModal = false
            let datos = data.categorias;


            let divContainer = document.getElementById('containerComplementos');

            datos.forEach((complemento, index) => {
              // Crear el contenedor h2 y el botón del acordeón
              let h2 = document.createElement('h2');
              h2.id = `accordion-collapse-heading-${complemento.id}`;
              h2.className = '';

              let acordeon = document.createElement('button');
              acordeon.className =
                "flex items-center justify-between w-full p-5 font-medium text-black  rounded-t-xl   focus:text-white dark:focus:ring-gray-800 dark:border-gray-700 dark:text-black hover:bg-gray-100 dark:hover:bg-gray-800 gap-3";
              acordeon.setAttribute('data-accordion-target', `#accordion-collapse-body-${complemento.id}`);
              acordeon.setAttribute('aria-expanded', 'false');
              acordeon.setAttribute('aria-controls', `accordion-collapse-body-${complemento.id}`);
              acordeon.type = 'button';
              acordeon.style.transition = "all 500ms ease-in-out";

              // Crear el span para el nombre del complemento
              let span = document.createElement('span');
              span.textContent = complemento.name;

              // Crear el ícono de chevron
              let svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
              svg.setAttribute('data-accordion-icon', '');
              svg.classList.add('w-3', 'h-3', 'shrink-0', 'rotate-180', 'stroke-[#FF8555]');
              svg.setAttribute('fill', 'none');
              svg.setAttribute('viewBox', '0 0 10 6');
              svg.innerHTML =
                '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>';

              // Añadir el span y el svg al botón
              acordeon.appendChild(span);
              acordeon.appendChild(svg);

              // Añadir el botón al contenedor h2
              h2.appendChild(acordeon);

              // Crear el cuerpo del acordeón
              let divBody = document.createElement('div');
              divBody.id = `accordion-collapse-body-${complemento.id}`;
              divBody.className = 'hidden';
              divBody.setAttribute('aria-labelledby', `accordion-collapse-heading-${complemento.id}`);

              let divContent = document.createElement('div');
              divContent.className =
                'p-5 border border-gray-200 dark:border-gray-700 dark:bg-gray-900';
              divContent.innerHTML =
                `<p class="mb-2 text-gray-500 dark:text-gray-400">${complemento.description}</p>`;

              divBody.appendChild(divContent);

              // Evento de clic para expandir/colapsar el acordeón
              acordeon.addEventListener('click', function() {
                console.log('click en acordeón');
                acordeon.classList.add('bg-[#FF8555]')
                // Cerrar todos los acordeones antes de abrir el seleccionado
                document.querySelectorAll('[data-accordion-target]').forEach((otherAcordeon) => {
                  if (otherAcordeon !== acordeon) {
                    otherAcordeon.setAttribute('aria-expanded', 'false');
                    otherAcordeon.classList.remove('bg-[#FF8555]')
                    let targetBody = document.querySelector(otherAcordeon.getAttribute(
                      'data-accordion-target'));
                    if (targetBody) {
                      targetBody.classList.add('hidden');
                      let svgIcon = otherAcordeon.querySelector('svg');
                      if (svgIcon) svgIcon.classList.add('rotate-180');
                    }
                  }
                });

                // Alternar el estado del acordeón seleccionado
                let expanded = this.getAttribute('aria-expanded') === 'true';
                this.setAttribute('aria-expanded', !expanded);
                let targetBody = document.querySelector(this.getAttribute('data-accordion-target'));
                if (targetBody) {
                  targetBody.classList.toggle('hidden', expanded);
                  // Cambiar el ícono según el estado
                  svg.classList.toggle('rotate-180', expanded);
                }
              });

              // Añadir el h2 y el cuerpo del acordeón al contenedor principal
              divContainer.appendChild(h2);
              divContainer.appendChild(divBody);
            });



          }
        })

        $('#modalComplementos').removeClass('hidden');

      }
    </script>

    <script>
      document.addEventListener("DOMContentLoaded", () => {
        var headerServices = new Swiper(".img-complementarias", {
          slidesPerView: 3,
          spaceBetween: 0,
          loop: false,
          centeredSlides: false,
          initialSlide: 0, // Empieza en el cuarto slide (índice 3) */
          /* pagination: {
            el: ".swiper-pagination-estadisticas",
            clickable: true,
          }, */
          //allowSlideNext: false,  //Bloquea el deslizamiento hacia el siguiente slide
          //allowSlidePrev: false,  //Bloquea el deslizamiento hacia el slide anterior
          allowTouchMove: true, // Bloquea el movimiento táctil
          autoplay: {
            delay: 5500,
            disableOnInteraction: true,
            pauseOnMouseEnter: true
          },

          breakpoints: {
            0: {
              slidesPerView: 1,
              centeredSlides: false,
              loop: true,
            },
            1024: {
              slidesPerView: 3,
              centeredSlides: false,

            },
          },
        });



        var testimonios = new Swiper(".testimonios", {
          slidesPerView: 3,
          spaceBetween: 40,
          loop: true,
          grabCursor: true,
          centeredSlides: false,
          initialSlide: 0, // Empieza en el cuarto slide (índice 3) */
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
          },
          allowTouchMove: true, // Bloquea el movimiento táctil
          /* autoplay: {
            delay: 5000,
            disableOnInteraction: false,
          }, */

          breakpoints: {
            0: {
              slidesPerView: 1,
            },
            768: {
              slidesPerView: 2,
            },
            1024: {
              slidesPerView: 3,
            },
          },
        });

        /* deslizante */

      })
    </script>
    <script>
      var contador = 0


      var productos = @json($productos);
      var subproductos = @json($subproductos);
      var tipoDefault = @json($tipoDefault);

      $(document).ready(function() {
        $('.radio-option-label').on('click', function() {
          $('.radio-option-label').removeClass('bg-rosasuave');
          $(this).addClass('bg-rosasuave');
        });


        $('#dropzone-file').on('change', function() {
          var file = $(this)[0].files[0];
          var reader = new FileReader();
          reader.onload = function(e) {
            $('#imagePreview').attr('src', e.target.result);
            $('#imagePreview').css('display', 'block');
          }
          reader.readAsDataURL(file);
        });
        $(document).on("change", ".radio-option", function() {
          var seleccion = $(this).val(); // Obtiene el valor de la opción seleccionada
          var contenidoDetalle = ""; // Inicializa el contenido a vacío

          console.log(tipoDefault.name)
          if (seleccion === tipoDefault.name) {
            // Si la selección es 'premium', usa directamente 'productos'
            contenidoDetalle = productos.description;
            CambiarImagesOpcion(productos)

          } else {
            // Para 'clasico' o 'deluxe', busca en 'subproductos'
            var subproductoEncontrado = subproductos.find(function(subproducto) {
              return subproducto.tipos.name ==
                seleccion; // Asume que 'subproductos' es un array y cada elemento tiene una propiedad 'tipo'
            });
            if (subproductoEncontrado) {
              contenidoDetalle = subproductoEncontrado
                .description; // Asume que cada 'subproducto' tiene una propiedad 'detalle'
            }
            console.log(subproductoEncontrado)
            CambiarImagesOpcion(subproductoEncontrado)
          }

          // Actualiza el contenedor con el nuevo contenido



          $("#containerDetalles").html(contenidoDetalle);

        })

      });

      function CambiarImagesOpcion(productosSelect) {
        console.log(productosSelect)
        contador++
        console.log(contador)
        let imagesContainer = $('#imagesContainer');

        let contenidoDetalle = '';
        let contenidoDetalle2 = '';

        let hayImages = productosSelect.images?.length > 0
        console.log(hayImages)

        if (hayImages) {
          let caratulaAdded = false;

          for (let i = 0; i < productosSelect.images.length; i++) {
            const image = productosSelect.images[i];
            console.log(image.id)
            if (image.caratula === 1 && !caratulaAdded) {
              // Añade la carátula
              contenidoDetalle += `
              <div class="col-span-2 sm:col-span-3 relative imagen-oculta" hidden>
              <img id="imagePreview" src="#" alt="Image preview" class="h-24 w-36 absolute bottom-[8%] right-[25%] rounded-lg shadow-2xl object-cover rotate-12" style="display: none;" />
              <img class="size-full " src="${image.name_imagen ? appUrl+'/'+ image.name_imagen : 'path/to/default.jpg'}" />
             
              </div>
            `;
              caratulaAdded = true;
            } else if (image.caratula !== 1) {
              // Añade imágenes que no son carátula
              contenidoDetalle2 += `
              <img hidden class="size-full imagen-oculta" src="${image.name_imagen ?  appUrl+'/'+ image.name_imagen : 'path/to/default.jpg'}" />
             

            `;
            }

          }

        } else {
          // Caso en que no hay imágenes
          contenidoDetalle += `
      <img class="size-full" src="path/to/default.jpg" />
    `;
        }
        let contenidoFinal = contenidoDetalle + contenidoDetalle2;

        // Inserta el contenido en el contenedor

        $("#containerImagenesP").html(getSkeleton());
        // un skeleton de 1 segundo 

        $("#containerImagenesP").append(contenidoFinal);


        setTimeout(() => {

          //quitar el skeleton
          $(".pintar-skeleton").remove();

          $(".imagen-oculta").removeAttr("hidden");
        }, 1500);



      }

      function getSkeleton() {
        let divHijo1 = document.createElement('div');

        divHijo1.className =
          'pintar-skeleton flex items-center justify-center md:h-[600px] md:w-[600px] xl:w-[705px] xl:h-[705px]  animate-pulse bg-gray-300 rounded dark:bg-gray-700 col-span-3';

        let svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        svg.setAttribute('class', 'w-10 h-10 text-gray-200 dark:text-gray-600');
        svg.setAttribute('aria-hidden', 'true');
        svg.setAttribute('fill', 'currentColor');
        svg.setAttribute('viewBox', '0 0 20 18');

        let path = document.createElementNS('http://www.w3.org/2000/svg', 'path');
        path.setAttribute('d',
          'M18 0H2a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm4.376 10.481A1 1 0 0 1 16 15H4a1 1 0 0 1-.895-1.447l3.5-7A1 1 0 0 1 7.468 6a.965.965 0 0 1 .9.5l2.775 4.757 1.546-1.887a1 1 0 0 1 1.618.1l2.541 4a1 1 0 0 1 .028 1.011Z'
        );

        svg.appendChild(path);
        divHijo1.appendChild(svg);

        let divHijo2 = document.createElement('div');
        divHijo2.classList.add('bg-gray-300', 'h-[214px]', 'rounded', 'flex', 'items-center', 'col-span-1', 'animate-pulse',
          'justify-center',
          'dark:bg-gray-700', 'pintar-skeleton');

        divHijo2.appendChild(svg.cloneNode(true));
        let divHijo3 = divHijo2.cloneNode(true)
        let divHijo4 = divHijo2.cloneNode(true)
        let divHijo5 = divHijo2.cloneNode(true)
        let divHijo6 = divHijo2.cloneNode(true)
        let divHijo7 = divHijo2.cloneNode(true)


        let span = document.createElement('span');
        span.classList.add('sr-only');
        span.textContent = 'Loading...';

        return [divHijo1, divHijo2, divHijo3, divHijo4, divHijo5, divHijo6, divHijo7];
      }
    </script>
    <script>
      $(document).ready(function() {

        // PintarCarrito()

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
      $('#openCarrito').on('click', function() {
        $('.main').addClass('blur')
      })
      $('#closeCarrito').on('click', function() {

        $('.cartContainer').addClass('hidden')
        $('#check').prop('checked', false);
        $('.main').removeClass('blur')


      });
    </script>



    {{-- <script src="{{ asset('js/carrito.js') }}"></script> --}}

    <script>
      $(document).ready(function() {

        function llenarImagenes(images) {

          let html = '';
          images.forEach(element => {
            if (element.type_imagen == 'primary') {
              html += `
                          <div class="flex flex-col gap-5 relative ">
                            <img src="{{ asset('${element.name_imagen}') }}" alt="${element.name_imagen}" class="w-full object-cover" />
                          </div>
                      `;
            }

            if (element.type_imagen == 'secondary') {
              html += `
                      <img src="{{ asset('${element.name_imagen}') }}" alt="${element.name_imagen}"
                            class="w-full object-cover " />`;
            }
          });
          return html;
        }

        function llenadoTallas(tallas) {
          let html = '';

          tallas.forEach(element => {
            if (element) {
              html += `
                          <div class="tallas flex justify-center items-center border-2 w-full rounded-lg cursor-pointer">
                              <p class="tallasombreado py-5 px-4 w-full text-center transition">
                                ${element.talla.valor}
                              </p>
                          </div>
                         
                      `;
            }
          });
          return html;
        }


        function enviarColorSeleccionado() {
          var selectedColorDiv = $('.colors.color');
          var colorId = selectedColorDiv.data('id');
          var productId = selectedColorDiv.data('productid');

          $.ajax({
            url: '{{ route('cambioGaleria') }}', // Cambia esta URL a la ruta de tu controlador
            method: 'POST', // O 'POST' según corresponda
            data: {
              id: colorId,
              idproduct: productId
            },
            success: function(response) {
              console.log(response)
              let conteoImagenes = response.images.length;
              let llenadoimg = llenarImagenes(response.images);
              let llenadotallas = llenadoTallas(response.tallas);


              if (conteoImagenes == 1) {
                $('#imageContainer_uno').html(llenadoimg);
                $('#imageContainer').addClass('hidden');
                $('#imageContainer_uno').removeClass('hidden');

              } else {
                $('#imageContainer').html(llenadoimg);
                $('#imageContainer').removeClass('hidden');
                $('#imageContainer_uno').addClass('hidden');
              }

              $('#llenadoTallas').html(llenadotallas);
              // console.log(response.tallas[0].stock)

              // $('#textoStock').text(response.tallas[0].stock !== null ? "Con Stock" : '')




            },
            error: function(xhr) {
              console.log(xhr.responseText);
            }
          });
        }
        enviarColorSeleccionado();

        $('.colors').on('click', function() {
          $('.colors').removeClass('color');
          $(this).addClass('color');
          enviarColorSeleccionado();
        });

        $(document).on('click', '.tallas', function() {
          $('.tallas').removeClass('tallaSelected');
          $('.tallas').removeClass('bg-slate-400');

          $(this).addClass('tallaSelected');
          $(this).addClass('bg-slate-400');
        });


      });
    </script>

  @stop


@stop
