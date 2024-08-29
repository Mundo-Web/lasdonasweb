import React, { useEffect, useState } from 'react';
import OrderItem from './OrderItem';
import TotalRow from './TotalRow';
import Divider from './Divider';
import calculartotal from '../Utils/calcularTotal';




const OrderSummary = ({ carrito, costoEnvio, setIsModalOpen, points }) => {
  const subtotal = calculartotal(points)
  const [total, setTotal] = useState(subtotal);
  useEffect(() => {
    setTotal(Number(subtotal) + Number(costoEnvio))
  }, [costoEnvio]);
  return (
    <main className="flex flex-col flex-1 shrink justify-center self-stretch my-auto w-full basis-0 min-w-[240px] max-md:max-w-full">
      {carrito.map((item, index) => (
        <React.Fragment key={item.id}>
          <OrderItem {...item} userPoints={points} />
          {index < carrito.length - 1 && <Divider />}
        </React.Fragment>
      ))}
      <Divider />
      <TotalRow label="Sub Total" value={subtotal} />
      <Divider />
      <TotalRow label="Costo de envio" value={costoEnvio} setIsModalOpen={setIsModalOpen} />

      <Divider />
      <TotalRow label="Total" value={total} isBold={true} />
      <Divider />
    </main>
  );
}

export default OrderSummary;