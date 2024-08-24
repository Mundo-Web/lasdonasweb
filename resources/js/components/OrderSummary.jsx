import React from 'react';
import OrderItem from './OrderItem';
import TotalRow from './TotalRow';
import Divider from './Divider';
import calculartotal from '../Utils/calcularTotal';




const OrderSummary = ({ carrito }) => {
  const subtotal = calculartotal()
  return (
    <main className="flex flex-col flex-1 shrink justify-center self-stretch my-auto w-full basis-0 min-w-[240px] max-md:max-w-full">
      {console.log(carrito)}
      {carrito.map((item, index) => (
        <React.Fragment key={item.id}>
          <OrderItem {...item} />
          {index < carrito.length - 1 && <Divider />}
        </React.Fragment>
      ))}
      <Divider />
      <TotalRow label="Sub Total" value={subtotal} />
      <Divider />
      <TotalRow label="Total" value={subtotal} isBold={true} />
      <Divider />
    </main>
  );
}

export default OrderSummary;