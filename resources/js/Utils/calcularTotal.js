const calculartotal = () => {

  let articulos = Local.get('carrito') ?? []
  let total = articulos.map(item => {
    let total = 0
    total += item.cantidad * Number(item.precio)
    if (item?.complementos?.length > 0) {
      item.complementos.forEach(complemento => {
        total += Number(complemento.preciofiltro)
      })
    }
    return total


  }).reduce((total, elemento) => total + elemento, 0);

  // const suma = total.

  return (total)


}

export default calculartotal;