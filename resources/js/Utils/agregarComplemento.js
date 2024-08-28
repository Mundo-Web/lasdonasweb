import axios from "axios";
import { Local } from 'sode-extend-react/sources/storage'

const agregarComplementoPedido = async (id) => {
  try {
    const res = await axios.post('/api/products/addComplemento', { id });

    if (res.status === 200) {
      const { data: complementos } = res.data;



      let detalleComplemento = complementos.map(item => {
        const object = {
          id: item.id,
          producto: item.producto,
          precio: item.descuento > 0 ? item.descuento : item.precio,
          imagen: item.images.filter(item => item.caratula === 1)[0]?.name_imagen ?? '/images/img/noimagen.jpg',
          cantidad: 1,
          sku: item.sku,
          tipo: 'Complemento',
          fecha: '',
          horario: '',
          extract: item.extract
        }
        if (item.tipo_servicio == 'complemento' && item.puntos_complemento > 0) {
          object.points = item.puntos_complemento
          object.usePoints = false
        }
        return object
      })



      let carrito = Local.get('carrito') ?? [];


      // Verificar si el artículo ya existe en el carrito
      let existeArticulo = carrito.some(item => item.id === detalleComplemento[0].id);



      if (existeArticulo) {
        // Actualizar la cantidad del artículo existente
        carrito = carrito.map(item => {
          if (item.id === detalleComplemento[0].id) {
            return {
              ...item,
              cantidad: item.cantidad + Number(detalleComplemento[0].cantidad),
            };
          }
          return item;
        });
      } else {
        // Agregar el nuevo artículo al carrito
        carrito = [...carrito, detalleComplemento[0]];
      }

      // Guardar el carrito actualizado en el almacenamiento local
      Local.set('carrito', carrito);



      const item = $('#gift-icon')
      item.addClass('send-to-cart')
      setTimeout(() => {
        item.removeClass('send-to-cart')
        item.removeAttr('style')

        limpiarHTML();
        PintarCarrito()

        $(cartButton).addClass('shake');
        setTimeout(function () {
          $(cartButton).removeClass('shake');
        }, 1000)
      }, 1000);

      // Swal.fire({
      //   icon: 'success',
      //   title: 'Exito',
      //   text: `Producto agregado correctamente al CArro de compras`,
      // });
    }

  } catch (error) {
    console.error(error);
    Swal.fire({
      icon: 'error',
      title: 'Error',
      text: 'Hubo un error al agregar el pedido. Por favor, inténtelo de nuevo.',
    });
  }
}
export default agregarComplementoPedido;