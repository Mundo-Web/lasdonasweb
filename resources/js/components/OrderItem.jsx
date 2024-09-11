import React from 'react';

function OrderItem({ producto, extract, sku, precio, cantidad, total, usePoints, imagen, points, userPoints }) {
  let finalQuantity = structuredClone(cantidad)
  for (let i = 0; i < cantidad; i++) {
    if (usePoints && userPoints >= points) {
      finalQuantity--
      userPoints -= points
    }
  }

  const subtotal = finalQuantity * precio
  return (
    <div className="flex  flex-col md:flex-row gap-5 md:gap-10 justify-between items-start w-full p-5 mt-4 border hover:border-[#336234] rounded-2xl">
      <div className="flex gap-8 min-w-[240px]  w-full">
        <img loading="lazy" src={imagen} alt={producto} className="object-contain shrink-0 self-start w-28 aspect-square" />
        <div className="flex flex-col w-full">
          <div className="flex flex-col w-full">
            <h2 className="text-lg lg:text-2xl font-bold tracking-wider text-[#336234] line-clamp-2">{producto}</h2>
            <p className="mt-2 text-sm tracking-wide leading-5 text-neutral-900 line-clamp-2 text-opacity-80">{extract}</p>
            {
              usePoints && <span className="text-orange-500 text-sm">
                Usando puntos
              </span>
            }
          </div>
          <p className="mt-5 text-xs font-bold tracking-wide text-neutral-900">SKU: {sku}</p>
        </div>
      </div>
      <div className="flex justify-between items-start font-bold text-right min-w-[240px] w-full md:w-[600px] text-[#112212]">
        <div className="flex flex-col flex-1 shrink justify-center basis-0">
          <p className="text-base lg:text-xl font-bold tracking-wider text-[#336234] line-clamp-2">Precio</p>
          <p className="mt-2 text-base tracking-wider text-neutral-900">S/ {Number(precio).toFixed(0)}</p>
        </div>
        <div className="flex flex-col flex-1 shrink justify-center whitespace-nowrap basis-0">
          <p className="text-base lg:text-xl font-bold tracking-wider text-[#336234] line-clamp-2">Cantidad</p>
          <p className="mt-2 text-base tracking-wider text-neutral-900">{cantidad}</p>
        </div>
        <div className="flex flex-col flex-1 shrink justify-center basis-0">
          <p className="text-base lg:text-xl font-bold tracking-wider text-[#336234] line-clamp-2">Total</p>
          <p className="mt-2 text-base tracking-wider text-neutral-900">S/ {subtotal.toFixed(0)}</p>
        </div>
      </div>
    </div>
  );
}

export default OrderItem;