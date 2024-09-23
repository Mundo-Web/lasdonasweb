<x-app-layout>
  <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <section class="py-4 border-b border-slate-100 dark:border-slate-700">
      <a href="{{ route('subcategories.create') }}"
        class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded text-sm">Crear subcategoria</a>
    </section>


    <div
      class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">


      <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
        <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-2xl tracking-tight">Subcategorias</h2>
      </header>
      <div class="p-3">

        <!-- Table -->
        <div class="overflow-x-auto">

          <table id="tabladatos" class="display text-lg" style="width:100%">
            <thead>
              <tr>
                <th class="px-3 py-2">Nombre</th>
                <th class="px-3 py-2">Descripción</th>
                <th class="px-3 py-2">Categoria</th>
                <th class="px-3 py-2">Destacar</th>
                <th class="px-3 py-2">Visible</th>
                <th class="w-32 px-3 py-2">Acciones</th>
              </tr>
            </thead>
            <tbody>

              @foreach ($subcategories as $item)
                <tr>
                  <td class="px-3 py-2">{{ $item->name }}</td>
                  <td class="px-3 py-2">{{ $item->description }}</td>
                  <td class="px-3 py-2">{{ $item->category()->name }}</td>
                  <td>
                    <label class="inline-flex items-center cursor-pointer">
                      <input id="btn_switch" type="checkbox" data-id="{{ $item->id }}"
                        data-name="{{ $item->name }}" data-field="destacar" class="sr-only peer" @if($item->destacar) checked @endif>
                      <div
                        class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                      </div>
                    </label>
                  </td>
                  <td>
                    <label class="inline-flex items-center cursor-pointer">
                      <input id="btn_switch" type="checkbox" data-id="{{ $item->id }}"
                        data-name="{{ $item->name }}" data-field="visible" class="sr-only peer" @if($item->visible) checked @endif>
                      <div
                        class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                      </div>
                    </label>
                  </td>
                  <td class="px-3 py-2 flex flex-row justify-end items-center gap-1">
                    <a href="{{ route('subcategories.edit', $item->id) }}"
                      class="bg-yellow-400 px-3 py-1 rounded text-white  ">
                      <i class="fa-regular fa-pen-to-square"></i>
                    </a>
                    @csrf
                    <button id="btn_delete" data-id='{{ $item->id }}'
                      class=" bg-red-600 px-3 py-1 rounded text-white cursor-pointer">
                      <i class="fa-regular fa-trash-can"></i>
                    </button>
                  </td>
                </tr>
              @endforeach

            </tbody>
            <tfoot>
              <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Categoria</th>
                <th>Destacar</th>
                <th>Visible</th>
                <th>Acciones</th>
              </tr>
            </tfoot>
          </table>

        </div>
      </div>
    </div>

  </div>

  <script>
    $('document').ready(function() {

      new DataTable('#tabladatos', {
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
        layout: {
          topStart: 'buttons'
        },
        language: {
          "lengthMenu": "Mostrar _MENU_ registros",
          "zeroRecords": "No se encontraron resultados",
          "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
          "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
          "infoFiltered": "(filtrado de un total de _MAX_ registros)",
          "sSearch": "Buscar:",

          "sProcessing": "Procesando...",
        },
        buttons: [

          {
            extend: 'excelHtml5',
            text: '<i class="fas fa-file-excel"></i> ',
            titleAttr: 'Exportar a Excel',
            className: 'btn btn-success',
          },
          {
            extend: 'pdfHtml5',
            text: '<i class="fas fa-file-pdf"></i> ',
            titleAttr: 'Exportar a PDF',
          },
          {
            extend: 'csvHtml5',
            text: '<i class="fas fa-file-csv"></i> ',
            titleAttr: 'Imprimir',
            className: 'btn btn-info',
          },
          {
            extend: 'print',
            text: '<i class="fa fa-print"></i> ',
            titleAttr: 'Imprimir',
            className: 'btn btn-info',
          },
          {
            extend: 'copy',
            text: '<i class="fas fa-copy"></i> ',
            titleAttr: 'Copiar',
            className: 'btn btn-success',
          },
        ]
      });

      $(document).on('click', '#btn_delete', function(e) {

        var id = $(this).attr('data-id');

        Swal.fire({
          title: "Seguro que deseas eliminar?",
          text: "Vas a eliminar una categoría",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si, borrar!",
          cancelButtonText: "Cancelar"
        }).then((result) => {
          if (result.isConfirmed) {

            $.ajax({

              url: '{{ route('subcategories.delete') }}',
              method: 'DELETE',
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

      $(document).on('change', '#btn_switch', async function() {

        const id = $(this).attr('data-id')
        const name = $(this).attr('data-name')
        const field = $(this).attr('data-field')
        const value = $(this).prop('checked')

        try {
          const res = await fetch("{{ route('subcategories.update') }}", {
            method: 'PATCH',
            headers: {
              'Accept': 'application/json',
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              _token: $('[name="_token"]').val(),
              id,
              field,
              [field]: value,
            })
          })
          const data = await res.json()
          if (!res.ok) throw new Error(data?.message ?? 'Ocurrio un error inesperado')
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: `${name} ha sido actualizado`,
            showConfirmButton: false,
            timer: 1500
          });
        } catch (error) {
          Swal.fire({
              title: error.message,
              icon: "error",
            });
        }
      });
    })
  </script>
</x-app-layout>
