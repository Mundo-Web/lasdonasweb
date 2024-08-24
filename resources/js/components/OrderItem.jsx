import React from 'react';

function OrderItem({ producto, extract, sku, precio, cantidad, total, imagen }) {
  return (
    <div className="flex flex-wrap gap-10 justify-between items-start w-full max-md:max-w-full">
      <div className="flex gap-8 min-w-[240px]">
        <img loading="lazy" src={imagen} alt={producto} className="object-contain shrink-0 self-start w-28 aspect-square" />
        <div className="flex flex-col w-44">
          <div className="flex flex-col w-full">
            <h2 className="text-base font-bold tracking-wider text-neutral-900">{producto}</h2>
            <p className="mt-2 text-sm tracking-wide leading-5 text-neutral-900 text-opacity-80">{extract}</p>
          </div>
          <p className="mt-5 text-xs font-bold tracking-wide text-neutral-900">SKU: {sku}</p>
        </div>
      </div>
      <div className="flex justify-between items-start font-bold text-right min-w-[240px] w-[400px]">
        <div className="flex flex-col flex-1 shrink justify-center basis-0">
          <p className="text-sm tracking-wide text-neutral-900 text-opacity-80">Precio</p>
          <p className="mt-2 text-base tracking-wider text-neutral-900">{precio}</p>
        </div>
        <div className="flex flex-col flex-1 shrink justify-center whitespace-nowrap basis-0">
          <p className="text-sm tracking-wide text-neutral-900 text-opacity-80">Cantidad</p>
          <p className="mt-2 text-base tracking-wider text-neutral-900">{cantidad}</p>
        </div>
        <div className="flex flex-col flex-1 shrink justify-center basis-0">
          <p className="text-sm tracking-wide text-neutral-900 text-opacity-80">Total</p>
          <p className="mt-2 text-base tracking-wider text-neutral-900">{Number(precio) * Number(cantidad)}</p>
        </div>
      </div>
    </div>
  );
}

export default OrderItem;