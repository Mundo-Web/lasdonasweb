const calculartotal = (points = 0) => {
  console.log(points)
  // let articulos = Local.get('carrito') ?? []
  // let total = articulos.map(item => {
  //   let total = 0
  //   total += item.cantidad * Number(item.precio)
  //   /* if (item?.complementos?.length > 0) {
  //     item.complementos.forEach(complemento => {
  //       total += Number(complemento.preciofiltro)
  //     })
  //   } */
  //   return total


  // }).reduce((total, elemento) => total + elemento, 0);

  // // const suma = total.

  // return (total)

  let articulos = Local.get('carrito')

  let total = 0
  let restPoints = structuredClone(points)

  for (const item of articulos) {
    let totalPrice = 0;
    let cantidadGeneral = structuredClone(item.cantidad)
    for (let i = 0; i < item.cantidad; i++) {
      if (restPoints > item.points) {
        restPoints -= item.points
        cantidadGeneral--
      } else break
    }
    totalPrice = cantidadGeneral * Number(item.precio);
    total += totalPrice
  }

  return total
}

export default calculartotal;