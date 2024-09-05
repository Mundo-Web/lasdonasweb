<x-app-layout>
  <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <section class="py-4 border-b border-slate-100 dark:border-slate-700">
      <a href="{{ route('cupones.create') }}"
        class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded text-sm">Crear Cupon</a>
    </section>


    <div
      class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">


      <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
        <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-2xl tracking-tight">Faqs </h2>
      </header>
      <div class="p-3">

        <!-- Table -->
        <div class="overflow-x-auto">

          <table id="tabladatos" class="display text-lg" style="width:100%">
            <thead>
              <tr>
                <th>Codigo </th>
                <th>Cliente</th>
                <th>Fecha de canje</th>
                <th>Monto</th>
                <th>Usado</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($cupones as $item)
                <tr>
                  <td>{{ $item->codigo }}</td>
                  <td>{{ $item->cliente->name }}</td>
                  <td>{{ $item->fecha_asignacion }}</td>
                  <td> S/ {{ $item->monto }}</td>
                  <td>{{ $item->usado }}</td>


                  <td class="flex flex-row justify-end items-center gap-5">

                    <a href="{{ route('cupones.edit', $item->id) }}"
                      class="bg-yellow-400 px-3 py-2 rounded text-white  "><i
                        class="fa-regular fa-pen-to-square"></i></a>

                    <form action="{{ route('cupones.destroy', $item->id) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" data-idService='{{ $item->id }}'
                        class=" bg-red-600 px-3 py-2 rounded text-white cursor-pointer"><i
                          class="fa-regular fa-trash-can"></i></button>
                    </form>


                  </td>
                </tr>
              @endforeach

            </tbody>
            <tfoot>
              <tr>
                <th>Codigo </th>
                <th>Cliente</th>
                <th>Fecha de canje</th>
                <th>Monto</th>
                <th>Usado</th>
                <th>Acciones</th>
              </tr>
            </tfoot>
          </table>

        </div>
      </div>
    </div>

  </div>



</x-app-layout>
<script>
  $('document').ready(function() {

    new DataTable('#tabladatos', {
      responsive: true
    });

    $(".btn_swithc").on("change", function() {

      let status = 0;
      let id = $(this).attr('data-idService');
      let titleService = $(this).attr('data-titleService');
      let field = $(this).attr('data-field');

      if ($(this).is(':checked')) {
        status = 1;
      } else {
        status = 0;
      }



      $.ajax({
        url: "{{ route('faqs.updateVisible') }}",
        method: 'POST',
        data: {
          _token: $('input[name="_token"]').val(),
          status: status,
          id: id,
          field: field,
        }
      }).done(function(res) {

        Swal.fire({
          position: "top-end",
          icon: "success",
          title: titleService + " a sido modificado",
          showConfirmButton: false,
          timer: 1500

        });

      })
    });

    $(".btn_delete").on("click", function(e) {
      e.preventDefault()

      let id = $(this).attr('data-idService');

      Swal.fire({
        title: "Seguro que deseas eliminar?",
        text: "Vas a eliminar un Logo",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, borrar!",
        cancelButtonText: "Cancelar"
      }).then((result) => {
        if (result.isConfirmed) {

          $.ajax({

            url: `{{ route('faqs.borrar') }}`,
            method: 'POST',
            data: {
              _token: $('input[name="_token"]').val(),
              id: id,

            }

          }).done(function(res) {

            Swal.fire({
              title: res.message,
              icon: "success"
            });

            location.reload();

          })


        }
      });

    });
  })
</script>
