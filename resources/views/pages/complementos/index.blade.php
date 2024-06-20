<x-app-layout>
  <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <section class="py-4 border-b border-slate-100 dark:border-slate-700">
      <a href="{{ route('tags.create') }}"
        class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded text-sm">Agregar Complemento</a>
    </section>


    <div
      class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">


      <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
        <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-2xl tracking-tight">Complementos</h2>
      </header>
      <div class="p-3">

        <!-- Table -->
        <div class="overflow-x-auto">

          <table id="tabladatos" class="display text-lg" style="width:100%">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Color</th>
                <th>Visible</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>



            </tbody>
            <tfoot>
              <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Color</th>
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
        responsive: true
      });

      $(".btn_delete").on("click", function(e) {

        var id = $(this).attr('data-idService');

        Swal.fire({
          title: "Seguro que deseas eliminar?",
          text: "Si eliminas, se perderán todas las relaciones con los productos",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si, borrar!",
          cancelButtonText: "Cancelar"
        }).then((result) => {
          if (result.isConfirmed) {

            $.ajax({

              url: '{{ route('tags.deleteTags') }}',
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

</x-app-layout>
