<x-app-layout>
  <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <div
      class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
      <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
        <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-2xl">Pedido #{{ $orders->codigo_orden }}
        </h2>
        {{ $orders->tipo_tarjeta }}
      </header>
      <div class="p-6">

        <div class="flex flex-col gap-2 ">
          <div class="flex gap-2 p-3 ">

            <div class="basis-0 md:basis-3/5">
              <div class="rounded shadow-lg p-4">



                <div class="flex items-center justify-between mb-8">
                  <div class="flex items-center">
                    <img class="" src="{{ asset('img_donas/Logo.png') }}" alt="Logo" />

                  </div>
                  <div class="text-gray-700">

                    <div class="text-sm">Fecha: {{ $orders->created_at }}</div>
                    <div class="text-sm">Pedido #{{ $orders->codigo_orden }}</div>
                  </div>
                </div>
                <div class="border-b-2 border-gray-300 pb-3 mb-3">
                  <h2 class="text-xl font-bold mb-4">Informacion del cliente</h2>
                  <div class="ml-1 text-slate-800 dark:text-slate-100 text-sm">{{ $orders->usuarioPedido->name }}
                    {{ $orders->usuarioPedido->lastname }}</div>
                  <div class="ml-1 text-slate-800 dark:text-slate-100 text-sm">{{ $orders->billing_address }}</div>
                  <div class="ml-1 text-slate-800 dark:text-slate-100 text-sm">{{ $orders->usuarioPedido->email }}
                  </div>
                </div>

                <div class="flex flex-col py-4">
                  <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                      <div class="border rounded-lg overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                          <thead>
                            <tr>
                              <th></th>
                              <th scope="col" class="px-6 py-3 text-start text-sm font-medium text-slate-800 ">
                                Producto</th>
                              <th scope="col" class="px-6 py-3 text-center text-sm font-medium text-slate-800  ">
                                Precio</th>
                              <th scope="col" class="px-6 py-3 text-center text-sm font-medium text-slate-800 ">
                                Cantidad</th>
                              <th scope="col" class="px-6 py-3 text-end text-sm font-medium text-slate-800 ">
                                Total</th>
                            </tr>
                          </thead>
                          <tbody class="divide-y divide-gray-200">
                            @foreach ($orders->DetalleOrden as $item)
                              <tr>
                                <td class="px-4 py-2 whitespace-nowrap text-sm font-medium text-gray-800">
                                  <div class="flex flex-row items-start gap-4 mt-2">
                                    <img class="w-10 aspect-square shadow rounded object-cover object-center"
                                      src="{{ asset($item->imagenProducto->name_imagen) }}" />

                                  </div>
                                </td>
                                <td>
                                  <h2 class="-mb-2">{{ $item->producto->producto }}</h2>
                                  @if ($item->points_used > 0)
                                    <span class="text-orange-500 text-xs">Usó puntos</span>
                                  @endif
                                </td>
                                <td class="px-4 py-2 text-sm font-bold text-center text-gray-800">
                                  @if ($item->points_used > 0)
                                    <span class="block">{{ $item->precio }}</span>
                                    <span class="block text-orange-500"><i
                                        class="mdi mdi-dots-hexagon me-1"></i>{{ $item->points }}</span>
                                  @else
                                    {{ $item->precio }}
                                  @endif
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-800 text-center font-bold">
                                  @if ($item->points_used > 0)
                                    <span
                                      class="block">{{ $item->cantidad - $item->points_used / $item->points }}</span>
                                    <span class="block text-orange-500">{{ $item->points_used / $item->points }}</span>
                                  @else
                                    {{ $item->cantidad }}
                                  @endif
                                </td>
                                <td class="px-4 py-2 text-sm text-end font-medium text-gray-800">
                                  @if ($item->points_used > 0)
                                    <span class="block">S/. {{ $item->price_used }}</span>
                                    <span class="block text-orange-500">{{ $item->points_used }} puntos</span>
                                  @else
                                    S/. {{ $item->price_used }}
                                  @endif
                                </td>
                              </tr>
                            @endforeach

                          </tbody>

                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="flex justify-end mb-1">
                  <div class="px-6  text-end text-sm font-medium text-slate-800">Subtotal:</div>
                  <div class="text-slate-800 text-sm mr-3">S/. {{ number_format($orders->monto, 2) }}</div>
                </div>
                <div class="flex justify-end mb-4">
                  <div class="px-6  text-end text-sm font-medium text-slate-800">Costo de envio:</div>
                  <div class="text-slate-800 text-sm mr-3">S/. {{ number_format($orders->precio_envio, 2) }}</div>

                </div>
                <div class="flex justify-end mb-8">
                  <div class="px-6  text-end text-sm font-medium text-slate-800">Total:</div>
                  <div class="text-slate-800 font-bold text-md mr-3">S/.
                    {{ number_format($orders->monto + $orders->precio_envio, 2) }}</div>
                </div>
                {{-- <div class="border-t-2 border-gray-300 pt-8 mb-8">
                                              <div class="text-gray-700 mb-2">Payment is due within 30 days. Late payments
                                                  are subject to fees.</div>
                                              <div class="text-gray-700 mb-2">Please make checks payable to Your Company
                                                  Name and mail to:</div>
                                              <div class="text-gray-700">123 Main St., Anytown, USA 12345</div>
                                          </div> --}}




              </div>
            </div>

            <div class="basis-0 md:basis-2/5">
              <div class="rounded shadow-lg p-4 mb-3">

                <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-md ml-1">Nombre del receptor:</h2>
                <p class="ml-1 text-slate-800 dark:text-slate-100 text-sm">
                  {{ $orders->address_owner }}</p>
                <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-md ml-1">Direccion
                  de envio:</h2>
                <p class="ml-1 text-slate-800 dark:text-slate-100 text-sm">
                  {{ $orders->address_full }}</p>

              </div>
              <div class="rounded-lg shadow-md">
                <iframe class="w-full aspect-video rounded-md"
                  src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBDikLz7ELBdUFW0TnvkWkcXPK48Wc003U&q={{ $orders->address_latitude }},{{ $orders->address_longitude }}&zoom=16&maptype=satellite"
                  style="border:0;" allowfullscreen="" loading="lazy"
                  referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
              <div class="mt-6">
                @if ($orders->tipo_tarjeta == 'transferencia')
                  <a class="underline" href="javascript:void(0);"
                    onclick="descargarImg('{{ asset($orders->img_transferencia) }}')">
                    Ver comprobante de Transferencia
                  </a>
                  </button>
                @endif
              </div>
            </div>

          </div>
        </div>











        <div class="inline-flex items-end">
          <a href="{{ URL::previous() }}"
            class="bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">Volver</a>
        </div>
      </div>
    </div>


</x-app-layout>
<script>
  new DataTable('#tabladatos', {
    responsive: true
  });

  function descargarImg(url) {
    console.log(url)
    var a = document.createElement('a')
    a.href = url
    // a.download = 'imagen_transferencia.jpg'
    a.target = '_blank';
    a.click()


  }
</script>
