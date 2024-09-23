<x-app-layout>
  <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    <form action="{{ route('subcategories.save') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div
        class="col-span-full xl:col-span-8 bg-white dark:bg-slate-800 shadow-lg rounded-sm border border-slate-200 dark:border-slate-700">
        <header class="px-5 py-4 border-b border-slate-100 dark:border-slate-700">
          <h2 class="font-semibold text-slate-800 dark:text-slate-100 text-2xl tracking-tight">
            @if (!$subcategory->id)
              Nueva subcategoria
            @else
              Actualizar subcategoria - {{ $subcategory->name }}
            @endif
          </h2>
        </header>

        <div class="p-3">
          <div class="rounded shadow-lg p-4 px-4 ">
            <div class="grid gap-4 gap-y-2 text-sm grid-cols-1 md:grid-cols-5">
              <input type="hidden" name="id" value="{{ $subcategory->id }}">
              <div class="md:col-span-5">
                <label for="costo_x_art">Categoria</label>
                <div class="relative mb-2  mt-2">
                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="text-lg text-gray-500 dark:text-gray-400 fas fa-folder"></i>
                  </div>
                  <select name="category_id"
                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    required>
                    <option value="">Seleccionar Categoria</option>
                    @foreach ($categories as $item)
                      <option value="{{ $item->id }}"
                        {{ $item->id == $subcategory?->category_id ? 'selected' : '' }}
                        {{ !$item->status ? 'disabled' : '' }}>{{ $item->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="md:col-span-5">
                <label for="name">Nombre</label>
                <div class="relative mb-2  mt-2">
                  <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="text-lg text-gray-500 dark:text-gray-400 fas fa-pen"></i>
                  </div>
                  <input type="text" id="name" name="name"
                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Nombre" value="{{ $subcategory->name }}" required>
                </div>
              </div>

              <div class="md:col-span-5">
                <label for="description">Descripción</label>
                <div class="relative mb-2 mt-2">
                  <div class="absolute inset-y-0 left-0 flex items-start pl-3 pointer-events-none top-3">
                    <i class="text-lg text-gray-500 dark:text-gray-400 fas fa-pen"></i>
                  </div>
                  <textarea type="text" rows="2" id="description" name="description"
                    class="mt-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Descripción">{{ $subcategory->description }}</textarea>
                </div>
              </div>

              {{-- <div class="md:col-span-5">
                <label for="address">Subir una Foto</label>
                <div class="relative mb-2  mt-2">
                  <input name="imagen"
                    class="p-2.5 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    aria-describedby="user_avatar_help" id="user_avatar" type="file">
                </div>
              </div> --}}

              <div class="md:col-span-5">
                <label class="inline-flex items-center cursor-pointer">
                  <input id="destacar" name="destacar" type="checkbox" class="sr-only peer" {{$subcategory->destacar ? 'checked': ''}}>
                  <div
                    class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                  </div>
                  <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Destacar</span>
                </label>
              </div>

              <div class="md:col-span-5 text-right mt-6 flex justify-between">
                <div class="inline-flex items-end">
                  <a href="{{ route('subcategories.index') }}"
                    class="bg-red-500 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded">Volver</a>
                </div>
                <div class="inline-flex items-end">
                  <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                    Guardar subcategoria
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>

  </div>

</x-app-layout>
