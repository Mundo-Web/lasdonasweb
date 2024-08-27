const deleteItemR = (id) => {

  console.log('entreo aca');

  let articulosCarrito = Local.get('carrito') || [];
  let idCount = {};
  let duplicates = [];
  articulosCarrito.forEach(item => {
    if (idCount[item.id]) {
      idCount[item.id]++;
    } else {
      idCount[item.id] = 1;
    }
  });



  for (let id in idCount) {
    if (idCount[id] > 1) {
      duplicates.push(id);
    }
  }

  if (duplicates.length > 0) {

    let index = articulosCarrito.findIndex(item => item.id === id);
    if (index > -1) {
      articulosCarrito.splice(index, 1);
    }
  } else {
    articulosCarrito = articulosCarrito.filter(objeto => objeto.id !== id);

  }

  // return

  // setCarrito(articulosCarrito)


  Local.set('carrito', articulosCarrito)
  limpiarHTML()
  PintarCarrito()
  return articulosCarrito
}


const  addOnCarBtnR=(id) =>  {
  let articulosCarrito = Local.get('carrito') || [];
  let prodRepetido = articulosCarrito.map(item => {
    if (item.id === id) {

      item.cantidad += 1;
    }
    return item;
  });

  Local.set('carrito', prodRepetido);
  limpiarHTML();
  PintarCarrito();
  return prodRepetido
}

const deleteOnCarBtnR = (id) =>  {
  let articulosCarrito = Local.get('carrito') || [];
  let prodRepetido = articulosCarrito.map(item => {
    if (item.id === id && item.cantidad > 0) {

      item.cantidad -= 1;
    }
    return item;
  });

  Local.set('carrito', prodRepetido);
  limpiarHTML();
  PintarCarrito();
  return prodRepetido
}

export { deleteItemR, addOnCarBtnR, deleteOnCarBtnR }