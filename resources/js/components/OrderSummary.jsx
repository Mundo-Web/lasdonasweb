import React, { useEffect, useState } from 'react';
import OrderItem from './OrderItem';
import TotalRow from './TotalRow';
import Divider from './Divider';
import calculartotal from '../Utils/calcularTotal';
import { useRef } from 'react';




const OrderSummary = ({ carrito, costoEnvio, setIsModalOpen, points, historicoCupones }) => {
  const subtotal = calculartotal(points);

  const [total, setTotal] = useState(subtotal);
  const haycupon = useRef(false);
  // let haycupon = false;


  useEffect(() => {
    let descuento = 0;
    let cupon
    if (historicoCupones.length > 0) {

      cupon = historicoCupones[0].cupon ?? {};

      if (cupon.porcentaje == 1) {
        // Si es un porcentaje, calcula el descuento
        descuento = (subtotal * cupon.monto) / 100;
      } else {
        // Si no es un porcentaje, el descuento es el monto fijo
        descuento = cupon.monto;
      }
      haycupon.current = true;
    }
    const totalConDescuento = Number(subtotal) + Number(costoEnvio) - descuento;
    setTotal(totalConDescuento);
  }, [costoEnvio, subtotal, historicoCupones]);

  const porcentaje = historicoCupones[0]?.cupon?.porcentaje == 1 ? '%' : 'S/';
  const cuponMonto = `${porcentaje} ${Number(historicoCupones[0]?.cupon?.monto).toFixed(0)}`;



  return (
    <main className="flex flex-col flex-1 shrink justify-center self-stretch my-auto w-full basis-0 min-w-[240px] max-md:max-w-full">
      {carrito.map((item, index) => (
        <React.Fragment key={item.id}>
          <OrderItem {...item} userPoints={points} />
          {index < carrito.length - 1}
        </React.Fragment>
      ))}
      <Divider />
      <TotalRow label="Sub Total" value={subtotal} />
      <Divider />
      {haycupon.current && (<>
        <div className='flex flex-row justify-end'>
          <div className="flex  justify-end gap-5 self-end mt-6 max-w-full font-bold text-right w-[400px]">
            <div className={`my-auto  text-neutral-900 text-opacity-80 w-[200px] md:w-[133px] text-start`}>
              Descuento
            </div>
            <div className={`px-2 text-neutral-900 w-full md:w-[133px]`}>

              {(cuponMonto)}
            </div>
          </div>

        </div>

        <Divider />
      </>)}

      <TotalRow label="Costo de envio" value={costoEnvio} setIsModalOpen={setIsModalOpen} />

      <Divider />
      <TotalRow label="Total" value={total} isBold={true} />
      <Divider />
    </main>
  );
}

export default OrderSummary;