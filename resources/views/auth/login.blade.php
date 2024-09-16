<x-authentication-layout>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <div class="flex h-screen font-b_slick_bold min-h-[869px]">
    <!-- Primer div -->
    <div class="basis-1/2 hidden md:block ">
      <!-- Imagen ocupando toda la altura y sin desbordar -->
      <div style="background-image: url('{{ asset('/img_donas/login.png') }}')"
        class="bg-cover bg-center bg-no-repeat w-full h-full ">
        {{-- <h1 class="Displaytext-text24 xl:text-text28 py-10 bg-black bg-opacity-25 text-center text-white">
          Las doñas
        </h1> --}}
      </div>
    </div>

    <!-- Segundo div -->
    <div class="w-full md:basis-1/2 text-[#151515] flex justify-center  mt-16">
      <div class="w-full md:w-4/6 flex flex-col gap-5">
        <div class="px-4 flex flex-col gap-5 text-center md:text-left">
          @if (session('status'))
            <div class="mb-4 text-sm text-green-600">
              {{ session('status') }}
            </div>
          @endif
          <h1 class="text-4xl font-medium tracking-widest leading-10 uppercase text-zinc-800">
            Bienvenido de nuevo
          </h1>
          <p class="mt-4 w-full text-sm  leading-5 text-neutral-900 text-opacity-80">
            Esperamos que puedas encontrar lo que buscas en nuestro sitio web.
          </p>
        </div>

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="">
              @foreach ($errors->all() as $error)
                <li class="text-red-500 p-4 bg-gray-200 rounded-lg shadow-lg p">{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <div class="flex flex-col mt-12 w-full px-4">
          @php
            $currentUrl = url()->full();
          @endphp

          <form method="POST"
            action="{{ strpos($currentUrl, 'ref=pago') !== false ? route('login', ['ref' => 'pago']) : route('login') }}"
            class="flex flex-col w-full">
            @csrf
            <div class="flex flex-col w-full">
              <label for="email" class="text-sm tracking-wide text-neutral-900">Email</label>
              <div class="relative w-full py-2">
                <input type="email" id="email" name="email" :value="old('email')" required autofocus
                  class=" my-auto bg-transparent  outline-none focus:border-none  gap-10 justify-between items-center px-6  w-full font-medium leading-tight rounded-3xl border py-4 border-orange-400 border-solid "
                  aria-label="Email input" />
                <i
                  class="fa fa-envelope text-[#6C7275] absolute right-6 top-1/2 transform -translate-y-1/2 cursor-pointer"></i>
              </div>
            </div>
            <div class="flex flex-col mt-5 w-full">
              <label for="password" class="text-sm tracking-wide text-neutral-900">Contraseña</label>
              <div class="relative w-full flex items-center">
                <input type="password" id="password" name="password" required autocomplete="current-password"
                  class="relative my-auto bg-transparent  outline-none focus:border-none  gap-10 justify-between items-center px-6  w-full font-medium leading-tight rounded-3xl border py-4 border-orange-400 border-solid "
                  aria-label="Password input" />
                <i id="showhide-icon"
                  class="fas fa-eye text-[#6C7275] absolute right-6 top-1/2 transform -translate-y-1/2 cursor-pointer"
                  onclick="mostrarContrasena()"></i>
              </div>
            </div>
            <div
              class="flex gap-10 justify-between items-center mt-6 w-full text-sm font-medium leading-tight text-center">
              <label class="flex gap-1 items-center  my-auto text-neutral-900 text-opacity-40 cursor-pointer">
                <input type="checkbox" id="acepto_terminos" class="w-3 h-3 border:text-opacity-40" />
                <span class="flex items-center">Recuerdame</span>
              </label>
              <a href="#" class="flex gap-1 items-center  my-auto text-orange-400">
                <span>¿Olvidaste tu contraseña?</span>
              </a>
            </div>

            <div class="flex flex-col mt-12 w-full text-base font-bold leading-tight text-neutral-900">
              <input type="submit" value="Ingresar"
                class="cursor-pointer gap-2  px-6 py-4 w-full whitespace-nowrap bg-green-800 rounded-3xl text-zinc-100" />
              <a href="{{ strpos($currentUrl, 'ref=pago') !== false ? route('login-google', ['ref' => 'pago']) : route('login-google') }}"
                class="flex flex-row gap-2 justify-center items-center px-6 py-3.5 mt-4 w-full rounded-3xl border border-green-800 border-solid min-h-[51px]">
                <img loading="lazy" src="/img_donas/Google1.png" alt=""
                  class="object-contain shrink-0  my-auto w-6 aspect-square" />
                <span class=" my-auto">Ingresar con mi cuenta de Google</span>
              </a>
            </div>
          </form>
        </div>
        <div class="flex self-start mt-12 text-sm font-medium leading-tight text-center w-full gap-2 justify-center">
          <span class="">Eres nuevo? </span>
          <a href="/register-rev" class="text-orange-400 underline">Regístrate aquí</a>
        </div>
      </div>
    </div>
  </div>
  <script>
    const mostrarContrasena = () => {
      const icon = $('#showhide-icon')
      const input = $('#password')
      const current = input.attr('type')
      if (current == 'text') {
        input.attr('type', 'password')
        icon.removeClass('fa-eye-slash').addClass('fa-eye')
      } else {
        input.attr('type', 'text')
        icon.removeClass('fa-eye').addClass('fa-eye-slash')
      }
    }
  </script>
  <script>
    // Capturar el parámetro ref de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const ref = urlParams.get('ref');

    // Almacenar el parámetro ref en Local Storage
    if (ref) {
      localStorage.setItem('ref', ref);
    }
  </script>
</x-authentication-layout>
