<x-app-layout>
  @section('css')
    <link rel="stylesheet" href="{{ asset('/css/vendor/dropzone.min.css') }}" />
  @endsection

  @section('js_vendor')
    <script src="{{ asset('/js/cs/scrollspy.js') }}"></script>
    <script src="{{ asset('/js/vendor/dropzone.min.js') }}"></script>
    <script src="{{ asset('/js/vendor/singleimageupload.js') }}"></script>
  @endsection

  @section('js_page')
    <script src="{{ asset('/js/cs/dropzone.templates.js') }}"></script>
    <script src="{{ asset('/js/forms/controls.dropzone.js') }}"></script>
  @endsection
  <style>
    .dropzone {
      min-height: 90px;
      border: 1px solid rgb(209 213 219 / 1) !important;
      background: var(--foreground) !important;
      padding: 14px !important;
      border-radius: 20px !important;
      color: var(--body) !important;
      height: auto;
      /* padding-right: initial !important;
    padding-bottom: initial !important; */
    }

    .dropzone .img-thumbnail {
      height: 58px;
      width: 100% !important;
      -o-object-fit: cover !important;
      object-fit: cover !important;
      padding: initial;
      width: 100%;
      height: 100%;
      filter: initial !important;
      transform: initial !important;
      border-radius: 20px;
      border-top-right-radius: initial;
      border-bottom-right-radius: initial;
      background-color: unset !important;
    }

    .dropzone .image-container {
      width: 30%;
    }

    .dropzone:hover .dz-message {
      color: var(--primary) !important;
    }

    .dropzone.dz-clickable .dz-message {
      position: absolute;
      margin: 0 auto;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: var(--body);
    }

    .dropzone.dz-clickable .dz-message span {
      top: 50px !important;
    }

    .dropzone .dz-preview.dz-image-preview,
    .dropzone .dz-preview.dz-file-preview {
      max-width: 100%;
      min-height: unset;
      border: 1px solid rgb(209 213 219 / 1) !important;
      border-radius: 20px !important;
      background: var(--foreground) !important;
      color: var(--body) !important;
      margin: 1.75rem;
      margin-left: initial !important;
      margin-top: initial !important;
    }

    .dropzone .dz-preview.dz-image-preview>div,
    .dropzone .dz-preview.dz-file-preview>div {
      position: relative;
    }

    .dropzone .dz-preview.dz-image-preview .dz-image,
    .dropzone .dz-preview.dz-file-preview .dz-image {
      height: 100%;
      width: 80px;
      float: left;
      border-radius: initial;
    }

    .dropzone .dz-preview.dz-image-preview .dz-image img,
    .dropzone .dz-preview.dz-file-preview .dz-image img {
      width: 100%;
    }

    .dropzone .dz-preview.dz-image-preview .preview-container,
    .dropzone .dz-preview.dz-file-preview .preview-container {
      transition: initial !important;
      -webkit-animation: initial !important;
      animation: initial !important;
      margin-left: 0;
      margin-top: 0;
      position: relative;
      width: 100%;
      height: 100%;
    }

    .dropzone .dz-preview.dz-image-preview .preview-container i,
    .dropzone .dz-preview.dz-file-preview .preview-container i {
      color: var(--primary);
      font-size: 20px;
      position: absolute;
      left: 50%;
      top: 29px;
      transform: translateX(-50%) translateY(-50%) !important;
      height: 22px;
    }

    .dropzone .dz-preview.dz-image-preview strong,
    .dropzone .dz-preview.dz-file-preview strong {
      font-weight: normal;
    }

    .dropzone .dz-preview.dz-image-preview .remove,
    .dropzone .dz-preview.dz-file-preview .remove {
      position: absolute;
      right: 8px;
      top: 8px;
      color: var(--muted) !important;
    }

    .dropzone .dz-preview.dz-image-preview .remove i,
    .dropzone .dz-preview.dz-file-preview .remove i {
      cursor: pointer;
    }

    .dropzone .dz-preview.dz-image-preview .remove:hover,
    .dropzone .dz-preview.dz-file-preview .remove:hover {
      color: var(--primary) !important;
    }

    .dropzone .dz-preview.dz-image-preview .dz-details,
    .dropzone .dz-preview.dz-file-preview .dz-details {
      position: static;
      display: block;
      opacity: 1;
      text-align: left;
      min-width: unset;
      z-index: initial;

      float: left;
      padding: 0.75rem 1rem;
      width: 75%;
    }

    .dropzone .dz-preview.dz-image-preview .dz-details .dz-size,
    .dropzone .dz-preview.dz-file-preview .dz-details .dz-size {
      margin-bottom: 0;
      font-size: 1em;
    }

    .dropzone .dz-preview.dz-image-preview .dz-details .dz-filename span,
    .dropzone .dz-preview.dz-file-preview .dz-details .dz-filename span {
      border: initial !important;
      background: transparent !important;
    }

    .dropzone .dz-preview.dz-image-preview .dz-error-mark,
    .dropzone .dz-preview.dz-image-preview .dz-success-mark,
    .dropzone .dz-preview.dz-file-preview .dz-error-mark,
    .dropzone .dz-preview.dz-file-preview .dz-success-mark {
      color: var(--primary) !important;
      margin-left: 0;
      margin-top: 0;
      bottom: initial;
      right: initial;
      top: 13px;
      left: 23px;
      padding: 7px 8px;
      background: var(--foreground);
      border-radius: var(--border-radius-xl);
      line-height: 1;
    }

    .dropzone .dz-preview.dz-image-preview .dz-error-mark i,
    .dropzone .dz-preview.dz-image-preview .dz-success-mark i,
    .dropzone .dz-preview.dz-file-preview .dz-error-mark i,
    .dropzone .dz-preview.dz-file-preview .dz-success-mark i {
      font-size: 18px !important;
      color: var(--primary) !important;
    }

    .dropzone .dz-preview.dz-image-preview .dz-error-mark i,
    .dropzone .dz-preview.dz-file-preview .dz-error-mark i {
      color: var(--primary) !important;
    }

    .dropzone .dz-preview.dz-image-preview .dz-progress,
    .dropzone .dz-preview.dz-file-preview .dz-progress {
      width: 100%;
      margin-left: 0;
      margin-top: 0;
      right: 0;
      height: 2px !important;
      left: 15px;
      margin-top: 5px;
      position: static;
    }

    .dropzone .dz-preview.dz-image-preview .dz-progress .dz-upload,
    .dropzone .dz-preview.dz-file-preview .dz-progress .dz-upload {
      width: 100%;
      background: rgb(30 168 231) !important;
    }

    .dropzone .dz-preview.dz-image-preview .dz-error-message,
    .dropzone .dz-preview.dz-file-preview .dz-error-message {
      background: var(--foreground) !important;
      border: 1px solid blue;
      top: 60px;
      color: var(--body);
      padding: calc(var(--card-spacing-xs) / 2) var(--card-spacing-xs);
      border-radius: var(--border-radius-md);
      font-size: 0.875em;
      display: block;
    }

    .dropzone .dz-preview.dz-image-preview .dz-error-message:after,
    .dropzone .dz-preview.dz-file-preview .dz-error-message:after {
      border-bottom: 6px solid blue !important;
    }

    .dropzone .dz-preview.dz-image-preview .dz-error-message:before,
    .dropzone .dz-preview.dz-file-preview .dz-error-message:before {
      content: " ";
      position: absolute;
      top: -5px;
      left: 64px;
      z-index: 1;
      border-left: 6px solid transparent;
      border-right: 6px solid transparent;
      border-bottom: 6px solid var(--foreground) !important;
    }

    .dropzone .dz-preview.dz-image-preview [data-dz-name],
    .dropzone .dz-preview.dz-file-preview [data-dz-name] {
      white-space: nowrap;
      text-overflow: ellipsis;
      width: calc(100% - 35px);
      display: inline-block;
      overflow: hidden;
    }

    .dropzone.dropzone-columns .dz-preview.dz-image-preview,
    .dropzone.dropzone-columns .dz-preview.dz-file-preview {
      margin-top: var(--bs-gutter-y) !important;
      margin-bottom: initial !important;
    }

    .dropzone:not(.dropzone-columns) .dz-preview.dz-image-preview,
    .dropzone:not(.dropzone-columns) .dz-preview.dz-file-preview {
      width: 100%;
    }

    .dropzone .dz-preview.dz-file-preview .img-thumbnail {
      display: none;
    }

    .dropzone .dz-error.dz-preview.dz-file-preview .preview-icon {
      display: none;
    }

    .dropzone .dz-error.dz-preview.dz-file-preview .dz-error-mark,
    .dropzone .dz-error.dz-preview.dz-file-preview .dz-success-mark {
      color: var(--primary) !important;
      right: 8px;
      left: initial;
      top: initial;
      bottom: 3px;
    }

    .dropzone .dz-preview.dz-image-preview .preview-icon {
      display: none;
    }

    .dropzone.dz-drag-hover {
      border-color: rgba(var(--primary-rgb), 1) !important;
    }

    .dropzone.dz-drag-hover .dz-message {
      color: var(--primary) !important;
      opacity: 1;
    }

    .dropzone.dropzone-top-label {
      padding: 2rem 0.5rem 0rem 1rem !important;
      min-height: 103px !important;
    }

    .form-floating .dropzone.dropzone-floating-label {
      padding: 1rem !important;
      min-height: 101px !important;
    }

    .form-floating .dropzone.dropzone-floating-label.dz-started {
      padding-top: 2rem !important;
      padding-bottom: 0 !important;
    }

    .form-floating .dropzone.dropzone-floating-label.dz-started~label {
      transform: scale(0.85) translateY(-0.5rem) translateX(0.15rem);
      color: var(--muted);
    }

    .dropzone.dropzone-filled {
      border: 1px solid transparent !important;
      background: var(--background-light) !important;
      padding-left: 45px !important;
    }

    .dropzone.dropzone-filled .dz-message {
      top: initial;
      left: 45px;
      transform: initial;
      color: var(--muted) !important;
      font-weight: 300;
      top: 11px;
    }

    .dropzone.dropzone-filled+i {
      margin-top: 0;
      top: 14px;
    }

    .dropzone.dropzone-filled.dropzone.dz-drag-hover {
      background: var(--foreground) !important;
      border-color: rgba(var(--primary-rgb), 1) !important;
    }

    .dropzone .dz-preview:not(.dz-processing) .dz-progress {
      -webkit-animation: initial;
      animation: initial;
    }

    .dropzone.row {
      min-height: 210px;
    }

    .dropzone.row.border-0 {
      border: initial !important;
    }

    .dropzone.row.p-0 {
      padding: initial !important;
    }

    .dropzone.row .dz-preview.dz-image-preview.col.border-0,
    .dropzone.row .dz-preview.dz-file-preview.col.border-0 {
      border: initial !important;
    }

    .dropzone.row .dz-preview.dz-image-preview .dz-error-mark,
    .dropzone.row .dz-preview.dz-image-preview .dz-success-mark,
    .dropzone.row .dz-preview.dz-file-preview .dz-error-mark,
    .dropzone.row .dz-preview.dz-file-preview .dz-success-mark {
      left: -16px;
      margin-left: 50%;
      top: 20px;
      margin-top: 0;
    }

    .dropzone.row .dz-preview.dz-image-preview .remove,
    .dropzone.row .dz-preview.dz-file-preview .remove {
      bottom: 25px;
      top: initial;
      right: 20px;
      left: initial;
    }

    .dropzone.row .dz-preview.dz-image-preview .dz-error-message,
    .dropzone.row .dz-preview.dz-file-preview .dz-error-message {
      left: 50%;
      right: initial;
      transform: translateX(-50%);
    }
  </style>


  <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    <form action="{{ route('products.save') }}" method="POST" enctype="multipart/form-data" id="formularioedit">
      @csrf
      {{-- @method('PUT') --}}
      <input type="hidden" name="id" value="{{ $product->id }}">
      <div
        class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">

          <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-2xl tracking-tight">

            @if ($product->id)
              Editar producto: {{ $product->producto }}
            @else
              Nuevo producto
            @endif
          </h2>
        </header>
        <div class="flex flex-col gap-2 p-3 ">
          <div class="flex gap-2 p-3 ">
            <div class="basis-0 md:basis-3/5">
              <div class="rounded shadow-lg p-4 px-4 ">
                <input type="hidden" name="id" value="{{ $product->id }}">

                <div id='general' class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">

                  @if (!$product->id)
                    <div class="col-span-1 md:col-span-2 lg:col-span-3 flex flex-row justify-between flex-wrap">
                      <div class="flex flex-row gap-1 items-center">
                        <div class="relative mb-2 mt-2">
                          <input type="checkbox" id="complemento" name="complemento"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                        </div>
                        <label for="complemento">Es un complemento?</label>
                      </div>
                      <div id="puntos_container" hidden class="w-full md:w-auto">
                        <input id="puntos_complemento" name="puntos_complemento" placeholder="Puntos Complemento"
                          class="mt-1 w-full md:w-auto bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg p-2.5">
                      </div>
                    </div>
                  @endif

                  <!-- Producto -->
                  <div class="col-span-1 md:col-span-5 mt-2">
                    <label for="producto">Producto</label>
                    <div class="relative mb-2 mt-2">
                      <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fa fa-pencil text-gray-500 dark:text-gray-400"></i>
                      </div>
                      <input type="text" id="producto" name="producto" value="{{ $product->producto }}"
                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Producto">
                    </div>
                  </div>

                  <!-- Extracto -->
                  <div class="md:col-span-5 mt-2">
                    <label for="extract">Extracto</label>
                    <div class="relative mb-2 mt-2">
                      <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <i class="fa fa-pencil text-gray-500 dark:text-gray-400"></i>
                      </div>
                      <input type="text" id="extract" name="extract" value="{{ $product->extract }}"
                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Extracto">
                    </div>
                  </div>

                  <!-- Descripcion -->
                  <div class="md:col-span-5">
                    <label for="description">Descripcion</label>
                    <div class="relative mb-2 mt-2">
                      <x-textarea id="description" name="description" value="{!! $product->description !!}" class="w-full" />
                    </div>
                  </div>

                  <!-- Lo más pedido -->
                  <div class="">
                    <label for="destacar">Lo más pedido</label>
                    <div class="relative mb-2 mt-2">
                      <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"></div>
                      <input type="checkbox" id="destacar" name="destacar"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        @if ($product->destacar) checked @endif>
                    </div>
                  </div>

                  <!-- Novedad -->
                  <div class="">
                    <label for="recomendar">Novedad</label>
                    <div class="relative mb-2 mt-2">
                      <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"></div>
                      <input type="checkbox" id="recomendar" name="recomendar"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        @if ($product->recomendar) checked @endif>
                    </div>
                  </div>

                  <!-- En liquidación -->
                  <div class="">
                    <label for="liquidacion">En liquidación</label>
                    <div class="relative mb-2 mt-2">
                      <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"></div>
                      <input type="checkbox" id="liquidacion" name="liquidacion"
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                        @if ($product->liquidacion) checked @endif>
                    </div>
                  </div>

                </div>


              </div>
            </div>
            <div class="basis-0 md:basis-2/5">

              <div class=" grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5 rounded shadow-lg p-4 px-4 ">
                <div class="md:col-span-5 flex justify-between gap-4">
                  <div class="w-full">
                    <label for="precio">Precio</label>
                    <div class="relative mb-2  mt-2">
                      <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                          fill="none" width="512" height="512" x="0" viewBox="0 0 24 24" stroke-width="1.5"
                          stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                      </div>
                      <input type="number" id="precio" name="precio" value="{{ $product->precio }}"
                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="precio">
                    </div>

                  </div>
                  <div class="w-full">
                    <label for="descuento">Descuento</label>
                    <div class="relative mb-2  mt-2">
                      <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                          fill="none" width="512" height="512" x="0" viewBox="0 0 24 24" stroke-width="1.5"
                          stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                      </div>
                      <input type="number" id="descuento" name="descuento" value="{{ $product->descuento }}"
                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="descuento">
                    </div>

                  </div>


                </div>



                <div class="md:col-span-5">
                  <label for="costo_x_art">Categoria</label>
                  <div class="relative mb-2  mt-2">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                      <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                        fill="none" width="512" height="512" x="0" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                      </svg>
                    </div>
                    <select name="categoria_id"
                      class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                      <option value="">Seleccionar Categoria</option>
                      @foreach ($categoria as $item)
                        <option value="{{ $item->id }}"
                          {{ $item->id == $product->categoria_id ? 'selected' : '' }}>
                          {{ $item->name }}</option>
                      @endforeach

                    </select>
                  </div>
                </div>



                <div class="md:col-span-5 mt-2">
                  <div class=" flex items-end justify-between gap-2 ">
                    <label for="especificacion">Especificacion </label>
                    <button type="button" id="AddEspecifiacion"
                      class="text-blue-500 hover:underline focus:outline-none font-medium">
                      Agregar Especificacion
                    </button>
                  </div>
                  @foreach ($especificacion as $item)
                    <div class="flex gap-2">
                      <div class="relative mb-2  mt-2">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                          <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                            version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512"
                            x="0" y="0" viewBox="0 0 469.336 469.336" style="enable-background:new 0 0 512 512"
                            xml:space="preserve" class="">
                            <g>
                              <path
                                d="m456.836 76.168-64-64.054c-16.125-16.139-44.177-16.17-60.365.031L45.763 301.682a10.733 10.733 0 0 0-2.688 4.587L.409 455.73a10.682 10.682 0 0 0 10.261 13.606c.979 0 1.969-.136 2.927-.407l149.333-42.703a10.714 10.714 0 0 0 4.583-2.69l289.323-286.983c8.063-8.069 12.5-18.787 12.5-30.192s-4.437-22.124-12.5-30.193zM285.989 89.737l39.264 39.264-204.996 204.997-14.712-29.434a10.671 10.671 0 0 0-9.542-5.896H78.921L285.989 89.737zm-259.788 353.4L40.095 394.5l34.742 34.742-48.636 13.895zm123.135-35.177-51.035 14.579-51.503-51.503 14.579-51.035h28.031l18.385 36.771a10.671 10.671 0 0 0 4.771 4.771l36.771 18.385v28.032zm21.334-17.543v-17.082c0-4.042-2.281-7.729-5.896-9.542l-29.434-14.712 204.996-204.996 39.264 39.264-208.93 207.068zM441.784 121.72l-47.033 46.613-93.747-93.747 46.582-47.001c8.063-8.063 22.104-8.063 30.167 0l64 64c4.031 4.031 6.25 9.385 6.25 15.083s-2.219 11.052-6.219 15.052z"
                                fill="#9F9F9F" opacity="1" data-original="#000000" class=""></path>
                            </g>
                          </svg>
                        </div>
                        <input type="text" id="tittle-{{ $item->id }}" name="tittle-{{ $item->id }}"
                          value="{{ $item->tittle }}"
                          class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                          placeholder="Tutulo">

                      </div>
                      <div class="relative mb-2  mt-2">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                          <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                            version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512"
                            x="0" y="0" viewBox="0 0 469.336 469.336" style="enable-background:new 0 0 512 512"
                            xml:space="preserve" class="">
                            <g>
                              <path
                                d="m456.836 76.168-64-64.054c-16.125-16.139-44.177-16.17-60.365.031L45.763 301.682a10.733 10.733 0 0 0-2.688 4.587L.409 455.73a10.682 10.682 0 0 0 10.261 13.606c.979 0 1.969-.136 2.927-.407l149.333-42.703a10.714 10.714 0 0 0 4.583-2.69l289.323-286.983c8.063-8.069 12.5-18.787 12.5-30.192s-4.437-22.124-12.5-30.193zM285.989 89.737l39.264 39.264-204.996 204.997-14.712-29.434a10.671 10.671 0 0 0-9.542-5.896H78.921L285.989 89.737zm-259.788 353.4L40.095 394.5l34.742 34.742-48.636 13.895zm123.135-35.177-51.035 14.579-51.503-51.503 14.579-51.035h28.031l18.385 36.771a10.671 10.671 0 0 0 4.771 4.771l36.771 18.385v28.032zm21.334-17.543v-17.082c0-4.042-2.281-7.729-5.896-9.542l-29.434-14.712 204.996-204.996 39.264 39.264-208.93 207.068zM441.784 121.72l-47.033 46.613-93.747-93.747 46.582-47.001c8.063-8.063 22.104-8.063 30.167 0l64 64c4.031 4.031 6.25 9.385 6.25 15.083s-2.219 11.052-6.219 15.052z"
                                fill="#9F9F9F" opacity="1" data-original="#000000" class=""></path>
                            </g>
                          </svg>
                        </div>

                        <input type="text" id="specifications-{{ $item->id }}"
                          name="specifications-{{ $item->id }}" value="{{ $item->specifications }}"
                          class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                          placeholder="Valor">
                      </div>
                    </div>
                  @endforeach
                </div>



              </div>

              <div class=" grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5 rounded shadow-lg p-4 px-4 ">
                <h4 class="font-semibold text-slate-800 dark:text-slate-100 text-xl tracking-tight">
                  Inventario</h4>
                <div class="md:col-span-5 flex justify-between gap-4">


                  <div class="w-full">
                    <label for="sku">SKU

                    </label>

                    <div class="relative mb-2  mt-2">
                      <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                          version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512"
                          x="0" y="0" viewBox="0 0 469.336 469.336" style="enable-background:new 0 0 512 512"
                          xml:space="preserve" class="">
                          <g>
                            <path
                              d="m456.836 76.168-64-64.054c-16.125-16.139-44.177-16.17-60.365.031L45.763 301.682a10.733 10.733 0 0 0-2.688 4.587L.409 455.73a10.682 10.682 0 0 0 10.261 13.606c.979 0 1.969-.136 2.927-.407l149.333-42.703a10.714 10.714 0 0 0 4.583-2.69l289.323-286.983c8.063-8.069 12.5-18.787 12.5-30.192s-4.437-22.124-12.5-30.193zM285.989 89.737l39.264 39.264-204.996 204.997-14.712-29.434a10.671 10.671 0 0 0-9.542-5.896H78.921L285.989 89.737zm-259.788 353.4L40.095 394.5l34.742 34.742-48.636 13.895zm123.135-35.177-51.035 14.579-51.503-51.503 14.579-51.035h28.031l18.385 36.771a10.671 10.671 0 0 0 4.771 4.771l36.771 18.385v28.032zm21.334-17.543v-17.082c0-4.042-2.281-7.729-5.896-9.542l-29.434-14.712 204.996-204.996 39.264 39.264-208.93 207.068zM441.784 121.72l-47.033 46.613-93.747-93.747 46.582-47.001c8.063-8.063 22.104-8.063 30.167 0l64 64c4.031 4.031 6.25 9.385 6.25 15.083s-2.219 11.052-6.219 15.052z"
                              fill="#9F9F9F" opacity="1" data-original="#000000" class=""></path>
                          </g>
                        </svg>
                      </div>
                      <input type="text" id="sku" name="sku" value="{{ $product->sku }}"
                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="# de sku">


                    </div>
                  </div>


                </div>
              </div>
              <div class="md:col-span-5 mt-2">
                <div class="flex justify-between gap-5">
                  @foreach ($product->images as $item)
                    <div id="portada-{{ $item->id }}" class="relative group shadow-xl">
                      <div class="absolute top-0 left-0 bottom-0 right-0 hover:backdrop-blur-md transition-all ">
                        <i onclick="borrarImg({{ $item->id }})" data-tippy-content="Eliminar Imagen" tippy
                          class="hidden group-hover:block absolute top-0 right-0 m-2 w-5 cursor-pointer fa-regular fa-trash-can z-10  transition-all"></i>

                        <!-- Botón de editar (Agrega tu propia función de onclick y ajusta el icono según necesites) -->
                        <label for="input-file-{{ $item->id }}" data-tippy-content="Editar Imagen" tippy
                          class="hidden group-hover:block absolute top-0 right-8 m-2 w-5 cursor-pointer fa-solid fa-camera-rotate z-10  transition-all"></label>
                      </div>

                      <input type="file" id="input-file-{{ $item->id }}"
                        name="input-file-{{ $item->id }}" style="display: none;"
                        data-img="#portada-{{ $item->id }} img">
                      <!-- Botón de eliminar -->


                      <!-- Imagen -->
                      <img src="{{ asset($item->name_imagen) }}" alt="" class="w-24  hover:blur-sm ">
                    </div>
                  @endforeach

                </div>

              </div>
              <div class="md:col-span-5 gap-4">
                <div class="flex  flex-col gap-4 p-2">
                  <label for="caratula">Caratula</label>
                  <input class="hidden" type="radio" name="caratula" value="{{ $item->id }}" checked>
                </div>

                <div class="flex flex-col gap-4">
                  <input id="imagen" name="imagenP-0"
                    class="p-2.5 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    aria-describedby="user_avatar_help" id="user_avatar" type="file">
                  <div class="dropzone border-gray-300 dropzoneSecond " id="dropzoneServerFilesGallery"
                    name="attrid-{{ $item->id }}">
                  </div>

                </div>

              </div>
              <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-1 rounded shadow-lg p-4 px-4">
                @foreach ($valorAtributo as $item)
                  @if ($item->attribute_id == 2)
                    <div class="grid grid-cols-3">
                      <label class="inline">{{ $item->valor }} </label>

                      <input type="checkbox" id="hs-basic-usage"
                        class="inline check_v btn_swithc relative w-[3.25rem] h-7 p-px bg-gray-100 border-transparent text-transparent 
                          rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:ring-transparent disabled:opacity-50 disabled:pointer-events-none 
                          checked:bg-none checked:text-blue-600 checked:border-blue-600 focus:checked:border-blue-600 dark:bg-gray-800 dark:border-gray-700 
                          dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-600 before:inline-block before:size-6
                          before:bg-white checked:before:bg-blue-200 before:translate-x-0 checked:before:translate-x-full before:rounded-full before:shadow        
                          before:transform before:ring-0 before:transition before:ease-in-out before:duration-200 dark:before:bg-gray-400 dark:checked:before:bg-blue-200"
                        id='{{ 'v_' . $item->id }}' data-field='destacar' data-idService='{{ $item->id }}'
                        data-titleService='{{ $item->producto }}' {{ $item->destacar == 1 ? 'checked' : '' }}>



                    </div>
                    <div hidden id="imagenesOcultas-{{ $item->id }}">
                      <div class="flex gap-4 p-2">
                        <label for="caratula">caratula</label>
                        <input type="radio" name="caratula" value="{{ $item->id }}">
                      </div>

                      <input id="imagen" name="imagenP-{{ $item->id }}"
                        class="p-2.5 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="user_avatar_help" id="user_avatar" type="file">
                      <div class="dropzone border-gray-300 dropzoneSecond " id="dropzoneServerFilesGallery"
                        name="attrid-{{ $item->id }}">
                      </div>
                    </div>
                  @endif
                @endforeach
              </div>



              <div class=" grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5 rounded shadow-lg p-4 px-4 ">
                <h4 class="font-semibold text-slate-800 dark:text-slate-100 text-xl tracking-tight">
                  Tags</h4>
                <div class="md:col-span-5 flex justify-between gap-4">

                  <div class="w-2/3">
                    <div class="relative mb-2  mt-2">
                      <select id="tags_id" name="tags_id[]" multiple class="w-full">
                        @foreach ($allTags as $tag)
                          <option value="{{ $tag->id }}"
                            {{ in_array($tag->id, $product->tags->pluck('id')->toArray()) ? 'selected' : '' }}>
                            {{ $tag->name }}
                          </option>
                        @endforeach
                      </select>
                    </div>


                  </div>
                </div>
              </div>

              <input type="hidden" name="valoresFormulario" id="valoresFormulario" value="">

            </div>
          </div>
          @if ($product->tipo_servicio !== 'complemento' && $product->parent_id == null)
            <div class="md:col-span-5 text-right mt-6 flex justify-between px-4 pb-4">
              <div class="inline-flex items-start">
                <button id="agregarOpciones" type="button"
                  class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                  Agregar opcion
                </button>
              </div>

            </div>
          @endif

          <div class="  rounded shadow-xl p-4 px-4 " id="OpcionesContainer">
            {{-- inicio foreach --}}
            @foreach ($subproductos as $subproducto)
              <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5"
                id="div-form-opcion-{{ $subproducto->id }}">

                <div class="md:col-span-5">
                  <button type="button"
                    class=" ml-2 bg-red-500 justify-self-center text-white px-4 h-10 hover:bg-red-700  font-bold py-2  rounded-full  eliminarOpcion"
                    style="  position: absolute;  right: 6%;">

                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                      stroke="currentColor" class="w-6 h-6">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>

                  </button>

                </div>

                <div class="md:col-span-5">


                  <h4 id="opcion-form-opcionComplemento-{{ $subproducto->id }}"
                    class="font-semibold  dark:text-slate-100 text-xl tracking-tight  text-white bg-[#ff3579] px-2  py-2 rounded inline-flex items-center justify-center">
                    Opcion @foreach ($tipo as $item)
                      @if ($item->id == $subproducto->tipo_prodct)
                        {{ $item->name }}
                      @endif
                    @endforeach
                  </h4>
                </div>

                <div class="md:col-span-2">
                  <label for="costo_x_art">Opcion


                  </label>
                  <div class="relative mb-2  mt-2">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                      <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                        fill="none" width="512" height="512" x="0" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                      </svg>
                    </div>
                    <input type="hidden" value="{{ $subproducto->id }}" data-name="id" name="id-Subproducto">
                    <select name="opcion-form-tipo_prodct-{{ $subproducto->id }}" data-name="tipo_prodct"
                      id="opcion-form-tipo_prodct-{{ $subproducto->id }}"
                      class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('categoria_id') is-invalid @enderror">
                      <option value="">Seleccionar Categoria </option>
                      @foreach ($tipo as $item)
                        @if ($item->id == $subproducto->tipo_prodct)
                          <option value="{{ $item->id }}" selected> {{ $item->name }}</option>
                        @else
                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endif
                      @endforeach

                    </select>
                    @error('tipo_prodct')
                      <div style="color: red;">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
                <div class="md:col-span-3 flex justify-between gap-4">

                  <div class="w-full">
                    <label for="precio">Precio <span class="text-red-500"> (Obligatorio) </span></label>
                    <div class="relative mb-2  mt-2">
                      <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                          fill="none" width="512" height="512" x="0" viewBox="0 0 24 24" stroke-width="1.5"
                          stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>

                      </div>
                      <input type="number" id="opcion-form-precio-{{ $subproducto->id }}" data-name="precio"
                        name="opcion-form-precio-{{ $subproducto->id }}" value="{{ $subproducto->precio }}"
                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('precio') is-invalid @enderror"
                        placeholder="precio">
                      @error('precio')
                        <div style="color: red;">{{ $message }}</div>
                      @enderror
                    </div>

                  </div>

                  <div class="w-full">
                    <label for="descuento">Descuento</label>
                    <div class="relative mb-2  mt-2">
                      <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                          fill="none" width="512" height="512" x="0" viewBox="0 0 24 24" stroke-width="1.5"
                          stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                      </div>
                      <input type="number" id="opcion-form-descuento-{{ $subproducto->id }}" data-name="descuento"
                        name="opcion-form-descuento-{{ $subproducto->id }}" value="{{ $subproducto->descuento }}"
                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('descuento') is-invalid @enderror"
                        placeholder="descuento">
                      @error('descuento')
                        <div style="color: red;">{{ $message }}</div>
                      @enderror
                    </div>

                  </div>

                </div>





                <div class="md:col-span-5 mt-2">
                  <div>

                    <div id="quill-opcion-{{ $subproducto->id }}" name="quill-opcion-{{ $subproducto->id }}"
                      class="h-60 mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                      placeholder="Descripción">{!! $subproducto->description !!}</div>
                    <input id="quill-Inputopcion-{{ $subproducto->id }}" hidden="true"
                      name="quill-opcion-{{ $subproducto->id }}" data-name="description" />

                  </div>

                </div>

                <div class="md:col-span-2 mt-2">
                  <div class="w-full">
                    <label for="sku">SKU

                    </label>

                    <div class="relative mb-2  mt-2">
                      <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                          version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512"
                          x="0" y="0" viewBox="0 0 469.336 469.336" style="enable-background:new 0 0 512 512"
                          xml:space="preserve" class="">
                          <g>
                            <path
                              d="m456.836 76.168-64-64.054c-16.125-16.139-44.177-16.17-60.365.031L45.763 301.682a10.733 10.733 0 0 0-2.688 4.587L.409 455.73a10.682 10.682 0 0 0 10.261 13.606c.979 0 1.969-.136 2.927-.407l149.333-42.703a10.714 10.714 0 0 0 4.583-2.69l289.323-286.983c8.063-8.069 12.5-18.787 12.5-30.192s-4.437-22.124-12.5-30.193zM285.989 89.737l39.264 39.264-204.996 204.997-14.712-29.434a10.671 10.671 0 0 0-9.542-5.896H78.921L285.989 89.737zm-259.788 353.4L40.095 394.5l34.742 34.742-48.636 13.895zm123.135-35.177-51.035 14.579-51.503-51.503 14.579-51.035h28.031l18.385 36.771a10.671 10.671 0 0 0 4.771 4.771l36.771 18.385v28.032zm21.334-17.543v-17.082c0-4.042-2.281-7.729-5.896-9.542l-29.434-14.712 204.996-204.996 39.264 39.264-208.93 207.068zM441.784 121.72l-47.033 46.613-93.747-93.747 46.582-47.001c8.063-8.063 22.104-8.063 30.167 0l64 64c4.031 4.031 6.25 9.385 6.25 15.083s-2.219 11.052-6.219 15.052z"
                              fill="#9F9F9F" opacity="1" data-original="#000000" class=""></path>
                          </g>
                        </svg>
                      </div>
                      <input type="text" id="opcion-form-skuo-{{ $subproducto->id }}" data-name="sku"
                        name="opcion-form-sku-{{ $subproducto->id }}" value="{{ $subproducto->sku }}"
                        class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="# de sku">


                    </div>
                  </div>

                </div>

                <div class="md:col-span-5 mt-2">
                  <div class=" flex items-end justify-between gap-2 ">
                    <label for="especificacion">Especificacion </label>
                    <button type="button" id="AddEspecifiacion-opcion-{{ $subproducto->id }}"
                      class="text-blue-500 hover:underline focus:outline-none font-medium">
                      Agregar Especificacion
                    </button>
                  </div>

                  <div class="flex flex-col gap-2">

                    <x-especifications id="{{ $subproducto->id }}" :items="$subproductosEspeccifications" />
                  </div>


                </div>
                <div class="md:col-span-5 mt-2">
                  <div class="flex justify-between gap-5">
                    @foreach ($subproducto->images as $item)
                      <div id="portada-{{ $item->id }}" class="relative group shadow-xl">
                        <div class="absolute top-0 left-0 bottom-0 right-0 hover:backdrop-blur-md transition-all ">
                          <i onclick="borrarImg({{ $item->id }})" data-tippy-content="Eliminar Imagen" tippy
                            class="hidden group-hover:block absolute top-0 right-0 m-2 w-5 cursor-pointer fa-regular fa-trash-can z-10  transition-all"></i>

                          <!-- Botón de editar (Agrega tu propia función de onclick y ajusta el icono según necesites) -->
                          <label for="input-file-{{ $item->id }}" data-tippy-content="Editar Imagen" tippy
                            class="hidden group-hover:block absolute top-0 right-8 m-2 w-5 cursor-pointer fa-solid fa-camera-rotate z-10  transition-all"></label>
                        </div>

                        <input type="file" id="input-file-{{ $item->id }}"
                          name="input-file-{{ $item->id }}" style="display: none;"
                          data-img="#portada-{{ $item->id }} img">
                        <!-- Botón de eliminar -->


                        <!-- Imagen -->
                        <img src="{{ asset($item->name_imagen) }}" alt=""
                          class="w-24  hover:blur-sm object-cover">
                      </div>
                    @endforeach

                  </div>

                </div>

                <div class="md:col-span-5 gap-4">
                  <div class="flex  flex-col gap-4 p-2">
                    <label for="caratula">Caratula</label>
                    <input class="hidden" type="radio" name="opcion-form-caratula" value="{{ $subproducto->id }}"
                      data-name="caratula" checked>
                  </div>

                  <div class="flex flex-col gap-4">
                    <input id="imagen" name="opcion-form-imagenP-{{ $subproducto->id }}"
                      data-name="imagenP-{{ $subproducto->id }}"
                      class="p-2.5 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                      aria-describedby="user_avatar_help" id="user_avatar" type="file">
                    <div class="dropzone border-gray-300 " id="option-drop-{{ $subproducto->id }}"
                      name="opcion-attrid-{{ $subproducto->id }}" data-name="attrid-{{ $subproducto->id }}">
                    </div>

                  </div>

                </div>

              </div>
            @endforeach
            {{-- Fin foreach --}}

          </div>

          <div class="md:col-span-5 text-right mt-6 flex justify-between px-4 pb-4">
            <div class="inline-flex items-end">
              <a href="{{ URL::previous() }}"
                class="bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">Volver</a>
            </div>
            <div class="inline-flex items-end">
              <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                Actualizar
              </button>
            </div>
          </div>
        </div>
      </div>

    </form>


  </div>
  <script>
    $('#tags_id').select2();
  </script>
  <script>
    let contenidoId = $("[id^='div-form-opcion']").length + 1

    // let contenidoId = 1
    $('#agregarOpciones').on('click', function() {
      let contenidoOpcion = devolverContenido(contenidoId)
      $('#OpcionesContainer').append(contenidoOpcion)
      instanciaQuills(contenidoId)
      initializarDropzone(contenidoId)
      contenidoId++
    })

    function devolverContenido(idContenido) {
      console.log('esta pintando este copntenido ');

      let html = `

      <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5" id="div-form-opcion-${idContenido}">
        <div class="md:col-span-5">
          <button type="button" class=" ml-2 bg-red-500 justify-self-center text-white px-4 h-10 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full  eliminarOpcion" style="  position: absolute;  right: 6%;">

            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
            </svg>

          </button>

        </div>

        <div class="md:col-span-5">


          <h4 id="opcion-form-opcionComplemento-${idContenido}" class="font-semibold  dark:text-slate-100 text-xl tracking-tight  text-white bg-[#ff3579] px-2  py-2 rounded inline-flex items-center justify-center">
            Opcion </h4>
        </div>

        <div class="md:col-span-2">
          <label for="costo_x_art">Opcion</label>
          <div class="relative mb-2  mt-2">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" width="512" height="512" x="0" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
              </svg>
            </div>
            <select name="opcion-form-tipo_prodct-${idContenido}" data-name="tipo_prodct" id="opcion-form-tipo_prodct-${idContenido}" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('categoria_id') is-invalid @enderror">
              <option value="">Seleccionar Categoria </option>
              @foreach ($tipo as $item)
              @if ($item->is_default)
              {{-- <option value="{{ $item->id }}" selected> {{ $item->name }}</option> --}}
              @else
              <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endif
              @endforeach

            </select>
            @error('tipo_prodct')
            <div style="color: red;">{{ $message }}</div>
            @enderror
          </div>
        </div>
        <div class="md:col-span-3 flex justify-between gap-4">

          <div class="w-full">
            <label for="precio">Precio <span class="text-red-500"> (Obligatorio) </span></label>
            <div class="relative mb-2  mt-2">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" width="512" height="512" x="0" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>

              </div>
              <input type="number" id="opcion-form-precio-${idContenido}" data-name="precio" name="opcion-form-precio-${idContenido}" value="" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('precio') is-invalid @enderror" placeholder="precio">
              @error('precio')
              <div style="color: red;">{{ $message }}</div>
              @enderror
            </div>

          </div>

          <div class="w-full">
            <label for="descuento">Descuento</label>
            <div class="relative mb-2  mt-2">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" width="512" height="512" x="0" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
              </div>
              <input type="number" id="opcion-form-descuento-${idContenido}" data-name="descuento" name="opcion-form-descuento-${idContenido}" value="0" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('descuento') is-invalid @enderror" placeholder="descuento">
              @error('descuento')
              <div style="color: red;">{{ $message }}</div>
              @enderror
            </div>

          </div>

        </div>

        <div class="md:col-span-2 mt-2">
          <div class="w-full">
            <label for="sku">SKU

            </label>

            <div class="relative mb-2  mt-2">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 469.336 469.336" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                  <g>
                    <path d="m456.836 76.168-64-64.054c-16.125-16.139-44.177-16.17-60.365.031L45.763 301.682a10.733 10.733 0 0 0-2.688 4.587L.409 455.73a10.682 10.682 0 0 0 10.261 13.606c.979 0 1.969-.136 2.927-.407l149.333-42.703a10.714 10.714 0 0 0 4.583-2.69l289.323-286.983c8.063-8.069 12.5-18.787 12.5-30.192s-4.437-22.124-12.5-30.193zM285.989 89.737l39.264 39.264-204.996 204.997-14.712-29.434a10.671 10.671 0 0 0-9.542-5.896H78.921L285.989 89.737zm-259.788 353.4L40.095 394.5l34.742 34.742-48.636 13.895zm123.135-35.177-51.035 14.579-51.503-51.503 14.579-51.035h28.031l18.385 36.771a10.671 10.671 0 0 0 4.771 4.771l36.771 18.385v28.032zm21.334-17.543v-17.082c0-4.042-2.281-7.729-5.896-9.542l-29.434-14.712 204.996-204.996 39.264 39.264-208.93 207.068zM441.784 121.72l-47.033 46.613-93.747-93.747 46.582-47.001c8.063-8.063 22.104-8.063 30.167 0l64 64c4.031 4.031 6.25 9.385 6.25 15.083s-2.219 11.052-6.219 15.052z" fill="#9F9F9F" opacity="1" data-original="#000000" class=""></path>
                  </g>
                </svg>
              </div>
              <input type="text" id="opcion-form-sku-${idContenido}" data-name="sku" name="opcion-form-sku-${idContenido}" value="skudefecto" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="# de sku">


            </div>
          </div>

        </div>

        <div class="md:col-span-5 mt-2">
          <div class=" flex items-end justify-between gap-2 ">
            <label for="especificacion">Especificacion </label>
            <button type="button" id="AddEspecifiacion-opcion-${idContenido}" class="text-blue-500 hover:underline focus:outline-none font-medium">
              Agregar Especificacion
            </button>
          </div>

          <div class="flex gap-2">
            <div class="relative mb-2  mt-2">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 469.336 469.336" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                  <g>
                    <path d="m456.836 76.168-64-64.054c-16.125-16.139-44.177-16.17-60.365.031L45.763 301.682a10.733 10.733 0 0 0-2.688 4.587L.409 455.73a10.682 10.682 0 0 0 10.261 13.606c.979 0 1.969-.136 2.927-.407l149.333-42.703a10.714 10.714 0 0 0 4.583-2.69l289.323-286.983c8.063-8.069 12.5-18.787 12.5-30.192s-4.437-22.124-12.5-30.193zM285.989 89.737l39.264 39.264-204.996 204.997-14.712-29.434a10.671 10.671 0 0 0-9.542-5.896H78.921L285.989 89.737zm-259.788 353.4L40.095 394.5l34.742 34.742-48.636 13.895zm123.135-35.177-51.035 14.579-51.503-51.503 14.579-51.035h28.031l18.385 36.771a10.671 10.671 0 0 0 4.771 4.771l36.771 18.385v28.032zm21.334-17.543v-17.082c0-4.042-2.281-7.729-5.896-9.542l-29.434-14.712 204.996-204.996 39.264 39.264-208.93 207.068zM441.784 121.72l-47.033 46.613-93.747-93.747 46.582-47.001c8.063-8.063 22.104-8.063 30.167 0l64 64c4.031 4.031 6.25 9.385 6.25 15.083s-2.219 11.052-6.219 15.052z" fill="#9F9F9F" opacity="1" data-original="#000000" class=""></path>
                  </g>
                </svg>
              </div>
              <input type="text" id="specifications-1" name="tittleOp-1" value="" data-name="tittleOp-1" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Titulo">

            </div>
            <div class="relative mb-2  mt-2">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 469.336 469.336" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
                  <g>
                    <path d="m456.836 76.168-64-64.054c-16.125-16.139-44.177-16.17-60.365.031L45.763 301.682a10.733 10.733 0 0 0-2.688 4.587L.409 455.73a10.682 10.682 0 0 0 10.261 13.606c.979 0 1.969-.136 2.927-.407l149.333-42.703a10.714 10.714 0 0 0 4.583-2.69l289.323-286.983c8.063-8.069 12.5-18.787 12.5-30.192s-4.437-22.124-12.5-30.193zM285.989 89.737l39.264 39.264-204.996 204.997-14.712-29.434a10.671 10.671 0 0 0-9.542-5.896H78.921L285.989 89.737zm-259.788 353.4L40.095 394.5l34.742 34.742-48.636 13.895zm123.135-35.177-51.035 14.579-51.503-51.503 14.579-51.035h28.031l18.385 36.771a10.671 10.671 0 0 0 4.771 4.771l36.771 18.385v28.032zm21.334-17.543v-17.082c0-4.042-2.281-7.729-5.896-9.542l-29.434-14.712 204.996-204.996 39.264 39.264-208.93 207.068zM441.784 121.72l-47.033 46.613-93.747-93.747 46.582-47.001c8.063-8.063 22.104-8.063 30.167 0l64 64c4.031 4.031 6.25 9.385 6.25 15.083s-2.219 11.052-6.219 15.052z" fill="#9F9F9F" opacity="1" data-original="#000000" class=""></path>
                  </g>
                </svg>
              </div>
              <input type="text" id="specifications" name="specificationsOp-1" value="" data-name="specificationsOp-1" class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Valor">

            </div>
          </div>


        </div>

        <div class="md:col-span-5 gap-4">
          <div class="flex  flex-col gap-4 p-2">
            <label for="caratula">Caratula</label>
            <input class="hidden" type="radio" name="opcion-form-caratula" value="${idContenido}" data-name="caratula" checked>
          </div>

          <div class="flex flex-col gap-4">
            <input id="imagen" name="opcion-form-imagenP-${idContenido}" data-name="imagenP-${idContenido}"
              class="p-2.5 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
              aria-describedby="user_avatar_help" id="user_avatar" type="file">
            <div class="dropzone border-gray-300 dropzoneSecond " id="option-drop-${idContenido}"
              name="opcion-attrid-${idContenido}" data-name="attrid-${idContenido}">
            </div>

          </div>

        </div>
        <div class="md:col-span-5 mt-2">
          <input id="quill-Inputopcion-${idContenido}" hidden="true" name="quill-opcion-${idContenido}" data-name="description" />

          <div id="quill-opcion-${idContenido}" name="quill-opcion-${idContenido}"
            class="h-60 mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
            placeholder="Descripción"></div>

        </div>

      </div>
      
      `


      return html
    }

    function instanciaQuills(contenidoId) {
      const quill = new Quill(`#quill-opcion-${contenidoId}`, {
        theme: 'snow',
        modules: {
          toolbar: [
            [{
              font: []
            }, {
              size: []
            }],
            ["bold", "italic", "underline", "strike"],
            [{
              color: []
            }, {
              background: []
            }],
            [{
              script: "super"
            }, {
              script: "sub"
            }],
            [{
              header: [!1, 1, 2, 3, 4, 5, 6]
            }, "blockquote", "code-block"],
            [{
              list: "ordered"
            }, {
              list: "bullet"
            }, {
              indent: "-1"
            }, {
              indent: "+1"
            }],
            ["direction", {
              align: []
            }],
            ["link", "image", "video"],
            ["clean"]
          ]
        }
      });


      quill.on('text-change', function(delta, oldDelta, source) {
        if (source === 'user') {

          // Obtener el contenido HTML actual del editor
          var html = quill.root.innerHTML;

          // Crear un elemento temporal para manipular el contenido HTML
          var tempElem = document.createElement('div');
          tempElem.innerHTML = html;

          // Aplicar clases de Tailwind CSS a los encabezados dentro del contenido HTML
          ['h1', 'h2', 'h3'].forEach(function(tagName) {
            var elements = tempElem.getElementsByTagName(tagName);
            for (var i = 0; i < elements.length; i++) {
              // Aplicar clases según el tipo de encabezado
              if (tagName === 'h1') {
                elements[i].classList.add('text-4xl', 'font-bold', 'mt-4', 'mb-2');
              } else if (tagName === 'h2') {
                elements[i].classList.add('text-3xl', 'font-semibold', 'mt-3', 'mb-2');
              } else if (tagName === 'h3') {
                elements[i].classList.add('text-2xl', 'font-medium', 'mt-3', 'mb-1');
              }
            }
          });


          $(`#quill-Inputopcion-${contenidoId}`).attr('value', tempElem.innerHTML);
        }
      });


    }

    function initializarDropzone(id) {
      let selector = `#option-drop-${id}`
      console.log(selector)
      new Dropzone(selector, {
        url: 'https://httpbin.org/post',

        autoProcessQueue: false,
        thumbnailWidth: 160,
        previewTemplate: DropzoneTemplates.previewTemplate,
        init: function() {
          this.on('success', function(file, responseText) {
            console.log(responseText);
          });
          let container = 0
          this.on('addedfile', async (file) => {
            console.log('addedfile', file)
            if (container < 5) {
              container++
              console.log(container)
              const input = document.createElement('input')
              input.name = 'filesGallery[]'
              input.value = await File.toBase64(file)
              input.type = 'hidden'
              //agregar atributo  data-name
              input.id = `opcion-attrid-${id}`
              input.setAttribute('data-name', `attrid-${id}`)


              $(selector).append($(input))
              // Showing file preview if it is not image
              if (file.type && !file.type.match(/image.*/)) {
                if (!file.documentPrev) {
                  file.previewTemplate.classList.remove('dz-image-preview');
                  file.previewTemplate.classList.add('dz-file-preview');
                  file.previewTemplate.classList.add('dz-complete');
                  file.documentPrev = true;
                  this.emit('addedfile', file);
                  this.removeFile(file);


                }
              }
            }

          });

          this.element.classList.add('dz-started');


        },
      });


    }
  </script>



  <script>
    function toggleMenu() {
      console.log('cambiando toggle')
      var menuItems = document.getElementById('menu-items');
      var isExpanded = menuItems.classList.contains('hidden');
      menuItems.classList.toggle('hidden', !isExpanded);
      document.getElementById('menu-button').setAttribute('aria-expanded', !isExpanded);
    }
  </script>


  <script>
    $('document').ready(function() {
      let valorInput = 1

      $("#AddEspecifiacion").on('click', function(e) {
        e.preventDefault()
        valorInput++

        const addButton = document.getElementById("AddEspecifiacion");
        const divFlex = document.createElement("div");
        const dRelative = document.createElement("div");
        const dRelative2 = document.createElement("div");

        divFlex.classList.add('flex', 'gap-2')
        dRelative.classList.add('relative', 'mb-2', 'mt-2')
        dRelative2.classList.add('relative', 'mb-2', 'mt-2')

        const iconContainer = document.createElement("div");
        const icon = `<div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                        version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0"
                        y="0" viewBox="0 0 469.336 469.336" style="enable-background:new 0 0 512 512"
                        xml:space="preserve" class="">
                        <g>
                            <path
                            d="m456.836 76.168-64-64.054c-16.125-16.139-44.177-16.17-60.365.031L45.763 301.682a10.733 10.733 0 0 0-2.688 4.587L.409 455.73a10.682 10.682 0 0 0 10.261 13.606c.979 0 1.969-.136 2.927-.407l149.333-42.703a10.714 10.714 0 0 0 4.583-2.69l289.323-286.983c8.063-8.069 12.5-18.787 12.5-30.192s-4.437-22.124-12.5-30.193zM285.989 89.737l39.264 39.264-204.996 204.997-14.712-29.434a10.671 10.671 0 0 0-9.542-5.896H78.921L285.989 89.737zm-259.788 353.4L40.095 394.5l34.742 34.742-48.636 13.895zm123.135-35.177-51.035 14.579-51.503-51.503 14.579-51.035h28.031l18.385 36.771a10.671 10.671 0 0 0 4.771 4.771l36.771 18.385v28.032zm21.334-17.543v-17.082c0-4.042-2.281-7.729-5.896-9.542l-29.434-14.712 204.996-204.996 39.264 39.264-208.93 207.068zM441.784 121.72l-47.033 46.613-93.747-93.747 46.582-47.001c8.063-8.063 22.104-8.063 30.167 0l64 64c4.031 4.031 6.25 9.385 6.25 15.083s-2.219 11.052-6.219 15.052z"
                            fill="#9F9F9F" opacity="1" data-original="#000000" class=""></path>
                        </g>
                        </svg>
                    </div>`
        iconContainer.innerHTML = icon;

        // Obtener el nodo del icono
        const iconNode = iconContainer.firstChild;



        const inputTittle = document.createElement("input");
        const inputValue = document.createElement("input");

        let inputT = agregarElementos(inputTittle, valorInput, 'tittle')
        let inputV = agregarElementos(inputValue, valorInput, 'specifications')


        dRelative.appendChild(inputT);
        dRelative2.appendChild(inputV);


        // Agregar el icono como primer hijo de dRelative
        dRelative.insertBefore(iconNode, inputT);

        // Clonar el nodo del icono para agregarlo como primer hijo de dRelative2
        const iconNodeCloned = iconNode.cloneNode(true);
        dRelative2.insertBefore(iconNodeCloned, inputV);


        divFlex.appendChild(dRelative);
        divFlex.appendChild(dRelative2);

        const parentContainer = addButton.parentElement
          .parentElement; // Obtener el contenedor padre
        parentContainer.insertBefore(divFlex, addButton.parentElement
          .nextSibling); // Insertar el input antes del siguiente elemento después del botón

      })
    })
  </script>

  <script>
    $(document).on('click', '.eliminarConvinacion', function(e) {
      console.log(e.target)
      e.preventDefault()

      let targetButton = e.target.closest('button.eliminarConvinacion');
      $(`#${targetButton.value}`).remove()

    })

    function capitalizeFirstLetter(string) {
      return string.charAt(0).toUpperCase() + string.slice(1);
    }

    function agregarCombinacion(elemento, valorInput, name) {
      elemento.setAttribute("type", "text");
      elemento.setAttribute("name", `updateComb-${valorInput}[${name}]`);
      elemento.setAttribute("placeholder", `${capitalizeFirstLetter(name)}`);
      elemento.setAttribute("id", `${name}-${valorInput}`);

      let valorAtributo = @json($valorAtributo);
      let switchColor = $('.btn_swithc:checked')
      const noSwitchActive = switchColor.length === 0;

      const optionElement = document.createElement("option");
      optionElement.setAttribute("value", "0");
      optionElement.textContent = name == 'color' ? 'Color' : "Talla";
      elemento.appendChild(optionElement);

      if (name == 'color') {
        valorAtributo.forEach(optionText => {
          if (optionText.attribute_id == 2) {
            const optionElement = document.createElement("option");

            optionElement.setAttribute("value", optionText.id);

            optionElement.setAttribute('hidden', true);


            const serviceId = optionText.id; // Assuming id in optionsData matches data-idService
            // const correspondingSwitch = $(`.btn_switch[data-idService=${serviceId}]`);

            switchColor.each(function() {
              const idService = $(this).data('idservice');
              console.log(idService, serviceId)
              if (idService === serviceId) {
                optionElement.removeAttribute('hidden');
              }
            })




            optionElement.textContent = optionText.valor;
            elemento.appendChild(optionElement);
          }



        });




      } else {

        valorAtributo.forEach(optionText => {
          if (optionText.attribute_id == 1) {
            const optionElement = document.createElement("option");
            optionElement.setAttribute("value", optionText.id);
            optionElement.textContent = optionText.valor;
            elemento.appendChild(optionElement);
          }

        });

      }



      elemento.classList.add("mt-1", "bg-gray-50", "border", "border-gray-300", "text-gray-900", "text-sm",
        "rounded-lg",
        "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "p-2.5",
        "dark:bg-gray-700",
        "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white",
        "dark:focus:ring-blue-500",
        "dark:focus:border-blue-500");

      return elemento
    }

    function agregarinputStock(elemento, valorInput, name) {
      elemento.setAttribute("type", "text");
      elemento.setAttribute("name", `updateComb-${valorInput}[stock]`);
      elemento.setAttribute("placeholder", `${capitalizeFirstLetter(name)}`);
      elemento.setAttribute("id", `${name}-${valorInput}`);


      elemento.classList.add("mt-1", "bg-gray-50", "border", "border-gray-300", "text-gray-900", "text-sm",
        "rounded-lg",
        "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "p-2.5",
        "dark:bg-gray-700",
        "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white",
        "dark:focus:ring-blue-500",
        "dark:focus:border-blue-500");

      return elemento

    }
    let valorInput = 1
    $("#AddCombinacion").on('click', function(e) {
      e.preventDefault()
      valorInput++

      const addButton = document.getElementById("AddCombinacion");
      const divFlex = document.createElement("div");
      const dRelative = document.createElement("div");
      const dRelative2 = document.createElement("div");
      const dRelative3 = document.createElement("div");

      divFlex.id = `combination-${valorInput}`;

      divFlex.classList.add('grid', 'grid-cols-4', 'gap-2', 'items-center', 'justify-center')
      dRelative.classList.add('mb-2', 'mt-2')
      dRelative2.classList.add('mb-2', 'mt-2')
      dRelative3.classList.add('mb-2', 'mt-2')

      const iconContainer = document.createElement("div");
      const icon = `<div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                      version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0"
                      y="0" viewBox="0 0 469.336 469.336" style="enable-background:new 0 0 512 512"
                      xml:space="preserve" class="">
                      <g>
                        <path
                          d="m456.836 76.168-64-64.054c-16.125-16.139-44.177-16.17-60.365.031L45.763 301.682a10.733 10.733 0 0 0-2.688 4.587L.409 455.73a10.682 10.682 0 0 0 10.261 13.606c.979 0 1.969-.136 2.927-.407l149.333-42.703a10.714 10.714 0 0 0 4.583-2.69l289.323-286.983c8.063-8.069 12.5-18.787 12.5-30.192s-4.437-22.124-12.5-30.193zM285.989 89.737l39.264 39.264-204.996 204.997-14.712-29.434a10.671 10.671 0 0 0-9.542-5.896H78.921L285.989 89.737zm-259.788 353.4L40.095 394.5l34.742 34.742-48.636 13.895zm123.135-35.177-51.035 14.579-51.503-51.503 14.579-51.035h28.031l18.385 36.771a10.671 10.671 0 0 0 4.771 4.771l36.771 18.385v28.032zm21.334-17.543v-17.082c0-4.042-2.281-7.729-5.896-9.542l-29.434-14.712 204.996-204.996 39.264 39.264-208.93 207.068zM441.784 121.72l-47.033 46.613-93.747-93.747 46.582-47.001c8.063-8.063 22.104-8.063 30.167 0l64 64c4.031 4.031 6.25 9.385 6.25 15.083s-2.219 11.052-6.219 15.052z"
                          fill="#9F9F9F" opacity="1" data-original="#000000" class=""></path>
                      </g>
                    </svg>
                  </div>`
      iconContainer.innerHTML = icon;

      // Obtener el nodo del icono
      const iconNode = iconContainer.firstChild;



      const deleteButton = document.createElement("button");
      deleteButton.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
            `;
      deleteButton.className =
        "ml-2 bg-red-500 justify-self-center text-white px-4 h-10 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full  eliminarConvinacion";
      deleteButton.setAttribute('value', `combination-${valorInput}`)
      deleteButton.onclick = function(e) {
        e.preventDefault()

      };
      const inputTittle = document.createElement("select");
      const inputValue = document.createElement("select");
      const inputStock = document.createElement("input")

      let inputT = agregarCombinacion(inputTittle, valorInput, 'color')
      let inputV = agregarCombinacion(inputValue, valorInput, 'talla')
      let inputS = agregarinputStock(inputStock, valorInput, 'stock')


      dRelative.appendChild(inputT);
      dRelative2.appendChild(inputV);
      dRelative3.appendChild(inputS);


      // Agregar el icono como primer hijo de dRelative
      // dRelative.insertBefore(iconNode, inputT);

      // Clonar el nodo del icono para agregarlo como primer hijo de dRelative2
      // const iconNodeCloned = iconNode.cloneNode(true);
      // dRelative2.insertBefore(iconNodeCloned, inputV);
      // dRelative3.insertBefore(iconNodeCloned, inputS);


      divFlex.appendChild(dRelative);
      divFlex.appendChild(dRelative2);
      divFlex.appendChild(dRelative3);
      divFlex.appendChild(deleteButton);

      const parentContainer = addButton.parentElement
        .parentElement; // Obtener el contenedor padre
      parentContainer.insertBefore(divFlex, addButton.parentElement
        .nextSibling); // Insertar el input antes del siguiente elemento después del botón



    })
  </script>
  <script>
    $(document).ready(function() {
      $('.btn_swithc').change(function(e) {

        let idService = $(this).attr('data-idService');


        if ($(this).is(':checked')) {
          $(`#imagenesOcultas-${idService}`).removeAttr('hidden');
        } else {
          $(`#imagenesOcultas-${idService}`).attr('hidden', true);
        }
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      function initializeDropzone(element, nameValue) {


        new Dropzone(element, {
          url: 'https://httpbin.org/post',

          autoProcessQueue: false,
          thumbnailWidth: 160,
          previewTemplate: DropzoneTemplates.previewTemplate,
          init: function() {
            this.on('success', function(file, responseText) {
              console.log(responseText);
            });
            let container = 0
            this.on('addedfile', async (file) => {
              console.log('addedfile', file)
              if (container < 5) {
                container++
                console.log(container)
                const input = document.createElement('input')
                input.name = `${nameValue}[]`
                input.value = await File.toBase64(file)
                input.type = 'hidden'


                $(element).append($(input))
                // Showing file preview if it is not image
                if (file.type && !file.type.match(/image.*/)) {
                  if (!file.documentPrev) {
                    file.previewTemplate.classList.remove('dz-image-preview');
                    file.previewTemplate.classList.add('dz-file-preview');
                    file.previewTemplate.classList.add('dz-complete');
                    file.documentPrev = true;
                    this.emit('addedfile', file);
                    this.removeFile(file);


                  }
                }
              }

            });


            this.element.classList.add('dz-started');


          },
        });
      }

      function initializeAllDropzones() {
        $('.dropzoneSecond').each(function() {


          let $element = $(this);
          let nameValue = $element.attr('name');
          console.log(nameValue);
          initializeDropzone(this, nameValue);
        });
      }

      initializeAllDropzones();

    })
  </script>
  <script>
    File.toBase64 = function(blob) {
      return new Promise((resolve, reject) => {
        let reader = new FileReader();
        reader.onloadend = () => {
          resolve(reader.result);
        }
        reader.onerror = () => {
          reject(new Error('No se pudo convertir el archivo en base64'));
        }
        reader.readAsDataURL(blob);
      });
    }
  </script>
  <script>
    function borrarImg(id) {
      console.log('borranmdo ', id)

      $.ajax({
        url: "{{ route('activity.borrarimg') }}",
        method: 'POST',
        data: {
          _token: $('input[name="_token"]').val(),
          status: status,
          id: id,

        },
        success: function(success) {
          Swal.fire({

            icon: "success",
            title: 'Img borrada exitosamente',
            showConfirmButton: false,
            timer: 1500

          });
          $(`#portada-${id}`).remove()
        },
        error: function(error) {
          console.log(error)
        }

      })




    }

    $(document).on('change', "[id^='input-file-']", function() {
      var file = this.files[0];
      var uri = URL.createObjectURL(file);
      var img = this.getAttribute('data-img');
      $(img).attr('src', uri);
    })
  </script>
  <script>
    $('document').ready(function() {
      const quillElements = document.querySelectorAll('[id^="quill-opcion-"]');

      quillElements.forEach(element => {
        // Inicializa Quill en el elemento
        const quill = new Quill(element, {
          theme: 'snow',
          modules: {
            toolbar: [
              [{
                font: []
              }, {
                size: []
              }],
              ["bold", "italic", "underline", "strike"],
              [{
                color: []
              }, {
                background: []
              }],
              [{
                script: "super"
              }, {
                script: "sub"
              }],
              [{
                header: [!1, 1, 2, 3, 4, 5, 6]
              }, "blockquote", "code-block"],
              [{
                list: "ordered"
              }, {
                list: "bullet"
              }, {
                indent: "-1"
              }, {
                indent: "+1"
              }],
              ["direction", {
                align: []
              }],
              ["link", "image", "video"],
              ["clean"]
            ]
          }
        });

        quill.on('text-change', function(delta, oldDelta, source) {
          // Obtiene el ID del Quill que originó el cambio
          const quillId = element.id;
          console.log(quillId)
          // Construye el ID del input relacionado
          const inputId = 'quill-Inputopcion-' + quillId.substring('quill-opcion-'.length);
          console.log(inputId)
          // Actualiza el valor del input correspondiente
          // document.getElementById(inputId).value = quill.root.innerHTML;

          if (source === 'user') {

            // Obtener el contenido HTML actual del editor
            var html = quill.root.innerHTML;

            // Crear un elemento temporal para manipular el contenido HTML
            var tempElem = document.createElement('div');
            tempElem.innerHTML = html;

            // Aplicar clases de Tailwind CSS a los encabezados dentro del contenido HTML
            ['h1', 'h2', 'h3'].forEach(function(tagName) {
              var elements = tempElem.getElementsByTagName(tagName);
              for (var i = 0; i < elements.length; i++) {
                // Aplicar clases según el tipo de encabezado
                if (tagName === 'h1') {
                  elements[i].classList.add('text-4xl', 'font-bold', 'mt-4', 'mb-2');
                } else if (tagName === 'h2') {
                  elements[i].classList.add('text-3xl', 'font-semibold', 'mt-3', 'mb-2');
                } else if (tagName === 'h3') {
                  elements[i].classList.add('text-2xl', 'font-medium', 'mt-3', 'mb-1');
                }
              }
            });


            $(`#${inputId}`).attr('value', tempElem.innerHTML);
          }
        });
      })


    })
    $(document).on('click', '.eliminarOpcion', function() {
      const form = $(this).closest('[id^="div-form-opcion-"]');
      const formId = form.attr('id');
      const idForm = formId.replace('div-form-opcion-', ''); // Simplifica la obtención del ID

      console.log(idForm);

      const token = $('input[name="_token"]').val(); // Extrae el token una sola vez

      $.ajax({
        url: "{{ route('products.deleteOption') }}",
        method: 'POST',
        data: {
          _token: token,
          id: idForm,
        },
        success: () => { // Usa arrow function para mantener el contexto de `this`
          Swal.fire({
            icon: "success",
            title: 'Opción borrada exitosamente',
            showConfirmButton: false,
            timer: 1500
          });
          form.remove(); // Elimina el formulario directamente
        },
        error: (error) => { // Usa arrow function para mantener el contexto de `this`
          console.error(error); // Usa console.error para errores
        }
      });
    });
  </script>

  <script>
    function eliminarEspecificacionOpcion(id) {
      const padre = document.getElementById('padreEspcificaciones-' + id);

      $.ajax({
        url: "{{ route('products.deleteEspect') }}",
        method: 'POST',
        data: {
          _token: $('input[name="_token"]').val(),

          id: id,

        },
        success: function(success) {
          Swal.fire({

            icon: "success",
            title: 'Espcificacion eliminada',
            showConfirmButton: false,
            timer: 2500

          });
          padre.remove();
        },
        error: function(error) {
          console.log(error)
        }

      })

    }

    function guardarSpec(selector) {
      console.log(selector)
      //ajax para guardar la especificacion
      let id = selector.replace('AddEspecifiacion-opcion-', '')

      let link = $(`#guardar-${selector}`)
      let parent = link.parent()

      let tittle = parent.find('input[name^="tittle"]')
      let specifications = parent.find('input[name^="specifications"]')

      $.ajax({
        url: "{{ route('products.saveSpec') }}",
        method: 'POST',
        data: {
          _token: $('input[name="_token"]').val(),
          tittle: tittle.val(),
          specifications: specifications.val(),
          product_id: id
        },
        success: function({
          especificacion
        }) {


          //actualizar propiedad name y dataname de los inputs
          tittle.get(0).setAttribute('name', `tittleOp-${especificacion.id}`)
          specifications.get(0).setAttribute('name', `specificationsOp-${especificacion.id}`)
          Swal.fire({

            icon: "success",
            title: 'Espcificacion guardada',
            showConfirmButton: false,
            timer: 2500

          });
          link.remove()
        },
        error: function(error) {
          console.log(error)
        }

      })


    }

    function agregarEspecificacion(selector) {
      valorInput++
      console.log('agregando especificacion component')

      const addButton = document.getElementById(selector);
      const divFlex = document.createElement("div");
      const dRelative = document.createElement("div");
      const dRelative2 = document.createElement("div");

      const linkSave = document.createElement("a");
      linkSave.innerHTML = 'Guardar'
      linkSave.classList.add('text-blue-500', 'hover:underline', 'focus:outline-none', 'font-medium', 'cursor-pointer')
      linkSave.id = `guardar-${selector}`
      //AddEspecifiacion-opcion
      //agregarle el onclick para llamar a la funcion guardarSpec 
      linkSave.setAttribute('onclick', `guardarSpec('${selector}')`)




      divFlex.classList.add('flex', 'gap-2')
      dRelative.classList.add('relative', 'mb-2', 'mt-2')
      dRelative2.classList.add('relative', 'mb-2', 'mt-2')

      const iconContainer = document.createElement("div");
      const icon = `<div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                      version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0"
                      y="0" viewBox="0 0 469.336 469.336" style="enable-background:new 0 0 512 512"
                      xml:space="preserve" class="">
                      <g>
                        <path
                          d="m456.836 76.168-64-64.054c-16.125-16.139-44.177-16.17-60.365.031L45.763 301.682a10.733 10.733 0 0 0-2.688 4.587L.409 455.73a10.682 10.682 0 0 0 10.261 13.606c.979 0 1.969-.136 2.927-.407l149.333-42.703a10.714 10.714 0 0 0 4.583-2.69l289.323-286.983c8.063-8.069 12.5-18.787 12.5-30.192s-4.437-22.124-12.5-30.193zM285.989 89.737l39.264 39.264-204.996 204.997-14.712-29.434a10.671 10.671 0 0 0-9.542-5.896H78.921L285.989 89.737zm-259.788 353.4L40.095 394.5l34.742 34.742-48.636 13.895zm123.135-35.177-51.035 14.579-51.503-51.503 14.579-51.035h28.031l18.385 36.771a10.671 10.671 0 0 0 4.771 4.771l36.771 18.385v28.032zm21.334-17.543v-17.082c0-4.042-2.281-7.729-5.896-9.542l-29.434-14.712 204.996-204.996 39.264 39.264-208.93 207.068zM441.784 121.72l-47.033 46.613-93.747-93.747 46.582-47.001c8.063-8.063 22.104-8.063 30.167 0l64 64c4.031 4.031 6.25 9.385 6.25 15.083s-2.219 11.052-6.219 15.052z"
                          fill="#9F9F9F" opacity="1" data-original="#000000" class=""></path>
                      </g>
                    </svg>
                  </div>`
      iconContainer.innerHTML = icon;

      // Obtener el nodo del icono
      const iconNode = iconContainer.firstChild;



      const inputTittle = document.createElement("input");
      const inputValue = document.createElement("input");

      let inputT = agregarElementos(inputTittle, valorInput, 'tittle')
      let inputV = agregarElementos(inputValue, valorInput, 'specifications')


      dRelative.appendChild(inputT);
      dRelative2.appendChild(inputV);


      // Agregar el icono como primer hijo de dRelative
      dRelative.insertBefore(iconNode, inputT);

      // Clonar el nodo del icono para agregarlo como primer hijo de dRelative2
      const iconNodeCloned = iconNode.cloneNode(true);
      dRelative2.insertBefore(iconNodeCloned, inputV);


      divFlex.appendChild(dRelative);
      divFlex.appendChild(dRelative2);
      divFlex.appendChild(linkSave);


      const parentContainer = addButton.parentElement
        .parentElement; // Obtener el contenedor padre
      parentContainer.insertBefore(divFlex, addButton.parentElement
        .nextSibling); // Insertar el input antes del siguiente elemento después del botón




    }

    function agregarEspecificacionOP(selector) {
      valorInput++
      console.log('agregando especificacion component')

      const addButton = document.getElementById(selector);
      const divFlex = document.createElement("div");
      const dRelative = document.createElement("div");
      const dRelative2 = document.createElement("div");

      const linkSave = document.createElement("a");
      linkSave.innerHTML = 'Guardar'
      linkSave.classList.add('text-blue-500', 'hover:underline', 'focus:outline-none', 'font-medium', 'cursor-pointer')
      linkSave.id = `guardar-${selector}`
      //AddEspecifiacion-opcion
      //agregarle el onclick para llamar a la funcion guardarSpec 
      linkSave.setAttribute('onclick', `guardarSpec('${selector}')`)




      divFlex.classList.add('flex', 'gap-2')
      dRelative.classList.add('relative', 'mb-2', 'mt-2')
      dRelative2.classList.add('relative', 'mb-2', 'mt-2')

      const iconContainer = document.createElement("div");
      const icon = `<div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                      version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0"
                      y="0" viewBox="0 0 469.336 469.336" style="enable-background:new 0 0 512 512"
                      xml:space="preserve" class="">
                      <g>
                        <path
                          d="m456.836 76.168-64-64.054c-16.125-16.139-44.177-16.17-60.365.031L45.763 301.682a10.733 10.733 0 0 0-2.688 4.587L.409 455.73a10.682 10.682 0 0 0 10.261 13.606c.979 0 1.969-.136 2.927-.407l149.333-42.703a10.714 10.714 0 0 0 4.583-2.69l289.323-286.983c8.063-8.069 12.5-18.787 12.5-30.192s-4.437-22.124-12.5-30.193zM285.989 89.737l39.264 39.264-204.996 204.997-14.712-29.434a10.671 10.671 0 0 0-9.542-5.896H78.921L285.989 89.737zm-259.788 353.4L40.095 394.5l34.742 34.742-48.636 13.895zm123.135-35.177-51.035 14.579-51.503-51.503 14.579-51.035h28.031l18.385 36.771a10.671 10.671 0 0 0 4.771 4.771l36.771 18.385v28.032zm21.334-17.543v-17.082c0-4.042-2.281-7.729-5.896-9.542l-29.434-14.712 204.996-204.996 39.264 39.264-208.93 207.068zM441.784 121.72l-47.033 46.613-93.747-93.747 46.582-47.001c8.063-8.063 22.104-8.063 30.167 0l64 64c4.031 4.031 6.25 9.385 6.25 15.083s-2.219 11.052-6.219 15.052z"
                          fill="#9F9F9F" opacity="1" data-original="#000000" class=""></path>
                      </g>
                    </svg>
                  </div>`
      iconContainer.innerHTML = icon;

      // Obtener el nodo del icono
      const iconNode = iconContainer.firstChild;



      const inputTittle = document.createElement("input");
      const inputValue = document.createElement("input");

      let inputT = agregarElementosOp(inputTittle, valorInput, 'tittleOp')
      let inputV = agregarElementosOp(inputValue, valorInput, 'specificationsOp')


      dRelative.appendChild(inputT);
      dRelative2.appendChild(inputV);


      // Agregar el icono como primer hijo de dRelative
      dRelative.insertBefore(iconNode, inputT);

      // Clonar el nodo del icono para agregarlo como primer hijo de dRelative2
      const iconNodeCloned = iconNode.cloneNode(true);
      dRelative2.insertBefore(iconNodeCloned, inputV);


      divFlex.appendChild(dRelative);
      divFlex.appendChild(dRelative2);
      divFlex.appendChild(linkSave);


      const parentContainer = addButton.parentElement
        .parentElement; // Obtener el contenedor padre
      parentContainer.insertBefore(divFlex, addButton.parentElement
        .nextSibling); // Insertar el input antes del siguiente elemento después del botón




    }

    function agregarElementos(elemento, valorInput, name) {
      elemento.setAttribute("type", "text");
      elemento.setAttribute("name", `${name}-${valorInput}`);
      elemento.setAttribute("placeholder", `${capitalizeFirstLetter(name)}`);
      elemento.setAttribute("id", `${name}-${valorInput}`);
      elemento.setAttribute("data-name", `${name}-${valorInput}`);


      elemento.classList.add("mt-1", "bg-gray-50", "border", "border-gray-300", "text-gray-900", "text-sm",
        "rounded-lg",
        "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "pl-10", "p-2.5",
        "dark:bg-gray-700",
        "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white",
        "dark:focus:ring-blue-500",
        "dark:focus:border-blue-500");

      return elemento
    }

    function agregarElementosOp(elemento, valorInput, name) {
      elemento.setAttribute("type", "text");
      elemento.setAttribute("name", `${name}-${valorInput}`);
      elemento.setAttribute("placeholder", `${capitalizeFirstLetter(name)}`);
      elemento.setAttribute("id", `${name}-${valorInput}`);
      elemento.setAttribute("data-name", `${name}-${valorInput}`);


      elemento.classList.add("mt-1", "bg-gray-50", "border", "border-gray-300", "text-gray-900", "text-sm",
        "rounded-lg",
        "focus:ring-blue-500", "focus:border-blue-500", "block", "w-full", "pl-10", "p-2.5",
        "dark:bg-gray-700",
        "dark:border-gray-600", "dark:placeholder-gray-400", "dark:text-white",
        "dark:focus:ring-blue-500",
        "dark:focus:border-blue-500");

      return elemento
    }
    $(document).on('click', '[id^="AddEspecifiacion-opcion-"]', function(e) {
      let selector = this.id

      e.preventDefault()
      agregarEspecificacionOP(selector)

      //se repite? 
    })
    $('#formularioedit').on('submit', async function(e) {
      e.preventDefault(); // Prevenir el comportamiento por defecto

      var valoresFormularios = []; // Inicializar como arreglo

      const formularios = [...$('div[id^="div-form-opcion-"]')]
      for (const formulario of formularios) {
        let formularioObj = {}; // Objeto para almacenar los valores del formulario actual
        let valoresFormularioActual = {};

        const fields = [...formulario.querySelectorAll('input, select')];



        for (const field of fields) {
          // Verificar si el input actual es de tipo file
          if (field.getAttribute('type') === 'file') {
            // Obtener el archivo seleccionado (o archivos si es múltiple)
            var archivos = field.files[0];
            if (!archivos) {
              continue
            }

            // Asumiendo que quieres usar 'data-name' como clave, como en el resto de inputs
            valoresFormularioActual[field.getAttribute('data-name')] = await File.toBase64(archivos);
          } else {
            // Para otros tipos de inputs, manejar como antes
            if (field.getAttribute('name')?.includes('[]')) {
              if (!valoresFormularioActual[field.getAttribute('data-name')]) {
                valoresFormularioActual[field.getAttribute('data-name')] = [];
              }
              valoresFormularioActual[field.getAttribute('data-name')].push(field.value);
            } else {
              valoresFormularioActual[field.getAttribute('data-name')] = field.value;
            }
          }
        }

        let spectitle = [...formulario.querySelectorAll('[data-name^="tittleOp-"]')]; //
        let specVal = [...formulario.querySelectorAll('[data-name^="specificationsOp-"]')]; //

        let spec = []
        for (let i = 0; i < spectitle.length; i++) {
          let titleIndex = parseInt(spectitle[i].getAttribute('data-name').split('-')[1]);
          let specIndex = parseInt(specVal[i].getAttribute('data-name').split('-')[1]);

          if (titleIndex === specIndex) {
            spec[titleIndex] = {
              tittle: spectitle[i].value,
              specifications: specVal[i].value
            };
          }
        }
        valoresFormularioActual.specifiaciones = spec

        valoresFormularios.push(
          valoresFormularioActual); // Agregar el objeto del formulario actual al arreglo


      } // end for (const formulario of formularios) {





      var jsonValoresFormularios = JSON.stringify(valoresFormularios);
      $('#valoresFormulario').val(jsonValoresFormularios);

      // console.log(valoresFormularios)
      // return

      $(this).unbind('submit').submit(); // Continuar con el envío del formulario
    });

    $(document).ready(function() {
      let opcionesPintadas = $('[id^="div-form-opcion-"]')
      opcionesPintadas.each(function() {
        let id = $(this).attr('id').replace('div-form-opcion-', '')
        console.log(id)

        try {
          initializarDropzone(id)
        } catch (error) {
          console.log(error)
        }
        // initializarDropzone(id)
      })
    })

    function initializarDropzone(id) {
      console.log('inicializando dropzone', id);
      let selector = `#option-drop-${id}`

      new Dropzone(selector, {
        url: 'https://httpbin.org/post',

        autoProcessQueue: false,
        thumbnailWidth: 160,
        previewTemplate: DropzoneTemplates.previewTemplate,
        init: function() {
          this.on('success', function(file, responseText) {
            console.log(responseText);
          });
          let container = 0
          this.on('addedfile', async (file) => {
            console.log('addedfile', file)
            if (container < 5) {
              container++
              console.log(container)
              const input = document.createElement('input')
              input.name = 'filesGallery[]'
              input.value = await File.toBase64(file)
              input.type = 'hidden'
              //agregar atributo  data-name
              input.id = `opcion-attrid-${id}`
              input.setAttribute('data-name', `attrid-${id}`)


              $(selector).append($(input))
              // Showing file preview if it is not image
              if (file.type && !file.type.match(/image.*/)) {
                if (!file.documentPrev) {
                  file.previewTemplate.classList.remove('dz-image-preview');
                  file.previewTemplate.classList.add('dz-file-preview');
                  file.previewTemplate.classList.add('dz-complete');
                  file.documentPrev = true;
                  this.emit('addedfile', file);
                  this.removeFile(file);


                }
              }
            }

          });

          this.element.classList.add('dz-started');


        },
      });


    }
  </script>
  @include('_layout.scripts')

</x-app-layout>
