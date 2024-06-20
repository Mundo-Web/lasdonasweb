@extends('components.public.matrix')

@section('css_importados')

@stop


@section('content')


<main>
    <section class="font-poppins w-11/12 mx-auto my-12 flex flex-col gap-10">
      <div>
        <a href="index.html" class="font-normal text-[14px] text-[#6C7275]"
          >Home</a
        >
        <span>/</span>
        <a
          href="carrito.html"
          class="font-semibold text-[14px] text-[#141718]"
          >Carrito</a
        >
      </div>
      <div class="flex md:gap-20">
        <div
          class="flex justify-between items-center md:basis-7/12 w-full md:w-auto"
        >
          <p
            class="font-semibold text-[18px] text-[#21201E] border-b-[1px] border-[#6C7275] md:px-4 py-4 basis-1/3 h-full text-center"
          >
            <span class="flex items-center h-full">Carro de compra</span>
          </p>

          <p
            class="font-medium text-[18px] text-[#C8C8C8] border-b-[1px] border-[#6C7275] md:px-4 py-4 basis-1/3 h-full text-center"
          >
            <span class="flex items-center h-full">Detalles de pago</span>
          </p>

          <p
            class="font-medium text-[18px] text-[#C8C8C8] border-b-[1px] border-[#6C7275] md:px-4 py-4 basis-1/3 h-full text-center"
          >
            <span class="flex items-center h-full">Orden completada</span>
          </p>
        </div>
        <div class="md:basis-5/12"></div>
      </div>
      <div class="flex flex-col md:flex-row gap-20">
        <div class="basis-7/12 flex flex-col gap-10">
          <div>
            <div
              class="flex flex-col 2lg:flex-row pb-5 border-b-[2px] border-[#E8ECEF] gap-5"
            >
              <div class="w-full basis-5/12">
                <p
                  class="font-semibold text-[14px] text-[#141718] text-left py-4"
                >
                  Producto
                </p>

                <div class="flex justify-start items-center gap-5 w-full">
                  <img
                    src="./images/img/producto_carrito_1.png"
                    alt="producto"
                  />
                  <div class="flex flex-col justify-start items-start w-full">
                    <h3 class="font-semibold text-[14px] text-[#151515]">
                      Producto 01
                    </h3>
                    <p class="font-normal text-[12px] text-[#6C7275]">
                      Color: Black
                    </p>
                    <div
                      class="font-medium text-[12px] text-[#6C7275] flex justify-between items-center gap-10 w-full md:w-auto"
                    >
                      <p>Eliminar</p>
                      <div class="cursor-pointer">
                        <img
                          src="./images/svg/eliminar_producto_icon.svg"
                          alt="eliminar producto"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="flex gap-10 w-full text-center basis-7/12">
                <div class="flex-1">
                  <p
                    class="font-semibold text-[14px] text-[#141718] pt-4 pb-6"
                  >
                    Cantidad
                  </p>

                  <div
                    class="flex justify-center text-[#151515] border-[1px] border-[#6C7275] rounded-md"
                  >
                    <div
                      class="w-8 h-8 flex justify-center items-center cursor-pointer flex-1"
                    >
                      <span class="text-[20px]">-</span>
                    </div>
                    <div
                      class="w-8 h-8 flex justify-center items-center flex-1"
                    >
                      <span class="font-semibold text-[14px]">2</span>
                    </div>
                    <div
                      class="w-8 h-8 flex justify-center items-center cursor-pointer flex-1"
                    >
                      <span class="text-[20px]">+</span>
                    </div>
                  </div>
                </div>

                <div class="flex-1">
                  <p
                    class="font-semibold text-[14px] text-[#141718] pt-4 pb-6"
                  >
                    Precio
                  </p>
                  <p class="font-semibold text-[18px] text-[#151515]">
                    s/19.00
                  </p>
                </div>

                <div class="flex-1">
                  <p
                    class="font-semibold text-[14px] text-[#141718] pt-4 pb-6"
                  >
                    Sub Total
                  </p>
                  <p class="font-semibold text-[18px] text-[#151515]">
                    s/38.00
                  </p>
                </div>
              </div>
            </div>

            <div
              class="flex flex-col 2lg:flex-row pb-5 border-b-[2px] border-[#E8ECEF] gap-5"
            >
              <div class="w-full basis-5/12">
                <p
                  class="font-semibold text-[14px] text-[#141718] text-left py-4"
                >
                  Producto
                </p>

                <div class="flex justify-start items-center gap-5 w-full">
                  <img
                    src="./images/img/producto_carrito_1.png"
                    alt="producto"
                  />
                  <div class="flex flex-col justify-start items-start w-full">
                    <h3 class="font-semibold text-[14px] text-[#151515]">
                      Producto 01
                    </h3>
                    <p class="font-normal text-[12px] text-[#6C7275]">
                      Color: Black
                    </p>
                    <div
                      class="font-medium text-[12px] text-[#6C7275] flex justify-between items-center gap-10 w-full md:w-auto"
                    >
                      <p>Eliminar</p>
                      <div class="cursor-pointer">
                        <img
                          src="./images/svg/eliminar_producto_icon.svg"
                          alt="eliminar producto"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="flex gap-10 w-full text-center basis-7/12">
                <div class="flex-1">
                  <p
                    class="font-semibold text-[14px] text-[#141718] pt-4 pb-6"
                  >
                    Cantidad
                  </p>

                  <div
                    class="flex justify-center text-[#151515] border-[1px] border-[#6C7275] rounded-md"
                  >
                    <div
                      class="w-8 h-8 flex justify-center items-center cursor-pointer flex-1"
                    >
                      <span class="text-[20px]">-</span>
                    </div>
                    <div
                      class="w-8 h-8 flex justify-center items-center flex-1"
                    >
                      <span class="font-semibold text-[14px]">2</span>
                    </div>
                    <div
                      class="w-8 h-8 flex justify-center items-center cursor-pointer flex-1"
                    >
                      <span class="text-[20px]">+</span>
                    </div>
                  </div>
                </div>

                <div class="flex-1">
                  <p
                    class="font-semibold text-[14px] text-[#141718] pt-4 pb-6"
                  >
                    Precio
                  </p>
                  <p class="font-semibold text-[18px] text-[#151515]">
                    s/19.00
                  </p>
                </div>

                <div class="flex-1">
                  <p
                    class="font-semibold text-[14px] text-[#141718] pt-4 pb-6"
                  >
                    Sub Total
                  </p>
                  <p class="font-semibold text-[18px] text-[#151515]">
                    s/38.00
                  </p>
                </div>
              </div>
            </div>

            <div
              class="flex flex-col 2lg:flex-row pb-5 border-b-[2px] border-[#E8ECEF] gap-5"
            >
              <div class="w-full basis-5/12">
                <p
                  class="font-semibold text-[14px] text-[#141718] text-left py-4"
                >
                  Producto
                </p>

                <div class="flex justify-start items-center gap-5 w-full">
                  <img
                    src="./images/img/producto_carrito_1.png"
                    alt="producto"
                  />
                  <div class="flex flex-col justify-start items-start w-full">
                    <h3 class="font-semibold text-[14px] text-[#151515]">
                      Producto 01
                    </h3>
                    <p class="font-normal text-[12px] text-[#6C7275]">
                      Color: Black
                    </p>
                    <div
                      class="font-medium text-[12px] text-[#6C7275] flex justify-between items-center gap-10 w-full md:w-auto"
                    >
                      <p>Eliminar</p>
                      <div class="cursor-pointer">
                        <img
                          src="./images/svg/eliminar_producto_icon.svg"
                          alt="eliminar producto"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="flex gap-10 w-full text-center basis-7/12">
                <div class="flex-1">
                  <p
                    class="font-semibold text-[14px] text-[#141718] pt-4 pb-6"
                  >
                    Cantidad
                  </p>

                  <div
                    class="flex justify-center text-[#151515] border-[1px] border-[#6C7275] rounded-md"
                  >
                    <div
                      class="w-8 h-8 flex justify-center items-center cursor-pointer flex-1"
                    >
                      <span class="text-[20px]">-</span>
                    </div>
                    <div
                      class="w-8 h-8 flex justify-center items-center flex-1"
                    >
                      <span class="font-semibold text-[14px]">2</span>
                    </div>
                    <div
                      class="w-8 h-8 flex justify-center items-center cursor-pointer flex-1"
                    >
                      <span class="text-[20px]">+</span>
                    </div>
                  </div>
                </div>

                <div class="flex-1">
                  <p
                    class="font-semibold text-[14px] text-[#141718] pt-4 pb-6"
                  >
                    Precio
                  </p>
                  <p class="font-semibold text-[18px] text-[#151515]">
                    s/19.00
                  </p>
                </div>

                <div class="flex-1">
                  <p
                    class="font-semibold text-[14px] text-[#141718] pt-4 pb-6"
                  >
                    Sub Total
                  </p>
                  <p class="font-semibold text-[18px] text-[#151515]">
                    s/38.00
                  </p>
                </div>
              </div>
            </div>

            <div
              class="flex flex-col 2lg:flex-row pb-5 border-b-[2px] border-[#E8ECEF] gap-5"
            >
              <div class="w-full basis-5/12">
                <p
                  class="font-semibold text-[14px] text-[#141718] text-left py-4"
                >
                  Producto
                </p>

                <div class="flex justify-start items-center gap-5 w-full">
                  <img
                    src="./images/img/producto_carrito_1.png"
                    alt="producto"
                  />
                  <div class="flex flex-col justify-start items-start w-full">
                    <h3 class="font-semibold text-[14px] text-[#151515]">
                      Producto 01
                    </h3>
                    <p class="font-normal text-[12px] text-[#6C7275]">
                      Color: Black
                    </p>
                    <div
                      class="font-medium text-[12px] text-[#6C7275] flex justify-between items-center gap-10 w-full md:w-auto"
                    >
                      <p>Eliminar</p>
                      <div class="cursor-pointer">
                        <img
                          src="./images/svg/eliminar_producto_icon.svg"
                          alt="eliminar producto"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="flex gap-10 w-full text-center basis-7/12">
                <div class="flex-1">
                  <p
                    class="font-semibold text-[14px] text-[#141718] pt-4 pb-6"
                  >
                    Cantidad
                  </p>

                  <div
                    class="flex justify-center text-[#151515] border-[1px] border-[#6C7275] rounded-md"
                  >
                    <div
                      class="w-8 h-8 flex justify-center items-center cursor-pointer flex-1"
                    >
                      <span class="text-[20px]">-</span>
                    </div>
                    <div
                      class="w-8 h-8 flex justify-center items-center flex-1"
                    >
                      <span class="font-semibold text-[14px]">2</span>
                    </div>
                    <div
                      class="w-8 h-8 flex justify-center items-center cursor-pointer flex-1"
                    >
                      <span class="text-[20px]">+</span>
                    </div>
                  </div>
                </div>

                <div class="flex-1">
                  <p
                    class="font-semibold text-[14px] text-[#141718] pt-4 pb-6"
                  >
                    Precio
                  </p>
                  <p class="font-semibold text-[18px] text-[#151515]">
                    s/19.00
                  </p>
                </div>

                <div class="flex-1">
                  <p
                    class="font-semibold text-[14px] text-[#141718] pt-4 pb-6"
                  >
                    Sub Total
                  </p>
                  <p class="font-semibold text-[18px] text-[#151515]">
                    s/38.00
                  </p>
                </div>
              </div>
            </div>

            <div
              class="flex flex-col 2lg:flex-row pb-5 border-b-[2px] border-[#E8ECEF] gap-5"
            >
              <div class="w-full basis-5/12">
                <p
                  class="font-semibold text-[14px] text-[#141718] text-left py-4"
                >
                  Producto
                </p>

                <div class="flex justify-start items-center gap-5 w-full">
                  <img
                    src="./images/img/producto_carrito_1.png"
                    alt="producto"
                  />
                  <div class="flex flex-col justify-start items-start w-full">
                    <h3 class="font-semibold text-[14px] text-[#151515]">
                      Producto 01
                    </h3>
                    <p class="font-normal text-[12px] text-[#6C7275]">
                      Color: Black
                    </p>
                    <div
                      class="font-medium text-[12px] text-[#6C7275] flex justify-between items-center gap-10 w-full md:w-auto"
                    >
                      <p>Eliminar</p>
                      <div class="cursor-pointer">
                        <img
                          src="./images/svg/eliminar_producto_icon.svg"
                          alt="eliminar producto"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="flex gap-10 w-full text-center basis-7/12">
                <div class="flex-1">
                  <p
                    class="font-semibold text-[14px] text-[#141718] pt-4 pb-6"
                  >
                    Cantidad
                  </p>

                  <div
                    class="flex justify-center text-[#151515] border-[1px] border-[#6C7275] rounded-md"
                  >
                    <div
                      class="w-8 h-8 flex justify-center items-center cursor-pointer flex-1"
                    >
                      <span class="text-[20px]">-</span>
                    </div>
                    <div
                      class="w-8 h-8 flex justify-center items-center flex-1"
                    >
                      <span class="font-semibold text-[14px]">2</span>
                    </div>
                    <div
                      class="w-8 h-8 flex justify-center items-center cursor-pointer flex-1"
                    >
                      <span class="text-[20px]">+</span>
                    </div>
                  </div>
                </div>

                <div class="flex-1">
                  <p
                    class="font-semibold text-[14px] text-[#141718] pt-4 pb-6"
                  >
                    Precio
                  </p>
                  <p class="font-semibold text-[18px] text-[#151515]">
                    s/19.00
                  </p>
                </div>

                <div class="flex-1">
                  <p
                    class="font-semibold text-[14px] text-[#141718] pt-4 pb-6"
                  >
                    Sub Total
                  </p>
                  <p class="font-semibold text-[18px] text-[#151515]">
                    s/38.00
                  </p>
                </div>
              </div>
            </div>

            <div
              class="flex flex-col 2lg:flex-row pb-5 border-b-[2px] border-[#E8ECEF] gap-5"
            >
              <div class="w-full basis-5/12">
                <p
                  class="font-semibold text-[14px] text-[#141718] text-left py-4"
                >
                  Producto
                </p>

                <div class="flex justify-start items-center gap-5 w-full">
                  <img
                    src="./images/img/producto_carrito_1.png"
                    alt="producto"
                  />
                  <div class="flex flex-col justify-start items-start w-full">
                    <h3 class="font-semibold text-[14px] text-[#151515]">
                      Producto 01
                    </h3>
                    <p class="font-normal text-[12px] text-[#6C7275]">
                      Color: Black
                    </p>
                    <div
                      class="font-medium text-[12px] text-[#6C7275] flex justify-between items-center gap-10 w-full md:w-auto"
                    >
                      <p>Eliminar</p>
                      <div class="cursor-pointer">
                        <img
                          src="./images/svg/eliminar_producto_icon.svg"
                          alt="eliminar producto"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="flex gap-10 w-full text-center basis-7/12">
                <div class="flex-1">
                  <p
                    class="font-semibold text-[14px] text-[#141718] pt-4 pb-6"
                  >
                    Cantidad
                  </p>

                  <div
                    class="flex justify-center text-[#151515] border-[1px] border-[#6C7275] rounded-md"
                  >
                    <div
                      class="w-8 h-8 flex justify-center items-center cursor-pointer flex-1"
                    >
                      <span class="text-[20px]">-</span>
                    </div>
                    <div
                      class="w-8 h-8 flex justify-center items-center flex-1"
                    >
                      <span class="font-semibold text-[14px]">2</span>
                    </div>
                    <div
                      class="w-8 h-8 flex justify-center items-center cursor-pointer flex-1"
                    >
                      <span class="text-[20px]">+</span>
                    </div>
                  </div>
                </div>

                <div class="flex-1">
                  <p
                    class="font-semibold text-[14px] text-[#141718] pt-4 pb-6"
                  >
                    Precio
                  </p>
                  <p class="font-semibold text-[18px] text-[#151515]">
                    s/19.00
                  </p>
                </div>

                <div class="flex-1">
                  <p
                    class="font-semibold text-[14px] text-[#141718] pt-4 pb-6"
                  >
                    Sub Total
                  </p>
                  <p class="font-semibold text-[18px] text-[#151515]">
                    s/38.00
                  </p>
                </div>
              </div>
            </div>

            <div
              class="flex flex-col 2lg:flex-row pb-5 border-b-[2px] border-[#E8ECEF] gap-5"
            >
              <div class="w-full basis-5/12">
                <p
                  class="font-semibold text-[14px] text-[#141718] text-left py-4"
                >
                  Producto
                </p>

                <div class="flex justify-start items-center gap-5 w-full">
                  <img
                    src="./images/img/producto_carrito_1.png"
                    alt="producto"
                  />
                  <div class="flex flex-col justify-start items-start w-full">
                    <h3 class="font-semibold text-[14px] text-[#151515]">
                      Producto 01
                    </h3>
                    <p class="font-normal text-[12px] text-[#6C7275]">
                      Color: Black
                    </p>
                    <div
                      class="font-medium text-[12px] text-[#6C7275] flex justify-between items-center gap-10 w-full md:w-auto"
                    >
                      <p>Eliminar</p>
                      <div class="cursor-pointer">
                        <img
                          src="./images/svg/eliminar_producto_icon.svg"
                          alt="eliminar producto"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="flex gap-10 w-full text-center basis-7/12">
                <div class="flex-1">
                  <p
                    class="font-semibold text-[14px] text-[#141718] pt-4 pb-6"
                  >
                    Cantidad
                  </p>

                  <div
                    class="flex justify-center text-[#151515] border-[1px] border-[#6C7275] rounded-md"
                  >
                    <div
                      class="w-8 h-8 flex justify-center items-center cursor-pointer flex-1"
                    >
                      <span class="text-[20px]">-</span>
                    </div>
                    <div
                      class="w-8 h-8 flex justify-center items-center flex-1"
                    >
                      <span class="font-semibold text-[14px]">2</span>
                    </div>
                    <div
                      class="w-8 h-8 flex justify-center items-center cursor-pointer flex-1"
                    >
                      <span class="text-[20px]">+</span>
                    </div>
                  </div>
                </div>

                <div class="flex-1">
                  <p
                    class="font-semibold text-[14px] text-[#141718] pt-4 pb-6"
                  >
                    Precio
                  </p>
                  <p class="font-semibold text-[18px] text-[#151515]">
                    s/19.00
                  </p>
                </div>

                <div class="flex-1">
                  <p
                    class="font-semibold text-[14px] text-[#141718] pt-4 pb-6"
                  >
                    Sub Total
                  </p>
                  <p class="font-semibold text-[18px] text-[#151515]">
                    s/38.00
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="basis-5/12 flex flex-col justify-start gap-5">
          <h2 class="font-semibold text-[20px] text-[#151515]">
            Resumen de la compra
          </h2>

          <div>
            <div class="flex flex-col gap-5">
              <div class="w-full flex flex-col gap-5">
                <div
                  class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700"
                >
                  <input
                    type="radio"
                    id="bordered-radio-1"
                    name="bordered-radio"
                    value=""
                    class="background-radius w-5 h-5"
                  />
                  <label
                    for="bordered-radio-1"
                    class="w-full py-4 ms-2 text-[16px] font-normal text-[#151515] flex justify-between items-center px-4"
                  >
                    <span>Envío gratis</span>
                    <span>s/ 0.00</span>
                  </label>
                </div>
                <div
                  class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700"
                >
                  <input
                    type="radio"
                    id="bordered-radio-2"
                    name="bordered-radio"
                    value=""
                    class="background-radius w-5 h-5"
                  />
                  <label
                    for="bordered-radio-2"
                    class="w-full py-4 ms-2 text-[16px] font-normal text-[#151515] flex justify-between items-center px-4"
                  >
                    <span>Envío express</span>
                    <span>s/ 15.00</span>
                  </label>
                </div>

                <div
                  class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700"
                >
                  <input
                    type="radio"
                    id="bordered-radio-3"
                    name="bordered-radio"
                    value=""
                    class="background-radius w-5 h-5"
                  />
                  <label
                    for="bordered-radio-3"
                    class="w-full py-4 ms-2 text-[16px] font-normal text-[#151515] flex justify-between items-center px-4"
                  >
                    <span>Recoger</span>
                    <span>s/ 21.00</span>
                  </label>
                </div>
              </div>

              <div class="text-[#151515] flex justify-between items-center">
                <p class="font-normal text-[14px]">SubTotal</p>
                <span class="font-semibold text-[14px]">s/ 114.00</span>
              </div>

              <div class="text-[#151515] flex justify-between items-center">
                <p class="font-semibold text-[20px]">Total</p>
                <span class="font-semibold text-[20px]">s/ 114.00</span>
              </div>

              <a
                href="checkout_envio_pago.html"
                class="text-white bg-[#74A68D] w-full py-4 rounded-3xl cursor-pointer font-semibold text-[16px] inline-block text-center"
                >Siguiente</a
              >

              <!-- <input
                type="submit"
                value="Siguiente"
                class="text-white bg-[#74A68D] w-full py-4 rounded-3xl cursor-pointer font-semibold text-[16px] inline-block text-center"
              /> -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  
@section('scripts_importados')
<script>


</script>
@stop

@stop