<div
  class="relative w-full lg:w-80 lg:py-0 border-b lg:border-0 border-[#082252] mr-3 hidden lg:flex font-b_classic_bold">
  <input id="buscarproducto" type="text" placeholder="Buscar..." autocomplete="off"
    class="w-full pl-12 pr-10 py-3 border lg:border-[#F8F8F8] bg-[#F8F8F8] rounded-3xl focus:outline-none focus:ring-0 text-gray-400 placeholder:text-gray-400 focus:border-transparent">
  <span class="absolute inset-y-0 left-0 flex items-start lg:items-center bg-[#336234] rounded-full my-[7px] px-2 ml-2">
    <svg width="20" height="20" viewBox="0 0 20 20" fill="#336234" xmlns="http://www.w3.org/2000/svg"
      class="">
      <path
        d="M14.6851 13.6011C14.3544 13.2811 13.8268 13.2898 13.5068 13.6206C13.1868 13.9514 13.1955 14.4789 13.5263 14.7989L14.6851 13.6011ZM16.4206 17.5989C16.7514 17.9189 17.2789 17.9102 17.5989 17.5794C17.9189 17.2486 17.9102 16.7211 17.5794 16.4011L16.4206 17.5989ZM15.2333 9.53333C15.2333 12.6814 12.6814 15.2333 9.53333 15.2333V16.9C13.6018 16.9 16.9 13.6018 16.9 9.53333H15.2333ZM9.53333 15.2333C6.38531 15.2333 3.83333 12.6814 3.83333 9.53333H2.16667C2.16667 13.6018 5.46484 16.9 9.53333 16.9V15.2333ZM3.83333 9.53333C3.83333 6.38531 6.38531 3.83333 9.53333 3.83333V2.16667C5.46484 2.16667 2.16667 5.46484 2.16667 9.53333H3.83333ZM9.53333 3.83333C12.6814 3.83333 15.2333 6.38531 15.2333 9.53333H16.9C16.9 5.46484 13.6018 2.16667 9.53333 2.16667V3.83333ZM13.5263 14.7989L16.4206 17.5989L17.5794 16.4011L14.6851 13.6011L13.5263 14.7989Z"
        fill="#ffffff" class="fill-fillAzulPetroleo lg:fill-fillPink" />
    </svg>
  </span>
  <div class="bg-white z-100 shadow-2xl top-12 w-full absolute overflow-y-auto max-h-[200px] " id="resultados">
  </div>
</div>



<script>
  let clockSearch;

  function openSearch() {
    document.getElementById("myOverlay").style.display = "block";

  }

  function closeSearch() {
    document.getElementById("myOverlay").style.display = "none";
  }

  function imagenError(image) {
    image.onerror = null; // Previene la posibilidad de un bucle infinito si la imagen de error también falla
    image.src = '/images/img/noimagen.jpg'; // Establece la imagen de error
  }

  $(document).on('keyup', '#buscarproducto', function() {

    clearTimeout(clockSearch);
    var query = $(this).val().trim();

    if (query !== '') {
      clockSearch = setTimeout(() => {
        $.ajax({
          url: '{{ route('buscar') }}',
          method: 'GET',
          data: {
            query: query
          },
          success: function(data) {
            console.log(data)
            var resultsHtml = '';
            var url = '{{ asset('') }}';
            data.forEach(function(result) {
              console.log(result)
              const price = Number(result.precio) || 0
              const discount = Number(result.descuento) || 0

              let imagenUrl = result.images
                .filter(img => img.caratula == 1)
                .map(img => img.name_imagen);
              console.log(imagenUrl)

              resultsHtml += `<a href="/producto/${result.id}">
                <div class="w-full flex gap-2 flex-row py-3 px-5 hover:bg-slate-200">
                  <div class="w-[10%]">
                    <img class="w-14 rounded-md" src="/${imagenUrl}" onerror="imagenError(this)" />
                  </div>
                  <div class="flex flex-col justify-center w-[60%]">
                    <h2 class="text-left">${result.producto}</h2>
                    <p class="text-text12 text-left">Categoría</p>
                  </div>
                  <div class="flex flex-col justify-center w-[10%]">
                    <p class="text-right w-max">S/ ${discount > 0 ? discount.toFixed(2) : price.toFixed(2)}</p>
                    ${discount > 0 ? `<p class="text-text12 text-right line-through text-slate-500 w-max">S/ ${price.toFixed(2)}</p>` : ''}
                  </div>
                </div>
              </a>`;
            });

            $('#resultados').html(resultsHtml);
            $('#resultados2').html(resultsHtml);
          }
        });

      }, 300);

    } else {
      $('#resultados').empty();
      $('#resultados2').empty();
    }
  });
</script>
