import React from 'react'
import CreateReactScript from './Utils/CreateReactScript';
import { createRoot } from 'react-dom/client';
import SvgPuntos from './components/svg/SvgPuntos.svg';

const Agradecimiento = ({ orden_code, orden }) => {

  const steps = [
    { label: 'Iniciar sesión', completed: true },
    { label: 'Datos de envío y formas de pago', completed: true },
    { label: 'Confirmación', completed: true }
  ];

  return <>
    <main className='p-[5%]'>

      <div className="flex flex-col items-center justify-center min-h-screen bg-white p-4">
        <div className="w-full max-w-md">
          <div className="flex justify-center mb-8">

            {/* <span className="text-orange-400 font-bold text-xl">LD's</span> */}
            <img src="/img_donas/selloCoral.png" alt="" className='h-48 w-48' />

          </div>

          <h1 className="text-2xl font-bold text-green-500 text-center mb-2">
            ¡TU ORDEN HA SIDO RECIBIDA!
          </h1>
          <p className="text-center text-gray-600 mb-4">¡Gracias por tu compra!</p>

          <div className="bg-green-100 rounded-full py-2 px-4 mb-6">
            <p className="text-center text-green-800 font-semibold"># Pedido: {orden_code}</p>
          </div>

          <div className="text-center mb-6">
            <h2 className="text-xl font-bold text-green-500 mb-2">¡Felicitaciones!</h2>
            <p className="text-gray-600">Acabas de ganar {orden.points} puntos 🎉</p>
            <p className="text-gray-600 text-sm">
              ¡Recuerda! Cada una de tus compras en LAS DONAS suma puntos que podrás canjear por complementos en tus próximos pedidos!🍩
            </p>
          </div>

          <div className="space-y-4">
            <a className="w-full py-2 px-4 border block text-center border-green-500 text-green-500 rounded-full hover:bg-green-50 transition-colors duration-300">
              Conoce nuestro programa de puntos
            </a>
            <a href='/micuenta/historial' className=" w-full py-2 px-4 border block text-center border-green-500 text-green-500 rounded-full hover:bg-green-50 transition-colors duration-300">
              Haz seguimiento a tu pedido
            </a>
            <a href='/catalogo' className="w-full py-2 px-4 bg-[#ff8555] block  text-center text-white rounded-full hover:bg-[#ff8555] transition-colors duration-300">
              Seguir comprando
            </a>
          </div>
        </div>
      </div>
    </main>
  </>
}

CreateReactScript((el, properties) => {
  createRoot(el).render(<Agradecimiento {...properties} />);
})