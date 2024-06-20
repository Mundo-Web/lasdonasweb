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
                        <a href="#" class="font-semibold text-[14px] text-[#141718]">Mi cuenta</a>
                    </div>
                </div>
            </div>
        </section> --}}

    <section class="font-poppins my-8 md:my-16">
      <div class="flex flex-col gap-12 md:flex-row md:gap-16 lg:gap-28 w-full md:w-11/12 mx-auto">
        <div class="bg-[#F3F5F7] md:bg-white py-5 md:py-0">
          <div class="w-11/12 md:w-full mx-auto">
            <div class="basis-5/12 flex flex-col gap-5">
              <div class="flex flex-col gap-5">
                <div class="rounded-full w-24 h-24 bg-[#E9EDEF] flex justify-center items-center relative">
                  <img class="w-full h-full rounded-full" src="{{ Auth::user()->profile_photo_url }}" width="32"
                    height="32" alt="{{ Auth::user()->name }}" />
                  <label for="upload_image"
                    class="bg-bgBlack rounded-full w-7 h-7 flex justify-center items-center absolute bottom-0 right-0 cursor-pointer">
                    <img src="{{ asset('/images/svg/upload_photo.svg') }}" alt="upload photo" />
                  </label>
                  <form action="{{ route('cambiofoto') }}" id="avatarform" method="POST" enctype='multipart/form-data'>
                    @csrf
                    <input type="hidden" name="name" value="{{ $user->id }}">
                    <input type="file" id="upload_image" name="imageuser" accept="image/*" class="hidden" />
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
                    class="text-white  py-2 px-4 rounded-2xl cursor-pointer text-[16px] border-none w-64 flex justify-between items-center group-hover:bg-bgBlack">
                    <p class="font-medium text-[16px] text-[#254678] group-hover:text-white ">
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
                    class="text-white bg-bgBlack py-2 px-4 rounded-2xl cursor-pointer text-[16px] border-none w-64 flex justify-between items-center group-hover:bg-bgBlack">
                    <p class="font-medium text-[16px] text-white ">
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
                        stroke="#151515" stroke-width="1.33333" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="basis-7/12 font-poppins w-11/12 md:w-full mx-auto">
          <h2 class="text-[#151515] font-semibold text-[20px] py-5">
            Historial de pedidos
          </h2>
          <!-- para destop tabla -->
          <div class="hidden md:block">
            <table class="table-auto w-full">
              <thead>
                <tr class="text-left text-[#6C7275] font-normal text-[14px] border-b-[1px] border-[#E8ECEF]">
                  <th class="py-4">Código de pedido</th>
                  <th class="py-4">Fecha</th>
                  <th class="py-4">Estatus</th>
                  <th class="py-4">Precio</th>
                </tr>
              </thead>
              <tbody class="text-[#141718] font-normal text-[14px]">
                @foreach ($ordenes as $orden)
                  <tr class="border-b-[1px] border-[#E8ECEF] text-left">
                    <td class="py-4">#{{ $orden->codigo_orden }}</td>
                    <td class="py-4">{{ $orden->updated_at }}</td>
                    <td class="py-4">{{ $orden->statusOrdenes->descripcion }}</td>
                    <td class="py-4">S/. {{ $orden->monto }}</td>

                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <!-- para mobiles acordion -->
          <div class="relative ring-gray-900/5 sm:mx-auto sm:rounded-lg block md:hidden">
            <div class="mx-auto">
              <div class="mx-auto grid max-w-[900px] gap-5">
                <div class="bg-[#F5F5F5] rounded-lg px-2">
                  <details class="group">
                    <summary class="flex cursor-pointer list-none items-center justify-between font-medium">
                      <div class="font-normal text-[14px] flex flex-col justify-center items-start my-3">
                        <p class="text-[#6C7275]">Código de pedido</p>
                        <p class="text-[#141718]">#3456_768</p>
                      </div>

                      <span class="transition group-open:rotate-180">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <mask id="mask0_1301_11376" style="mask-type: alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                            width="24" height="24">
                            <rect width="24" height="24" transform="matrix(-1 0 0 1 24 0)" fill="#D9D9D9" />
                          </mask>
                          <g mask="url(#mask0_1301_11376)">
                            <path d="M12 15.3746L18 9.37461L16.6 7.97461L12 12.5746L7.4 7.97461L6 9.37461L12 15.3746Z"
                              fill="#1C1B1F" />
                          </g>
                        </svg>
                      </span>
                    </summary>
                    <div class="flex flex-col gap-5">
                      <div class="font-normal text-[14px]">
                        <p class="text-[#6C7275]">Fecha</p>
                        <p class="text-[#141718]">12 de Enero de 2024</p>
                      </div>

                      <div class="font-normal text-[14px]">
                        <p class="text-[#6C7275]">Estatus</p>
                        <p class="text-[#141718]">Entregado</p>
                      </div>

                      <div class="font-normal text-[14px]">
                        <p class="text-[#6C7275]">Precio</p>
                        <p class="text-[#141718]">$1234.00</p>
                      </div>
                    </div>
                  </details>
                </div>

                <div class="bg-[#F5F5F5] rounded-lg px-2">
                  <details class="group">
                    <summary class="flex cursor-pointer list-none items-center justify-between font-medium">
                      <div class="font-normal text-[14px] flex flex-col justify-center items-start my-3">
                        <p class="text-[#6C7275]">Código de pedido</p>
                        <p class="text-[#141718]">#3456_768</p>
                      </div>

                      <span class="transition group-open:rotate-180">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <mask id="mask0_1301_11376" style="mask-type: alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                            width="24" height="24">
                            <rect width="24" height="24" transform="matrix(-1 0 0 1 24 0)" fill="#D9D9D9" />
                          </mask>
                          <g mask="url(#mask0_1301_11376)">
                            <path d="M12 15.3746L18 9.37461L16.6 7.97461L12 12.5746L7.4 7.97461L6 9.37461L12 15.3746Z"
                              fill="#1C1B1F" />
                          </g>
                        </svg>
                      </span>
                    </summary>
                    <div class="flex flex-col gap-5">
                      <div class="font-normal text-[14px]">
                        <p class="text-[#6C7275]">Fecha</p>
                        <p class="text-[#141718]">12 de Enero de 2024</p>
                      </div>

                      <div class="font-normal text-[14px]">
                        <p class="text-[#6C7275]">Estatus</p>
                        <p class="text-[#141718]">Entregado</p>
                      </div>

                      <div class="font-normal text-[14px]">
                        <p class="text-[#6C7275]">Precio</p>
                        <p class="text-[#141718]">$1234.00</p>
                      </div>
                    </div>
                  </details>
                </div>

                <div class="bg-[#F5F5F5] rounded-lg px-2">
                  <details class="group">
                    <summary class="flex cursor-pointer list-none items-center justify-between font-medium">
                      <div class="font-normal text-[14px] flex flex-col justify-center items-start my-3">
                        <p class="text-[#6C7275]">Código de pedido</p>
                        <p class="text-[#141718]">#3456_768</p>
                      </div>

                      <span class="transition group-open:rotate-180">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <mask id="mask0_1301_11376" style="mask-type: alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                            width="24" height="24">
                            <rect width="24" height="24" transform="matrix(-1 0 0 1 24 0)" fill="#D9D9D9" />
                          </mask>
                          <g mask="url(#mask0_1301_11376)">
                            <path d="M12 15.3746L18 9.37461L16.6 7.97461L12 12.5746L7.4 7.97461L6 9.37461L12 15.3746Z"
                              fill="#1C1B1F" />
                          </g>
                        </svg>
                      </span>
                    </summary>
                    <div class="flex flex-col gap-5">
                      <div class="font-normal text-[14px]">
                        <p class="text-[#6C7275]">Fecha</p>
                        <p class="text-[#141718]">12 de Enero de 2024</p>
                      </div>

                      <div class="font-normal text-[14px]">
                        <p class="text-[#6C7275]">Estatus</p>
                        <p class="text-[#141718]">Entregado</p>
                      </div>

                      <div class="font-normal text-[14px]">
                        <p class="text-[#6C7275]">Precio</p>
                        <p class="text-[#141718]">$1234.00</p>
                      </div>
                    </div>
                  </details>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

@section('scripts_importados')
  <script>
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
  </script>
@stop

@stop
