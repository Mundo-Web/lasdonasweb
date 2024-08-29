const calculartotal = (points = 0) => {
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