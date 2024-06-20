<x-authentication-layout>

  <div class="flex h-screen">
    <!-- Primer div -->
    <div class="basis-1/2 hidden md:block font-poppins">
      <!-- Imagen ocupando toda la altura y sin desbordar -->
      <div style="background-image: url('{{ asset('images/img/summer_2.png') }}')"
        class="bg-cover bg-center bg-no-repeat w-full h-full">
        <h1 class="font-mediumDisplaytext-text24 xl:text-text28 py-10 bg-black bg-opacity-25 text-center text-white">
          Las doñas
        </h1>
      </div>
    </div>

    <!-- Segundo div -->
    <div class="w-full md:basis-1/2 text-[#151515] flex justify-center items-center font-poppins">
      <div class="w-full md:w-4/6 flex flex-col gap-5">
        <div class="px-4 flex flex-col gap-5 text-center md:text-left">
          @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
              {{ session('status') }}
            </div>
          @endif
          <h1 class="font-boldDisplay text-text40 xl:text-text44">
            Iniciar Sesión
          </h1>
          <p class="font-regularDisplay text-text16 xl:text-text20">
            ¿Aún no tienes una cuenta?
            <a href="{{ route('register') }}" class="font-boldDisplay text-text16 xl:text-text20 text-textBlack">
              Crea una
            </a>
          </p>
        </div>
        <div class="">
          <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-5">
            @csrf
            <div>
              <input type="text" placeholder="Tu nombre de usuario o correo electrónico" name="email"
                id="email" type="email" :value="old('email')" required autofocus
                class="w-full py-5 px-4 focus:outline-none placeholder-gray-400 font-regularDisplay text-text16 xl:text-text20 border-b-[1.5px] border-x-0 border-t-0  border-gray-200 focus:ring-0 focus:border-gray-200 focus:border-b-[1.5px]" />
            </div>

            <div class="relative w-full">
              <!-- Input -->
              <input type="password" placeholder="Contraseña" id="password" name="password" required
                autocomplete="current-password"
                class="w-full py-5 pl-4 pr-12 focus:outline-none placeholder-gray-400 font-regularDisplay text-text16 xl:text-text20 border-b-[1.5px] border-x-0 border-t-0  border-gray-200 focus:ring-0 focus:border-gray-200 focus:border-b-[1.5px]" />
              <!-- Imagen -->
              <img onclick="mostrarContrasena()" src="./images/svg/pass_eyes.svg" alt="password"
                class="absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer" />
            </div>

            <div class="flex gap-3 px-4 justify-between">
              <div class="flex items-center gap-2">
                <input type="checkbox" id="acepto_terminos" class="w-4 h-4" />
                <label for="acepto_terminos" class="font-regularDisplay text-text16 xl:text-text20">Recuerdame
                </label>
              </div>

              @if (Route::has('password.request'))
                <div>
                  <a href="{{ route('password.request') }}"
                    class="font-boldDisplay text-text16 xl:text-text20 text-textBlack">¿Olvidaste tu contraseña?</a>
                </div>
              @endif


            </div>

            <div class="px-4">
              <input type="submit" value="Iniciar Sesión"
                class="text-white bg-bgBlack w-full py-4 rounded-full cursor-pointer text-text16 xl:text-text20" />
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</x-authentication-layout>
