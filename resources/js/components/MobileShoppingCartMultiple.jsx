import React, { useState, useEffect, useRef } from 'react';
import { ChevronDownIcon, ChevronUpIcon } from 'lucide-react';
import calculartotal from '../Utils/calcularTotal';

function MobileShoppingCartMultiple({ cartItems, costoEnvio, historicoCupones = [], points, userPoints }) {



  const [visibleImages, setVisibleImages] = useState(new Set());

  const subtotal = calculartotal(points);


  const [total, setTotal] = useState(subtotal);
  const haycupon = useRef(false);

  const toggleImage = (id) => {
    setVisibleImages(prev => {
      const newSet = new Set(prev);
      if (newSet.has(id)) {
        newSet.delete(id);
      } else {
        newSet.add(id);
      }
      return newSet;
    });
  };
  /* 
    const cartItems = [
      {
        id: '1',
        name: 'Lirio Armonia',
        description: 'extracto lirio',
        sku: 'F6V30AL',
        price: 40,
        quantity: 1,
        image: '/placeholder.svg?height=100&width=100'
      },
      {
        id: '2',
        name: 'Rosa Encanto',
        description: 'ramo de rosas',
        sku: 'R7E40BM',
        price: 55,
        quantity: 2,
        image: '/placeholder.svg?height=100&width=100'
      },
      {
        id: '3',
        name: 'Girasol Alegría',
        description: 'girasol individual',
        sku: 'G8S20CN',
        price: 25,
        quantity: 3,
        image: '/placeholder.svg?height=100&width=100'
      }
    ]; */

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
    <div className="max-w-sm mx-auto p-2 bg-white text-gray-800 font-sans w-full">
      <h1 className="text-xl font-semibold mb-4">DETALLE DE COMPRAS</h1>

      {cartItems.map(item => {
        let finalQuantity = structuredClone(item.cantidad)
        for (let i = 0; i < item.cantidad; i++) {
          if (item.usePoints && userPoints >= item.points) {
            finalQuantity--
            userPoints -= item.points
          }
        }


        const subtotalf = finalQuantity * item.precio
        return <div key={item.id} className="border-b pb-4 mb-4">
          <div className="flex justify-between items-start mb-2">
            <div>
              <h2 className="font-semibold">{item.producto}</h2>
              <p className="text-sm text-gray-600">{item.extracto}</p>
              {item.usePoints && <span className="text-orange-500 text-sm">Usando puntos</span>}
              <p className="text-sm text-gray-600">SKU: {item.sku}</p>
            </div>
            <div className="text-right">
              <p className="font-semibold">S/ {subtotalf}</p>
              <p className="text-sm">Cantidad: {item.cantidad}</p>
            </div>
          </div>

          <button
            onClick={() => toggleImage(item.id)}
            className="flex items-center text-blue-600 text-sm"
          >
            {visibleImages.has(item.id) ? (
              <>
                <ChevronUpIcon className="w-4 h-4 mr-1" />
                Ocultar imagen
              </>
            ) : (
              <>
                <ChevronDownIcon className="w-4 h-4 mr-1" />
                Ver imagen
              </>
            )}
          </button>

          {visibleImages.has(item.id) && (
            <img
              src={`/${item.imagen}`}
              alt={item.producto}
              className="mt-2 w-24 h-24 object-cover rounded"
            />
          )}
        </div>
      })}

      <div className="space-y-2 text-sm">
        <div className="flex justify-between">
          <span>Sub Total</span>
          <span>S/ {subtotal}</span>
        </div>
        <div className="flex justify-between">
          <span>Descuento</span>
          <span>{cuponMonto}</span>
        </div>
        <div className="flex justify-between">
          <span>Costo de envío</span>
          <span>S/ {Number(costoEnvio).toFixed(0)}</span>
        </div>
        <div className="flex justify-between font-semibold text-base">
          <span>Total</span>
          <span>S/ {Number(total).toFixed(0)}</span>
        </div>
      </div>
    </div>
  );
}

export default MobileShoppingCartMultiple;