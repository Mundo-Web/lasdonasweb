<x-authentication-layout>
    <div class="py-20 md:py-0">
        <div class="flex flex-row md:h-screen justify-center">
            <div class="basis-1/2 hidden md:block font-poppins">
                <!-- Imagen ocupando toda la altura y sin desbordar -->
                <div style="background-image: url('{{ asset('images/img/summer_1.png') }}')" class="bg-cover bg-center bg-no-repeat w-full h-full">
                    <h1 class="font-mediumDisplay text-[24px] py-10 bg-black bg-opacity-25 text-center text-white">
                        Doomine
                    </h1>
                </div>
            </div>

            <!-- Segundo div -->
            <div class="w-full md:basis-1/2 text-[#151515] flex flex-col justify-center items-center font-poppins px-5 md:px-0">
                <div class="w-full md:w-4/6 flex flex-col gap-5 justify-center items-center">
                    <div class="px-4 flex flex-col gap-5 text-center md:text-left">
                        <h1 class="font-boldDisplay text-text40 xl:text-text44">
                            Crear Una Cuenta
                        </h1>
                        <p class="font-regularDisplay text-text16 xl:text-text20">
                            ¿Ya tienes una cuenta?
                            <a href="{{ route('login') }}" class="font-boldDisplay text-text16 xl:text-text20 text-textBlack">Iniciar
                                Sesión</a>
                        </p>
                    </div>
                    <div class="">
                        <form method="POST" action="{{ route('register') }}" class="flex flex-col gap-5">
                            @csrf
                            <div>
                                <input type="text" placeholder="Nombre completo" id="name"
                                       name="name" :value="old('name')" required autofocus autocomplete="name"
                                       class="w-full py-5 px-4 focus:outline-none placeholder-gray-400 font-regularDisplay text-text16 xl:text-text20 border-b-[1.5px]  border-x-0 border-t-0  border-gray-200 focus:ring-0 focus:border-gray-200 focus:border-b-[1.5px]" />
                            </div>
                            <div>
                                <input type="email" placeholder="Correo electrónico" id="email" 
                                    name="email" :value="old('email')" required
                                    class="w-full py-5 px-4 focus:outline-none placeholder-gray-400 font-regularDisplay text-text16 xl:text-text20 border-b-[1.5px] border-x-0 border-t-0  border-gray-200 focus:ring-0 focus:border-gray-200 focus:border-b-[1.5px]" />

                            </div>
                           

                            <div class="relative w-full">
                                <!-- Input -->
                                <input type="password" placeholder="Contraseña" id="password"  name="password" required autocomplete="new-password"
                                    class="w-full py-5 pl-4 pr-12 focus:outline-none placeholder-gray-400 font-regularDisplay text-text16 xl:text-text20 border-b-[1.5px] border-x-0 border-t-0  border-gray-200 focus:ring-0 focus:border-gray-200 focus:border-b-[1.5px]" />
                                <!-- Imagen -->
                                <img onclick="mostrarContrasena()" src="{{asset('images/svg/pass_eyes.svg')}}" alt="password"
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer" />
                            </div>


                            <div class="relative w-full">
                                <!-- Input -->
                                <input type="password" placeholder="Confirmar contraseña" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
                                    class="w-full py-5 pl-4 pr-12 focus:outline-none placeholder-gray-400 font-normal text-[16px] border-b-[1.5px] border-x-0 border-t-0  border-gray-200 focus:ring-0 focus:border-gray-200 focus:border-b-[1.5px]" />
                                <!-- Imagen -->
                                <img onclick="mostrarContrasena()" src="{{asset('images/svg/pass_eyes.svg')}}" alt="password"
                                    class="absolute right-4 top-1/2 transform -translate-y-1/2 cursor-pointer" />
                            </div>
                            

                            <div class="flex gap-3 px-4 items-center">
                                <input type="checkbox" id="acepto_terminos" class="w-5 h-5" />
                                <label for="acepto_terminos"
                                    class="font-regularDisplay text-text16 xl:text-text20">Acepto la
                                    <span class="font-boldDisplay text-textBlack">Política de Privacidad</span>
                                    y los
                                    <span class="font-boldDisplay text-textBlack">
                                        Términos de Uso
                                    </span>
                                </label>
                            </div>

                            <div class="px-4">
                                <input type="submit" value="Crear Cuenta"
                                    class="text-white bg-[#151515] w-full py-4 rounded-full cursor-pointer text-text16 xl:text-text20" />
                            </div>
                        </form>
                        <x-validation-errors class="mt-4" />  
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-authentication-layout>
